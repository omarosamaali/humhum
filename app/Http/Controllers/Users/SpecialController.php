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
use App\Models\SpecialRequestAttendee;

class SpecialController extends Controller
{
    public function index()
    {
        $specialRequests = SpecialRequest::with(['cook', 'recipe'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('users.special.index', compact('specialRequests'));
    }

    public function create()
    {
        $user = auth()->user();
        $cooks = Cook::all();
        $family_members = MyFamily::where('user_id', $user->id)->get();
        $meals = Recipe::take(10)->get();
        return view('users.special.create', compact('cooks', 'family_members', 'meals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cooking_by' => 'required|in:family,cook',
            'cook_id' => 'required|numeric',
            'recipe_id' => 'required|exists:recipes,id',
            'meal_type' => 'required|in:breakfast,lunch,dinner',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'attendees' => 'nullable|array',
            'attendees.*' => 'numeric',
            'guests_count' => 'nullable|integer|min:0',
        ]);

        DB::transaction(function () use ($request) {
            // تحديد أي عمود نستخدم بناءً على cooking_by
            $cookData = [];

            if ($request->cooking_by === 'cook') {
                // لو اختار طباخ محترف
                $cookData['cook_id'] = $request->cook_id;
                $cookData['family_member_id'] = null;
            } else {
                // لو اختار فرد من العائلة
                $cookData['cook_id'] = null;
                $cookData['family_member_id'] = $request->cook_id;
            }

            // إنشاء الطلب
            $special = SpecialRequest::create([
                'user_id' => auth()->id(),
                'cook_id' => $cookData['cook_id'],
                'family_member_id' => $cookData['family_member_id'],
                'recipe_id' => $request->recipe_id,
                'meal_type' => $request->meal_type,
                'date' => $request->date,
                'time' => $request->time,
                'guests_count' => $request->guests_count ?? 0,
            ]);

            // حفظ الحاضرين
            // حفظ الحاضرين
            if ($request->has('attendees') && is_array($request->attendees)) {
                $userAttendees = [];
                $familyAttendees = [];

                foreach ($request->attendees as $attendeeId) {
                    $attendeeId = (int) $attendeeId;
                    $now = now();

                    if ($attendeeId === auth()->id()) {
                        $userAttendees[] = [
                            'special_request_id' => $special->id,
                            'attendee_id' => $attendeeId,
                            'attendee_type' => 'user',
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    } else {
                        $familyAttendees[] = [
                            'special_request_id' => $special->id,
                            'attendee_id' => $attendeeId,
                            'attendee_type' => 'family_member',
                            'created_at' => $now,
                            'updated_at' => $now,
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

        return redirect()->route('users.welcome', $special->id ?? 1)
            ->with('success', 'تم إرسال الطلب بنجاح!');
    }

    public function show($id)
    {
        $specialRequest = SpecialRequest::with(['user', 'cook', 'recipe'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('users.welcome', compact('specialRequest'));
    }

    public function destroy($id)
    {
        $specialRequest = SpecialRequest::where('user_id', auth()->id())->findOrFail($id);

        $specialRequest->delete();

        return redirect()->route('users.special.index')
            ->with('success', 'تم إلغاء الطلب بنجاح');
    }

    public function loadMoreMeals(Request $request)
    {
        $skip = $request->get('skip', 0);
        $meals = Recipe::skip($skip)->take(10)->get();

        return response()->json([
            'meals' => $meals,
            'hasMore' => $meals->count() === 10
        ]);
    }
}
