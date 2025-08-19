<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        $user = User::where('email', $credentials['email'])
            ->where('system', 'مدير')
            ->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'هذا الحساب غير مسجل للدخول إلى لوحة الإدارة.',
            ]);
        }

        // التحقق من كلمة المرور
        if (!Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
            ]);
        }

        // تسجيل الدخول يدوياً
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard', absolute: false));
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
