<?php

namespace App\Http\Controllers\ChefLens;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail; // تأكد من إضافة هذا السطر
use App\Mail\OtpMail; // تأكد من إنشاء هذا الـ mailable (اختياري، يمكنك استخدام Mail::raw)

class LoginController extends Controller
{
    /**
     * يعرض صفحة تسجيل الدخول.
     */
    public function showLoginForm()
    {
        return view('chef_lens.auth.sign-in'); // اسم ملف الـ blade الخاص بصفحة تسجيل الدخول
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

        // محاولة تسجيل الدخول
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // إعادة التوجيه بناءً على نوع المستخدم (اختياري)
            if (Auth::user()->user_type === 'مستخدم') {
                return redirect()->route('chef_lens');
            }

            return redirect()->intended('chef_lens'); // صفحة التوجيه الافتراضية
        }

        // فشل تسجيل الدخول
        return back()->withErrors([
            'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
        ])->onlyInput('email');
    }

    /**
     * يعالج طلب تسجيل الخروج.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // The redirect here is causing the error. 
        // It should be changed to the correct route name.
        return redirect()->route('chef_lens.login');
    }

    public function sendResetLink(Request $request)
    {
        // 1. التحقق من وجود البريد الإلكتروني
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->first();

        // 2. إنشاء رمز OTP عشوائي (على سبيل المثال، 6 أرقام)
        $otp = random_int(100000, 999999);

        // 3. تخزين الرمز في الجلسة مؤقتًا أو في قاعدة البيانات
        $request->session()->put('otp_email', $user->email);
        $request->session()->put('otp_code', $otp);

        // 4. إرسال البريد الإلكتروني (مثال بسيط)
        // ملاحظة: يجب عليك إعداد بيانات SMTP في ملف .env
        Mail::raw("رمز التحقق الخاص بك هو: " . $otp, function ($message) use ($user) {
            $message->to($user->email)->subject('رمز التحقق لاستعادة كلمة المرور');
        });

        // 5. إعادة التوجيه إلى صفحة تأكيد رمز التحقق
        return redirect()->route('chef_lens.otp-confirm')->with('success', 'تم إرسال رمز التحقق إلى بريدك الإلكتروني.');
    }
    public function verifyOtp(Request $request)
    {
        // 1. التحقق من صحة الرمز
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $storedOtp = $request->session()->get('otp_code');
        $storedEmail = $request->session()->get('otp_email');

        // 2. التحقق من الرمز المُدخل مع الرمز المخزن في الجلسة
        if ($request->otp == $storedOtp && $storedEmail) {
            // الرمز صحيح، قم بإزالة الرمز من الجلسة
            $request->session()->forget(['otp_code']);

            // 3. إعادة التوجيه إلى صفحة تغيير كلمة المرور
            return redirect()->route('chef_lens.change-password');
        }

        // 4. الرمز غير صحيح، قم بالعودة مع رسالة خطأ
        return back()->with('error', 'رمز التحقق غير صحيح. حاول مرة أخرى.');
    }

    public function changePassword(Request $request)
    {
        // 1. التحقق من صحة البيانات
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8', // 'confirmed' تتأكد أن 'password_confirmation' تتطابق مع 'password'
        ]);

        // 2. البحث عن المستخدم وتحديث كلمة المرور
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            // 3. مسح البريد الإلكتروني من الجلسة بعد نجاح العملية
            $request->session()->forget('otp_email');
        }

        // 4. إعادة التوجيه إلى صفحة تسجيل الدخول مع رسالة نجاح
        return redirect()->route('chef_lens.login')->with('status', 'تم تغيير كلمة المرور بنجاح. يمكنك الآن تسجيل الدخول.');
    }

    public function destroy()
    {
        $user = Auth::user();

        // تحقق من وجود المستخدم ثم قم بحذف حسابه
        if ($user) {
            $user->delete();

            // تسجيل الخروج بعد حذف الحساب
            Auth::logout();

            return redirect('/')->with('status', 'تم حذف حسابك بنجاح.');
        }

        return back()->with('error', 'لا يمكن العثور على المستخدم.');
    }
}
