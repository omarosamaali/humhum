<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\SendOtpMail;
use App\Models\User;
use App\Models\MyFamily;
use App\Models\Otp;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create()
    {
        $countries = config('countries');
        $membershipNumber = random_int(10000, 99999);
        return view('users.auth.register', compact('membershipNumber', 'countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'membership_number' => ['required', 'string', 'max:255', Rule::unique('users')],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')],
            'password' => ['required'],
            'country' => ['nullable', 'string', 'max:255'],
        ]);

        // إنشاء المستخدم
        $user = User::create([
            'name' => $request->name,
            'membership_number' => $request->membership_number,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'مستخدم',
            'system' => 'مستخدم',
            'status' => 'مجاني',
            'country' => $request->country,
        ]);

        
        // إنشاء كود تحقق 4 أرقام
        $otpCode = random_int(1000, 9999);
        
        Otp::create([
            'user_id' => $user->id,
            'code' => $otpCode,
            'expires_at' => now()->addMinutes(10),
        ]);
        
        // إرسال الإيميل
        Mail::to($user->email)->send(new SendOtpMail($otpCode));
        
        MyFamily::create([
            'name' => $request->name,
            'language' => 'العربية',
            'user_id' => $user->id,
            'has_email' => '1',
            'send_notification' => '1',
            'owner' => '1',
        ]);
        // توجيه المستخدم لصفحة إدخال الكود
        return redirect()->route('users.register.verify.otp', ['email' => $user->email]);
    }
}
