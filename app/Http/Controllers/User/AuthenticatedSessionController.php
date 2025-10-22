<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
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

        return redirect()->intended(route('users.welcome', absolute: false))
            ->with('success', 'تم تسجيل الدخول بنجاح');
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
