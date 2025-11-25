<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\MyFamily;
use App\Models\Cook;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
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
            'message' => $message,
            'is_read' => false
        ]);

        // إرسال إشعار OneSignal للأب
        if ($user->onesignal_player_id) {
            $this->sendPushNotification($user->onesignal_player_id, $message);
        }

        return response()->json(['success' => true, 'message' => 'تم إرسال الإشعار بنجاح']);
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

        Notification::create([
            'user_id' => $userId,
            'message' => $message,
            'is_read' => false
        ]);

        // إرسال إشعار OneSignal للأب
        $parent = User::find($userId);
        if ($parent && $parent->onesignal_player_id) {
            $this->sendPushNotification($parent->onesignal_player_id, $message);
        }

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

    private function sendPushNotification($playerId, $message)
    {
        try {
            Http::withHeaders([
                'Authorization' => 'Key ' . env('ONESIGNAL_REST_API_KEY'),
                'Content-Type' => 'application/json'
            ])->post('https://onesignal.com/api/v1/notifications', [
                'app_id' => env('ONESIGNAL_APP_ID'),
                'include_player_ids' => [$playerId],
                'contents' => ['ar' => $message],
                'headings' => ['ar' => 'تنبيه']
            ]);
        } catch (\Exception $e) {
            Log::error('OneSignal Push Error: ' . $e->getMessage());
        }
    }
}
