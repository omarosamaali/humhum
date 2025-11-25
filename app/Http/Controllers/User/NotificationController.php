<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MyFamily;
use App\Models\Cook;
use App\Services\OneSignalService;

class NotificationController extends Controller
{
    protected $oneSignal;

    public function __construct(OneSignalService $oneSignal)
    {
        $this->oneSignal = $oneSignal;
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
        $message = "أرسل {$userName} أن المكون '{$request->component_name}' غير متوفر بتاريخ {$today}";

        // حفظ في قاعدة البيانات
        Notification::create([
            'user_id' => $userId,
            'message' => $message,
            'is_read' => false
        ]);

        // إرسال Push Notification للأب
        $user = User::find($userId);
        if ($user && $user->onesignal_player_id) {
            $this->oneSignal->sendNotification(
                $user->onesignal_player_id,
                $message,
                'مكون غير متوفر 🛒'
            );
        }

        return response()->json(['success' => true, 'message' => 'تم إرسال الإشعار بنجاح']);
    }
}
