<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\SpecialRequest;
use App\Models\Cook;
use App\Models\MyFamily;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\SpecialRequestAttendee;

class SpecialController extends Controller
{
    // ==========================================
    // إرسال FCM Notification عن طريق Topic
    // Topic format: humhum_chef_{cook_id}_{user_id}
    // ==========================================
    private function sendFcmNotification(string $topic, string $title, string $body, array $data = []): void
    {
        try {
            $serverKey = config('services.fcm.server_key'); // ضيف في config/services.php

            $response = Http::withHeaders([
                'Authorization' => 'key=' . $serverKey,
                'Content-Type'  => 'application/json',
            ])->post('https://fcm.googleapis.com/fcm/send', [
                'to'           => '/topics/' . $topic,
                'notification' => [
                    'title' => $title,
                    'body'  => $body,
                    'sound' => 'default',
                ],
                'data' => array_merge($data, [
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                ]),
            ]);

            if (!$response->successful()) {
                Log::error('FCM Error', [
                    'topic'    => $topic,
                    'response' => $response->json(),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('FCM Exception: ' . $e->getMessage(), ['topic' => $topic]);
        }
    }

    // ==========================================
    // عرض قائمة الطلبات الخاصة
    // ==========================================
    public function index()
    {
        $specialRequests = SpecialRequest::with(['cook', 'recipe'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('users.special.index', compact('specialRequests'));
    }

    // ==========================================
    // صفحة إنشاء طلب جديد
    // ==========================================
    public function create()
    {
        $user         = auth()->user();
        $cooks        = Cook::all();
        $family_members = MyFamily::where('user_id', $user->id)->get();
        $meals        = Recipe::take(10)->get();

        return view('users.special.create', compact('cooks', 'family_members', 'meals'));
    }

    // ==========================================
    // حفظ الطلب الجديد + إرسال Notification
    // ==========================================
    public function store(Request $request)
    {
        $request->validate([
            'cooking_by'   => 'required|in:family,cook',
            'cook_id'      => 'required|numeric',
            'recipe_id'    => 'required|exists:recipes,id',
            'meal_type'    => 'required|in:breakfast,lunch,dinner',
            'date'         => 'required|date|after_or_equal:today',
            'time'         => 'required',
            'attendees'    => 'nullable|array',
            'attendees.*'  => 'numeric',
            'guests_count' => 'nullable|integer|min:0',
        ]);

        $special = null;

        DB::transaction(function () use ($request, &$special) {

            // تحديد الطباخ أو فرد العائلة
            $cookData = [];
            if ($request->cooking_by === 'cook') {
                $cookData['cook_id']          = $request->cook_id;
                $cookData['family_member_id'] = null;
            } else {
                $cookData['cook_id']          = null;
                $cookData['family_member_id'] = $request->cook_id;
            }

            // إنشاء الطلب
            $special = SpecialRequest::create([
                'user_id'          => auth()->id(),
                'cook_id'          => $cookData['cook_id'],
                'family_member_id' => $cookData['family_member_id'],
                'recipe_id'        => $request->recipe_id,
                'meal_type'        => $request->meal_type,
                'date'             => $request->date,
                'time'             => $request->time,
                'guests_count'     => $request->guests_count ?? 0,
            ]);

            // حفظ الحاضرين (مع حل مشكلة الـ FK)
            if ($request->has('attendees') && is_array($request->attendees)) {
                $userAttendees   = [];
                $familyAttendees = [];
                $now             = now();

                foreach ($request->attendees as $attendeeId) {
                    $attendeeId = (int) $attendeeId;

                    if ($attendeeId === auth()->id()) {
                        $userAttendees[] = [
                            'special_request_id' => $special->id,
                            'attendee_id'        => $attendeeId,
                            'attendee_type'      => 'user',
                            'created_at'         => $now,
                            'updated_at'         => $now,
                        ];
                    } else {
                        $familyAttendees[] = [
                            'special_request_id' => $special->id,
                            'attendee_id'        => $attendeeId,
                            'attendee_type'      => 'family_member',
                            'created_at'         => $now,
                            'updated_at'         => $now,
                        ];
                    }
                }

                if (!empty($familyAttendees)) {
                    SpecialRequestAttendee::insert($familyAttendees);
                }

                if (!empty($userAttendees)) {
                    DB::statement('SET FOREIGN_KEY_CHECKS=0');
                    SpecialRequestAttendee::insert($userAttendees);
                    DB::statement('SET FOREIGN_KEY_CHECKS=1');
                }
            }
        });

        // ==========================================
        // إرسال FCM Notification بعد حفظ الطلب
        // ==========================================
        if ($special) {
            $userId  = auth()->id();
            $cookId  = $special->cook_id;

            // لو اختار طباخ محترف → نبعت له notification
            if ($cookId) {
                $topic = 'humhum_chef_' . $cookId . '_' . $userId;

                $mealTypeMap = [
                    'breakfast' => 'إفطار',
                    'lunch'     => 'غداء',
                    'dinner'    => 'عشاء',
                ];
                $mealTypeAr = $mealTypeMap[$special->meal_type] ?? $special->meal_type;

                $this->sendFcmNotification(
                    topic: $topic,
                    title: '🍽️ طلب خاص جديد',
                    body: 'لديك طلب ' . $mealTypeAr . ' بتاريخ ' . $special->date . ' الساعة ' . $special->time,
                    data: [
                        'special_request_id' => (string) $special->id,
                        'type'               => 'special_request',
                        'meal_type'          => $special->meal_type,
                        'date'               => $special->date,
                        'time'               => $special->time,
                    ]
                );
            }

            // لو اختار فرد من العائلة → مفيش notification خارجية
            // ممكن تضيف logic تانية هنا لو محتاج
        }

        return redirect()->route('users.welcome', $special->id ?? 1)
            ->with('success', 'تم إرسال الطلب بنجاح!');
    }

    // ==========================================
    // عرض تفاصيل طلب معين
    // ==========================================
    public function show($id)
    {
        $specialRequest = SpecialRequest::with(['user', 'cook', 'recipe'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('users.welcome', compact('specialRequest'));
    }

    // ==========================================
    // حذف / إلغاء طلب + إشعار للطباخ بالإلغاء
    // ==========================================
    public function destroy($id)
    {
        $specialRequest = SpecialRequest::where('user_id', auth()->id())->findOrFail($id);

        // إشعار الطباخ بالإلغاء قبل الحذف
        if ($specialRequest->cook_id) {
            $topic = 'humhum_chef_' . $specialRequest->cook_id . '_' . auth()->id();

            $this->sendFcmNotification(
                topic: $topic,
                title: '❌ تم إلغاء طلب خاص',
                body: 'تم إلغاء الطلب المجدول بتاريخ ' . $specialRequest->date,
                data: [
                    'special_request_id' => (string) $specialRequest->id,
                    'type'               => 'special_request_cancelled',
                ]
            );
        }

        $specialRequest->delete();

        return redirect()->route('users.special.index')
            ->with('success', 'تم إلغاء الطلب بنجاح');
    }

    // ==========================================
    // تحميل المزيد من الوجبات (AJAX)
    // ==========================================
    public function loadMoreMeals(Request $request)
    {
        $skip  = $request->get('skip', 0);
        $meals = Recipe::skip($skip)->take(10)->get();

        return response()->json([
            'meals'   => $meals,
            'hasMore' => $meals->count() === 10,
        ]);
    }
}
