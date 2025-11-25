<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MyFamily;
use App\Models\Cook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
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

    public function create()
    {
        return view('users.auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // البحث عن المستخدم بالإيميل
        $user = User::where('email', $credentials['email'])->first();

        // مقارنة الباسورد مباشرة بدون تشفير
        if (!$user || $user->password !== $credentials['password']) {
            throw ValidationException::withMessages([
                'email' => __('البريد الإلكتروني أو كلمة المرور غير صحيحة'),
            ]);
        }

        // تسجيل دخول المستخدم يدوياً
        Auth::login($user, true);

        $request->session()->regenerate();

        if ($request->filled('onesignal_player_id')) {
            $user->update(['onesignal_player_id' => $request->onesignal_player_id]);
        }

        return redirect()->intended(route('users.welcome', absolute: false))
            ->with('success', 'تم تسجيل الدخول بنجاح');
    }
    public function saveFcmToken(Request $request)
    {
        $request->validate(['fcm_token' => 'required|string']);

        auth()->user()->update([
            'fcm_token' => $request->fcm_token
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('users.auth.login')
            ->with('success', 'تم تسجيل الخروج بنجاح');
    }
}
