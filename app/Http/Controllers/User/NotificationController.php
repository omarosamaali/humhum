<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MyFamily;
use App\Models\Cook;
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
        // if ($notification->user_id !== Auth::id()) {
        //     abort(403);
        // }
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

        Notification::create([
            'user_id' => $userId,
            'family_member_id' => $familyId ?? null,
            'cook_id' => $cookId ?? null,
            'message' => $message,
            'is_read' => false
        ]);

        return response()->json(['success' => true, 'message' => 'تم إرسال الإشعار بنجاح']);
    }

    // public function sendStartCookingNotification(Request $request)
    // {
    //     Log::info('=== sendStartCookingNotification CALLED ===', [
    //         'cook_id' => session('cook_id'),
    //         'family_id' => session('family_id'),
    //         'auth_id' => Auth::id()
    //     ]);

    //     $request->validate([
    //         'meal_name' => 'required|string'
    //     ]);

    //     $user = Auth::user();
    //     $familyId = session('family_id');
    //     $cookId = session('cook_id');

    //     if ($cookId) {
    //         $user = Cook::find($cookId);
    //         $message = "الطاهي {$user->name} بدأ في طبخ وصفة {$request->meal_name}";
    //     } elseif ($familyId) {
    //         $user = MyFamily::find($familyId);
    //         $message = "أحد أفراد العائلة {$user->name} بدأ في طبخ وصفة {$request->meal_name}";
    //     }

    //     if (!$user) {
    //         Log::warning('No user found in sendStartCookingNotification', [
    //             'auth' => Auth::id(),
    //             'family_id' => $familyId,
    //             'cook_id' => $cookId
    //         ]);
    //         return response()->json(['success' => false, 'message' => 'لم يتم العثور على المستخدم']);
    //     }

    //     // ✅ إنشاء رسالة مناسبة حسب نوع المستخدم
    //     if ($cookId) {
    //         $message = "الطاهي {$user->name} بدأ في طبخ وصفة {$request->meal_name}";
    //     } elseif ($familyId) {
    //         $message = "أحد أفراد العائلة {$user->name} بدأ في طبخ وصفة {$request->meal_name}";
    //     } else {
    //         $message = "تم البدء في طبخ وصفة {$request->meal_name}";
    //     }

    //     // ✅ إنشاء الإشعار باستخدام cook_id فقط لو المستخدم طاهٍ
    //     Notification::create([
    //         'user_id' => Auth::id(),
    //         'family_member_id' => $familyId ?? null,
    //         'cook_id' => $cookId ?? null,
    //         'message' => $message,
    //         'is_read' => false
    //     ]);

    //     Log::info('Notification created successfully', [
    //         'type' => $cookId ? 'Cook' : ($familyId ? 'Family' : 'User'),
    //         'user' => $user->name
    //     ]);

    //     return response()->json(['success' => true]);
    // }
}
