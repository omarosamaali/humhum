<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Otp;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendOtpMail;

class ForgotPasswordController extends Controller
{
    // 📍 صفحة إدخال البريد الإلكتروني
    public function showEmailForm()
    {
        return view('users.auth.forgot-password');
    }

    // 📍 إرسال كود OTP إلى الإيميل
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.exists' => 'البريد الإلكتروني غير مسجل لدينا',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صحيح',
        ]);

        $user = User::where('email', $request->email)->first();

        // توليد كود جديد
        $otpCode = random_int(1000, 9999);

        // حذف الأكواد القديمة
        Otp::where('user_id', $user->id)->delete();

        // إنشاء كود جديد
        Otp::create([
            'user_id' => $user->id,
            'code' => $otpCode,
            'expires_at' => now()->addMinutes(10),
        ]);

        // إرسال الكود إلى البريد
        Mail::to($user->email)->send(new SendOtpMail($otpCode));

        // حفظ الإيميل في الجلسة مؤقتاً
        session(['reset_email' => $user->email]);

        return redirect()->route('users.auth.password.verify.otp')
            ->with('success', 'تم إرسال كود التحقق إلى بريدك الإلكتروني');
    }

    // 📍 صفحة إدخال كود OTP
    public function showOtpForm()
    {
        $email = session('reset_email');

        // إذا مفيش إيميل في الـ session، ارجع لصفحة إدخال الإيميل
        if (!$email) {
            return redirect()->route('users.auth.password.request')
                ->withErrors(['email' => 'الرجاء إدخال بريدك الإلكتروني أولاً']);
        }

        return view('users.auth.verify-password-otp', compact('email'));
    }

    // 📍 التحقق من كود OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'code' => ['required', 'digits:4'],
            'email' => ['required', 'email'],
        ], [
            'code.required' => 'كود التحقق مطلوب',
            'code.digits' => 'كود التحقق يجب أن يكون 4 أرقام',
        ]);

        $email = $request->email;

        if (!$email || $email !== session('reset_email')) {
            return redirect()->route('users.auth.password.request')
                ->withErrors(['email' => 'انتهت صلاحية الجلسة، أعد المحاولة.']);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['code' => 'حدث خطأ، الرجاء المحاولة مرة أخرى.']);
        }

        $otp = Otp::where('user_id', $user->id)
            ->where('code', $request->code)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otp) {
            return back()
                ->withInput()
                ->withErrors(['code' => 'كود التحقق غير صحيح أو منتهي الصلاحية.']);
        }

        // حذف الكود بعد نجاح التحقق
        $otp->delete();

        // حفظ حالة السماح بتغيير كلمة المرور
        session(['reset_password_allowed' => true]);

        return redirect()->route('users.auth.password.reset.form')
            ->with('success', 'تم التحقق بنجاح، يمكنك الآن تغيير كلمة المرور');
    }

    // 📍 صفحة تغيير كلمة المرور
    public function showResetForm()
    {
        if (!session('reset_password_allowed')) {
            return redirect()->route('users.auth.password.request')
                ->withErrors(['error' => 'الرجاء التحقق من بريدك الإلكتروني أولاً']);
        }

        $email = session('reset_email');
        return view('users.auth.reset-password', compact('email'));
    }

    // 📍 تنفيذ عملية تغيير كلمة المرور
    public function resetPassword(Request $request)
    {
        if (!session('reset_password_allowed')) {
            return redirect()->route('users.auth.password.request');
        }

        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
        ]);

        $email = session('reset_email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('users.auth.password.request')
                ->withErrors(['error' => 'حدث خطأ، الرجاء المحاولة مرة أخرى']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // حذف بيانات الجلسة المؤقتة
        session()->forget(['reset_email', 'reset_password_allowed']);

        return redirect()->route('users.auth.login')
            ->with('success', 'تم تغيير كلمة المرور بنجاح، يمكنك الآن تسجيل الدخول');
    }

    // 📍 إعادة إرسال كود OTP
    public function resendOtp(Request $request)
    {
        $email = $request->email ?? session('reset_email');

        if (!$email) {
            return back()->withErrors(['email' => 'البريد الإلكتروني مطلوب']);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'البريد الإلكتروني غير موجود']);
        }

        // توليد كود جديد
        $otpCode = random_int(1000, 9999);

        // حذف الأكواد القديمة
        Otp::where('user_id', $user->id)->delete();

        // إنشاء كود جديد
        Otp::create([
            'user_id' => $user->id,
            'code' => $otpCode,
            'expires_at' => now()->addMinutes(10),
        ]);

        // إرسال الكود إلى البريد
        Mail::to($user->email)->send(new SendOtpMail($otpCode));

        return back()->with('success', 'تم إعادة إرسال كود التحقق بنجاح');
    }
}
