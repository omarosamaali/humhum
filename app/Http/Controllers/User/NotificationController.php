<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MyFamily;
use App\Models\Cook;
use App\Services\OneSignalService;
use App\Models\FcmTopic;
use Kreait\Firebase\Messaging\CloudMessage;

class NotificationController extends Controller
{
    protected $oneSignal;

    public function __construct(OneSignalService $oneSignal)
    {
        $this->oneSignal = $oneSignal;
    }

    public function subscribeTopic(Request $request)
    {
        $request->validate([
            'fcm_token' => 'required|string',
            'user_id' => 'required|integer'
        ]);

        $userId = $request->user_id;
        $fcmToken = $request->fcm_token;

        // إنشاء التوبيك (نفس الطريقة اللي في Firebase Console)
        $topic = "humhum_user_" . $userId;

        try {
            // حفظ في قاعدة البيانات
            FcmTopic::updateOrCreate(
                ['user_id' => $userId],
                [
                    'fcm_token' => $fcmToken,
                    'topic' => $topic
                ]
            );

            // الاشتراك في التوبيك في Firebase
            $messaging = app('firebase.messaging');
            $messaging->subscribeToTopic($topic, $fcmToken);

            \Log::info("✅ User $userId subscribed to topic: $topic");

            return response()->json([
                'success' => true,
                'message' => 'تم الاشتراك بنجاح',
                'topic' => $topic
            ]);
        } catch (\Exception $e) {
            \Log::error("❌ Subscribe Error: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('users.notifications.index', compact('notifications'));
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return response()->json(['success' => true]);
    }

    public function sendUnavailableNotification(Request $request)
    {
        $request->validate([
            'component_name' => 'required|string'
        ]);
        $user = Auth::user();
        $today = now()->format('Y-m-d');
        $message = "أرسل " . $user->name . " أن المكون " . $request->component_name . " غير متوفر بتاريخ " . $today;
        Notification::create([
            'user_id' => $user->id,
            'family_member_id' => $familyId ?? null,
            'cook_id' => $cookId ?? null,
            'message' => $message,
            'is_read' => false
        ]);
        return response()->json(['success' => true, 'message' => 'تم إرسال الإشعار بنجاح']);
    }

    private function getUserId()
    {
        if (Auth::check()) {
            return Auth::id();
        }
        if (session('is_family_logged_in') && session('family_id')) {
            return MyFamily::find(session('family_id'))?->user_id;
        }
        if (session('is_cook_logged_in') && session('cook_id')) {
            return Cook::find(session('cook_id'))?->user_id;
        }
        return null;
    }

    public function sendUnavailableNotificationFamily(Request $request)
    {
        $request->validate([
            'component_name' => 'required|string'
        ]);

        $userId = $this->getUserId();
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'المستخدم غير موجود'], 401);
        }

        $userName = Auth::check()
            ? Auth::user()->name
            : (session('family_id')
                ? MyFamily::find(session('family_id'))?->name
                : (session('cook_id')
                    ? Cook::find(session('cook_id'))?->name
                    : 'مستخدم'));

        $today = now()->format('Y-m-d');
        $messageContent = "أرسل {$userName} أن المكون '{$request->component_name}' غير متوفر بتاريخ {$today}";

        // 1. حفظ في قاعدة البيانات
        Notification::create([
            'user_id' => $userId,
            'message' => $messageContent,
            'is_read' => false
        ]);

        // 2. إرسال لـ Firebase لجميع الـ Topics
        try {
            $messaging = app('firebase.messaging');
            $userTopics = FcmTopic::where('user_id', $userId)->get();

            if ($userTopics->isNotEmpty()) {
                foreach ($userTopics as $userTopic) {
                    if ($userTopic->topic) {
                        $fcmMessage = CloudMessage::withTarget('topic', $userTopic->topic)
                            ->withNotification([
                                'title' => 'مكون غير متوفر 🛒',
                                'body'  => $messageContent
                            ])
                            ->withData([
                                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                                'component'    => $request->component_name,
                                'type'         => 'ingredient_unavailable'
                            ]);

                        $messaging->send($fcmMessage);
                        \Log::info("✅ FCM Unavailable sent to: {$userTopic->topic}");
                    }
                }
            }
        } catch (\Exception $e) {
            \Log::error("❌ Firebase Error: " . $e->getMessage());
        }

        // 3. تعديل استدعاء موديل User (هنا كان الخطأ)
        // نستخدم \App\Models\User بدلاً من User فقط لتجنب خطأ الـ Namespace
        $user = \App\Models\User::find($userId);
        if ($user && isset($user->onesignal_player_id) && $user->onesignal_player_id) {
            try {
                $this->oneSignal->sendNotification(
                    $user->onesignal_player_id,
                    $messageContent,
                    'مكون غير متوفر 🛒'
                );
            } catch (\Exception $e) {
                \Log::error("❌ OneSignal Error: " . $e->getMessage());
            }
        }

        return response()->json(['success' => true, 'message' => 'تم إرسال الإشعار بنجاح']);
    }
}
