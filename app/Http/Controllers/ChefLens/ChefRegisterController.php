<?php

namespace App\Http\Controllers\ChefLens;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; // تأكد من إضافة هذا السطر

class ChefRegisterController extends Controller
{
    /**
     * يعرض صفحة تسجيل حساب المستخدم.
     */
    public function showRegistrationForm()
    {
        return view('chef_lens.auth.sign-up');
    }

    /**
     * يعالج طلب تسجيل حساب مستخدم جديد.
     */
    public function register(Request $request)
    {
        // 1. التحقق من صحة البيانات
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // التحقق من أن البريد الإلكتروني فريد فقط بين المستخدمين العاديين
                Rule::unique('users')->where(function ($query) {
                    return $query->where('system', 'مستخدم');
                }),
            ],
            'password' => ['required', 'string', 'min:8'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 2. تخزين الصورة الرمزية
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        // 3. إنشاء المستخدم
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $avatarPath,
            'role' => 'مستخدم', // تحديد نوع المستخدم كـ "مستخدم"
            'system' => 'مستخدم', // **إضافة هذا السطر لتحديد النظام**
            'status' => 'فعال'
        ]);

        // 4. تسجيل الدخول تلقائيًا
        Auth::login($user);

        // 5. إعادة التوجيه إلى صفحة 'chef_lens'
        return redirect()->route('chef_lens')->with('success', 'تم إنشاء حسابك بنجاح!');
    }
}
