<?php

namespace App\Http\Controllers\ChefLens;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class LoginController extends Controller
{
    /**
     * يعرض صفحة تسجيل الدخول.
     */
    public function showLoginForm()
    {
        return view('chef_lens.auth.sign-in');
    }

    /**
     * يعالج طلب تسجيل الدخول.
     */
    public function login(Request $request)
    {
        // التحقق من صحة البيانات
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // البحث عن المستخدم أولاً للتحقق من عمود system
        $user = User::where('email', $credentials['email'])->first();

        // التحقق من وجود المستخدم وأن عمود system يساوي "مستخدم"
        if (!$user || $user->system !== 'مستخدم') {
            return back()->withErrors([
                'email' => 'هذا الحساب غير مسجل للدخول إلى هذا النظام.',
            ])->onlyInput('email');
        }

        // التحقق من كلمة المرور
        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
            ])->onlyInput('email');
        }

        // تسجيل الدخول يدوياً
        Auth::login($user);
        $request->session()->regenerate();

        // إعادة التوجيه بناءً على نوع المستخدم
        if (Auth::user()->user_type === 'مستخدم') {
            return redirect()->route('chef_lens');
        }

        return redirect()->intended('chef_lens');
    }

    /**
     * يعالج طلب تسجيل الخروج.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('chef_lens.login');
    }

    public function sendResetLink(Request $request)
    {
        // التحقق من وجود البريد الإلكتروني
        $request->validate(['email' => 'required|email|exists:users,email']);

        // البحث عن المستخدم والتحقق من عمود system
        $user = User::where('email', $request->email)
            ->where('system', 'مستخدم')
            ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'هذا البريد الإلكتروني غير مسجل في النظام أو غير مخول.',
            ])->onlyInput('email');
        }

        // إنشاء رمز OTP عشوائي
        $otp = random_int(100000, 999999);

        // تخزين الرمز في الجلسة
        $request->session()->put('otp_email', $user->email);
        $request->session()->put('otp_code', $otp);

        // إرسال البريد الإلكتروني
        Mail::raw("رمز التحقق الخاص بك هو: " . $otp, function ($message) use ($user) {
            $message->to($user->email)->subject('رمز التحقق لاستعادة كلمة المرور');
        });

        return redirect()->route('chef_lens.otp-confirm')->with('success', 'تم إرسال رمز التحقق إلى بريدك الإلكتروني.');
    }

    public function verifyOtp(Request $request)
    {
        // التحقق من صحة الرمز
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $storedOtp = $request->session()->get('otp_code');
        $storedEmail = $request->session()->get('otp_email');

        // التحقق من الرمز المُدخل مع الرمز المخزن في الجلسة
        if ($request->otp == $storedOtp && $storedEmail) {
            // الرمز صحيح، قم بإزالة الرمز من الجلسة
            $request->session()->forget(['otp_code']);

            // إعادة التوجيه إلى صفحة تغيير كلمة المرور
            return redirect()->route('chef_lens.change-password');
        }

        // الرمز غير صحيح
        return back()->with('error', 'رمز التحقق غير صحيح. حاول مرة أخرى.');
    }

    public function changePassword(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        // البحث عن المستخدم مع التحقق من عمود system
        $user = User::where('email', $request->email)
            ->where('system', 'مستخدم')
            ->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            // مسح البريد الإلكتروني من الجلسة
            $request->session()->forget('otp_email');

            return redirect()->route('chef_lens.login')->with('status', 'تم تغيير كلمة المرور بنجاح. يمكنك الآن تسجيل الدخول.');
        }

        return back()->with('error', 'لا يمكن العثور على المستخدم أو الحساب غير مخول.');
    }

    public function destroy()
    {
        $user = Auth::user();

        // تحقق من وجود المستخدم وأن عمود system يساوي "مستخدم"
        if ($user && $user->system === 'مستخدم') {
            $user->delete();
            Auth::logout();

            return redirect('/')->with('status', 'تم حذف حسابك بنجاح.');
        }

        return back()->with('error', 'لا يمكن حذف هذا الحساب أو الحساب غير موجود.');
    }
}
