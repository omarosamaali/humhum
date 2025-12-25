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
            'fcm_token' => ['nullable', 'string'],
        ]);
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || $user->password !== $credentials['password']) {
            throw ValidationException::withMessages([
                'email' => __('البريد الإلكتروني أو كلمة المرور غير صحيحة'),
            ]);
        }
        Auth::login($user, true);
        $request->session()->regenerate();
        if ($request->filled('fcm_token')) {
            $user->update(['fcm_token' => $request->fcm_token]);
        }
        return redirect()->route('auth.login-success');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('users.auth.login')
            ->with('success', 'تم تسجيل الخروج بنجاح');
    }

    public function loginSuccess()
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login');
        }
        return view('auth.login-success');
    }
}
