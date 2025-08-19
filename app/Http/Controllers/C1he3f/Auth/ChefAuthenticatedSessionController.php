<?php

namespace App\Http\Controllers\C1he3f\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ChefProfile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;

class ChefAuthenticatedSessionController extends Controller
{
    protected $targetLanguages = [
        'id' => 'الإندونيسية',
        'am' => 'الأمهرية',
        'hi' => 'الهندية',
        'bn' => 'البنغالية',
        'ml' => 'المالايالامية',
        'fil' => 'الفلبينية',
        'ur' => 'الأردية',
        'ta' => 'التاميلية',
        'en' => 'الإنجليزية',
        'ne' => 'النيبالية',
        'ps' => 'الأفغانية',
    ];

    public function createLogin(): \Illuminate\View\View
    {
        return view('c1he3f.auth.welcome');
    }

    public function storeLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'صيغة البريد الإلكتروني غير صحيحة.',
            'password.required' => 'كلمة المرور مطلوبة.',
        ]);

        // **التحقق الإضافي للدور (Role Check) قبل محاولة تسجيل الدخول**
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || $user->system !== 'طاه') {
            return back()->withErrors([
                'email' => 'هذا الحساب غير مسجل للدخول إلى هذا النظام.',
            ])->onlyInput('email');
        }

        // لو المستخدم مش موجود أو الـ role بتاعه مش 'طاه'، ارفض تسجيل الدخول
        if (!$user || $user->role !== 'طاه') {
            throw ValidationException::withMessages([
                'email' => 'لا يمكنك تسجيل الدخول بهذا الحساب كطاه.',
            ]);
        }

        // حاول تسجيل دخول المستخدم باستخدام الحارس الافتراضي (web)
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            $user = Auth::user(); // جلب المستخدم بعد تسجيل الدخول بنجاح

            // ------------------- Account Status Redirection Logic (Chef Specific) -------------------
            // بما أننا قمنا بالتحقق من الدور مسبقًا، هذه الجزئية ستنفذ فقط للطهاة
            $chefProfile = $user->chefProfile; // تأكد أن لديك علاقة ChefProfile في موديل User

            $isProfileComplete = false;
            if ($chefProfile) {
                $isOfficialImageComplete = !empty($chefProfile->official_image);
                $isContractTypeComplete = !empty($chefProfile->contract_type);
                $isBioComplete = !empty($chefProfile->bio);
                $isContractSigned = !empty($user->contract_signed_at); // تأكد من وجود هذا الحقل في جدول users

                if ($isOfficialImageComplete && $isContractTypeComplete && $isBioComplete && $isContractSigned) {
                    $isProfileComplete = true;
                }
            }

            // توجيه بناءً على حالة المستخدم وملفه الشخصي
            if ($user->status === 'فعال') {
                return redirect()->intended(route('c1he3f.index', absolute: false));
            } elseif ($isProfileComplete && $user->status === 'بانتظار التفعيل') {
                return redirect()->intended(route('c1he3f.profile.profile', absolute: false))
                    ->with('info', 'تم إرسال بياناتك للمراجعة. يرجى الانتظار لتفعيل حسابك.');
            } elseif ($user->email_verified_at === null) {
                // إذا كان مسجل دخول لكن بريده غير مفعل، أرسله لصفحة OTP
                // تأكد أن OtpMail موجود ولديه متغير otp
                Mail::to($user->email)->send(new OtpMail($user->otp)); // إعادة إرسال OTP إذا كان البريد غير مفعل
                return redirect()->route('c1he3f.auth.otp-confirm', ['email' => $user->email])
                    ->with('info', 'بريدك الإلكتروني غير مفعل. تم إرسال رمز تحقق جديد.');
            } else {
                // إذا لم يكن مكتملًا أو حالته "بانتظار استكمال البيانات"
                return redirect()->intended(route('c1he3f.profile.profile', absolute: false))
                    ->with('warning', 'الرجاء استكمال بيانات ملفك الشخصي.');
            }
            // ------------------- End Account Status Redirection Logic -------------------
        }

        // إذا فشل تسجيل الدخول (كلمة مرور خاطئة بعد التحقق من الدور)
        throw ValidationException::withMessages([
            'email' => trans('auth.failed'), // رسالة خطأ قياسية من Laravel
        ]);
    }


    /**
     * Display the registration view. (For Chefs)
     */
    public function create(): \Illuminate\View\View // <--- هذه لعرض فورم التسجيل
    {
        return view('c1he3f.auth.sign-up');
    }

    /**
     * Handle an incoming registration request (for Chefs).
     * This method will create the user and an initial chef profile, then send OTP.
     */
    public function store(Request $request) // <--- هذه لمعالجة بيانات التسجيل
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // التحقق من أن البريد الإلكتروني فريد فقط بين الطهاة
                Rule::unique('users')->where(function ($query) {
                    return $query->where('system', 'طاه');
                }),
            ],
            'password' => 'required|string|min:8',
            'role' => 'required|in:مدير,مشرف,مدخل بيانات,طاه',
            'status' => 'sometimes|in:فعال,غير فعال,بانتظار التفعيل',
        ];

        $messages = [
            'name.required' => 'حقل الاسم مطلوب',
            'email.required' => 'حقل البريد الإلكتروني مطلوب',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح',
            'email.unique' => 'هذا البريد الإلكتروني مسجل مسبقاً', // <--- هذه الرسالة ستظهر هنا فقط
            'password.required' => 'حقل كلمة السر مطلوب',
            'password.min' => 'كلمة السر يجب أن تكون 8 أحرف على الأقل',
            'role.required' => 'حقل الصلاحية مطلوب',
        ];

        // ... (باقي كود دالة store الخاص بإنشاء المستخدم وملف الشيف وإرسال الـ OTP)
        // هذا الجزء من الكود يبدو صحيحًا لعملية التسجيل
        if ($request->role === 'طاه') {
            $rules += [
                'country' => 'nullable|string|max:255',
                'bio' => 'nullable|string',
                'contract_type' => 'nullable|in:per_recipe,annual_subscription',
                'profit_transfer_details' => 'nullable|string',
                'official_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'subscription_3_months_price' => 'nullable|numeric|min:0',
                'subscription_6_months_price' => 'nullable|numeric|min:0',
                'subscription_12_months_price' => 'nullable|numeric|min:0',
            ];
        }

        $request->validate($rules, $messages);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'system' => 'طاه', // **إضافة هذا السطر لتحديد النظام**
            'status' => $request->status ?? 'بانتظار التفعيل',
            'email_verified_at' => null,
            'otp' => null,
            'otp_expires_at' => null,
        ];

        $tr = new GoogleTranslate();
        foreach ($this->targetLanguages as $code => $name) {
            $columnName = 'name_' . $code;
            try {
                if (in_array($columnName, (new User())->getFillable())) {
                    $userData[$columnName] = $tr->setTarget($code)->translate($request->input('name'));
                }
            } catch (\Exception $e) {
                $userData[$columnName] = null;
                Log::error("Translation failed for {$code} (User Store): " . $e->getMessage());
            }
        }

        $user = User::create($userData);

        if ($request->role === 'طاه') {
            $otp = (string)random_int(100000, 999999);
            $otpExpiresAt = Carbon::now()->addMinutes(config('auth.passwords.otp_expire_minutes', 5));

            $user->forceFill([
                'otp' => $otp,
                'otp_expires_at' => $otpExpiresAt,
            ])->save();

            Mail::to($user->email)->send(new OtpMail($otp));

            $chefProfileData = [
                'user_id' => $user->id,
                'country' => $request->country,
                'bio' => $request->bio,
                'contract_type' => $request->contract_type,
                'profit_transfer_details' => $request->profit_transfer_details,
            ];

            if ($request->hasFile('official_image')) {
                $imagePath = $request->file('official_image')->store('chef_images', 'public');
                $chefProfileData['official_image'] = $imagePath;
            }

            if ($request->contract_type === 'annual_subscription') {
                $chefProfileData['subscription_3_months'] = $request->subscription_3_months_price;
                $chefProfileData['subscription_6_months'] = $request->subscription_6_months_price;
                $chefProfileData['subscription_12_months'] = $request->subscription_12_months_price;
            } else {
                $chefProfileData['subscription_3_months'] = null;
                $chefProfileData['subscription_6_months'] = null;
                $chefProfileData['subscription_12_months'] = null;
            }

            ChefProfile::create($chefProfileData);

            return redirect()->route('c1he3f.auth.otp-confirm', ['email' => $user->email])
                ->with('success', 'تم التسجيل بنجاح! الرجاء إدخال رمز التحقق الذي تم إرساله إلى بريدك الإلكتروني.');
        } else {
            Auth::login($user);
            return redirect()->route('admin.users.index')
                ->with('success', 'تم إضافة المستخدم بنجاح.');
        }
    }

    // ... (باقي الدوال: showOtpConfirmForm, verifyOtp, resendOtp)
    // هذه الدوال تبدو صحيحة ومكانها هنا، ولكن ستحتاج إلى دالة destroy لـ logout
    /**
     * Display the OTP confirmation form.
     */
    public function showOtpConfirmForm(Request $request): \Illuminate\View\View
    {
        return view('c1he3f.auth.otp-confirm', ['email' => $request->query('email')]);
    }

    /**
     * Handle OTP verification.
     * This method will update the user's email_verified_at and status,
     * then redirect based on chef profile completion status.
     */
    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp_digit_1' => ['required', 'string', 'digits:1'],
            'otp_digit_2' => ['required', 'string', 'digits:1'],
            'otp_digit_3' => ['required', 'string', 'digits:1'],
            'otp_digit_4' => ['required', 'string', 'digits:1'],
            'otp_digit_5' => ['required', 'string', 'digits:1'],
            'otp_digit_6' => ['required', 'string', 'digits:1'],
        ]);

        $fullOtp = $request->otp_digit_1 . $request->otp_digit_2 . $request->otp_digit_3 .
            $request->otp_digit_4 . $request->otp_digit_5 . $request->otp_digit_6;

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'المستخدم غير موجود.']);
        }

        if ($user->otp !== $fullOtp || Carbon::now()->isAfter($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'رمز التحقق غير صحيح أو انتهت صلاحيته.']);
        }

        $user->forceFill([
            'email_verified_at' => Carbon::now(),
            'otp' => null,
            'otp_expires_at' => null,
            'status' => 'بإنتظار إستكمال البيانات',
        ])->save();

        Auth::login($user);

        if ($user->role === 'طاه') {
            $chefProfile = $user->chefProfile;

            $isProfileComplete = false;
            if ($chefProfile) {
                $isOfficialImageComplete = !empty($chefProfile->official_image);
                $isContractTypeComplete = !empty($chefProfile->contract_type);
                $isBioComplete = !empty($chefProfile->bio);
                $isContractSigned = !empty($user->contract_signed_at);

                if (
                    $isOfficialImageComplete &&
                    $isContractTypeComplete &&
                    $isBioComplete &&
                    $isContractSigned
                ) {
                    $isProfileComplete = true;
                }
            }

            if ($user->status == 'فعال') {
                return redirect()->intended(route('c1he3f.index', absolute: false));
            } elseif ($isProfileComplete && $user->status == 'بانتظار التفعيل') {
                return redirect()->intended(route('c1he3f.profile.profile', absolute: false));
            } else {
                return redirect()->intended(route('c1he3f.profile.profile', absolute: false));
            }
        }

        return redirect()->intended(route('c1he3f.index', absolute: false));
    }

    /**
     * Resend OTP for email verification.
     */
    public function resendOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'المستخدم غير موجود.');
        }

        if ($user->otp_expires_at && Carbon::now()->lessThan($user->otp_expires_at->subMinutes(config('auth.passwords.otp_expire_minutes', 5) - 1))) {
            return back()->with('warning', 'الرجاء الانتظار قليلاً قبل إعادة إرسال رمز التحقق.');
        }

        $newOtp = (string)random_int(100000, 999999);
        $newOtpExpiresAt = Carbon::now()->addMinutes(config('auth.passwords.otp_expire_minutes', 5));

        $user->forceFill([
            'otp' => $newOtp,
            'otp_expires_at' => $newOtpExpiresAt,
        ])->save();

        Mail::to($user->email)->send(new OtpMail($newOtp));

        return back()->with('success', 'تم إعادة إرسال رمز التحقق إلى بريدك الإلكتروني.');
    }

    /**
     * Log the user out of the application.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout(); // استخدم الحارس الصحيح إذا كان لديك حارس مخصص للطهاة

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('c1he3f.auth.sign-in'); // أو أي صفحة تسجيل دخول تريدها
    }
}
