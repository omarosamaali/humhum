<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\PushSubscription;
use App\Models\MyFamily;
use App\Models\Cook;
use App\Services\OneSignalService;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    protected $oneSignal;

    public function __construct(OneSignalService $oneSignal)
    {
        $this->oneSignal = $oneSignal;
    }

    /**
     * حفظ Player ID - يُستدعى من JavaScript
     */
    public function savePlayerId(Request $request)
    {
        $request->validate([
            'player_id' => 'required|string',
        ]);

        $userId = $this->getUserId();
        $familyId = session('family_id');
        $cookId = session('cook_id');

        PushSubscription::updateOrCreate(
            ['player_id' => $request->player_id],
            [
                'user_id' => $userId,
                'family_id' => $familyId,
                'cook_id' => $cookId,
                'device_type' => 'android'
            ]
        );

        return response()->json(['success' => true]);
    }

    /**
     * إرسال إشعار المكون غير متوفر
     */
    public function sendUnavailableNotificationFamily(Request $request)
    {
        $request->validate([
            'component_name' => 'required|string'
        ]);

        $userId = $this->getUserId();
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'المستخدم غير موجود'], 401);
        }

        $familyId = session('family_id');
        $cookId = session('cook_id');

        $userName = Auth::check()
            ? Auth::user()->name
            : ($familyId
                ? MyFamily::find($familyId)?->name
                : ($cookId
                    ? Cook::find($cookId)?->name
                    : 'مستخدم'));

        $today = now()->format('Y-m-d');
        $message = "أرسل {$userName} أن المكون '{$request->component_name}' غير متوفر بتاريخ {$today}";

        // حفظ الإشعار في قاعدة البيانات
        Notification::create([
            'user_id' => $userId,
            'family_member_id' => $familyId ?? null,
            'cook_id' => $cookId ?? null,
            'message' => $message,
            'is_read' => false
        ]);

        // ✅ إرسال Push Notification عبر OneSignal
        $title = 'مكون غير متوفر 🛒';
        $data = [
            'type' => 'unavailable_ingredient',
            'component_name' => $request->component_name,
            'sent_by' => $userName,
            'date' => $today
        ];

        // إرسال للمستخدم الرئيسي
        if ($userId) {
            $this->oneSignal->sendToUser($userId, $title, $message, $data);
        }

        return response()->json(['success' => true, 'message' => 'تم إرسال الإشعار بنجاح']);
    }

    private function getUserId()
    {
        if (Auth::check()) {
            return Auth::id();
        }
        if (session('family_id')) {
            $family = MyFamily::find(session('family_id'));
            return $family?->user_id;
        }
        if (session('cook_id')) {
            $cook = Cook::find(session('cook_id'));
            return $cook?->user_id;
        }
        return null;
    }
}
