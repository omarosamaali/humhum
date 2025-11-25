<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MyFamily;
use App\Models\Cook;
use Illuminate\Support\Facades\Log;
use OneSignal;

class NotificationController extends Controller
{
    public function saveOneSignalId(Request $request)
    {
        $request->validate(['player_id' => 'required|string']);

        auth()->user()->update([
            'onesignal_player_id' => $request->player_id
        ]);

        return response()->json(['success' => true]);
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
        $request->validate(['component_name' => 'required|string']);

        $senderId = $this->getUserId();
        if (!$senderId) return response()->json(['success' => false], 401);

        $senderName = Auth::check() ? Auth::user()->name
            : (session('family_id') ? MyFamily::find(session('family_id'))?->name
                : Cook::find(session('cook_id'))?->name ?? 'مستخدم');

        $today = now()->format('Y-m-d');
        $message = "أرسل {$senderName} أن المكون '{$request->component_name}' غير متوفر اليوم {$today}";

        // جلب الـ user الأساسي (الأب)
        $parentUserId = session('is_family_logged_in')
            ? MyFamily::find(session('family_id'))?->user_id
            : (session('is_cook_logged_in')
                ? Cook::find(session('cook_id'))?->user_id
                : $senderId);

        $parent = \App\Models\User::find($parentUserId);

        // إرسال الإشعار عبر OneSignal
        if ($parent?->onesignal_player_id) {
            OneSignal::sendNotificationToUser(
                $message,
                $parent->onesignal_player_id,
                null, // url
                null, // data
                "مكون ناقص", // title
                null,
                null,
                "default"
            );
        }

        // حفظ في قاعدة البيانات
        Notification::create([
            'user_id' => $parentUserId,
            'message' => $message,
            'is_read' => false
        ]);

        return response()->json(['success' => true, 'message' => 'تم الإرسال بنجاح']);
    }
}
