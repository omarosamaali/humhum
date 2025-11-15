<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ChefProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Recipe;

class UserController extends Controller
{
    protected $targetLanguages = [
        'ar' => 'العربية',
        'id' => 'الإندونيسية',
        'am' => 'الأمهرية',
        'hi' => 'الهندية',
        'bn' => 'البنغالية',
        'ml' => 'المالايالامية',
        'fil' => 'الفلبينية',
        'ur' => 'الأردية',
        'ta' => 'التاميلية',
        'ps' => 'الباشتو',
    ];

    public function index(Request $request)
    {
        $query = User::latest();
        $query->with(['chefProfile' => function ($q) {}]);
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }
        $users = $query->paginate(10);
        return view('admin.users.index', compact('users'));
    }


    public function updateChefAgreementType(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'طاه') {
            return redirect()->route('sign-in.get')->with('error', 'لا تملك الصلاحية للوصول لهذه الصفحة.');
        }

        $user = Auth::user();

        $rules = [
            'contract_type' => 'required|in:per_recipe,annual_subscription',
            'subscription_3_months_price' => 'nullable|numeric|min:0',
            'subscription_6_months_price' => 'nullable|numeric|min:0',
            'subscription_12_months_price' => 'nullable|numeric|min:0',
        ];

        $messages = [
            'contract_type.required' => 'حقل نوع التعاقد مطلوب.',
            'contract_type.in' => 'قيمة غير صالحة لحقل نوع التعاقد.',
            'subscription_3_months_price.numeric' => 'يجب أن يكون سعر اشتراك 3 شهور رقمًا.',
            'subscription_6_months_price.numeric' => 'يجب أن يكون سعر اشتراك 6 شهور رقمًا.',
            'subscription_12_months_price.numeric' => 'يجب أن يكون سعر اشتراك 12 شهرًا رقمًا.',
            'subscription_3_months_price.min' => 'يجب أن يكون سعر اشتراك 3 شهور قيمة موجبة.',
            'subscription_6_months_price.min' => 'يجب أن يكون سعر اشتراك 6 شهور قيمة موجبة.',
            'subscription_12_months_price.min' => 'يجب أن يكون سعر اشتراك 12 شهرًا قيمة موجبة.',
        ];

        if ($request->contract_type === 'annual_subscription') {
            $rules['subscription_3_months_price'] .= '|required_if:contract_type,annual_subscription,' .
                '|required_if:subscription_6_months_price,"",null,' .
                '|required_if:subscription_12_months_price,"",null';
            $rules['subscription_6_months_price'] .= '|required_if:contract_type,annual_subscription,' .
                '|required_if:subscription_3_months_price,"",null,' .
                '|required_if:subscription_12_months_price,"",null';
            $rules['subscription_12_months_price'] .= '|required_if:contract_type,annual_subscription,' .
                '|required_if:subscription_3_months_price,"",null,' .
                '|required_if:subscription_6_months_price,"",null';
            $messages += [
                'subscription_3_months_price.required_if' => 'عند اختيار الاشتراك السنوي، يجب إدخال سعر اشتراك 3 شهور أو 6 شهور أو 12 شهرًا على الأقل.',
                'subscription_6_months_price.required_if' => 'عند اختيار الاشتراك السنوي، يجب إدخال سعر اشتراك 3 شهور أو 6 شهور أو 12 شهرًا على الأقل.',
                'subscription_12_months_price.required_if' => 'عند اختيار الاشتراك السنوي، يجب إدخال سعر اشتراك 3 شهور أو 6 شهور أو 12 شهرًا على الأقل.',
            ];
        }

        $validatedData = $request->validate($rules, $messages);

        // تحديث الوصفات بس لو التعاقد اتغير من annual_subscription إلى per_recipe
        if ($validatedData['contract_type'] === 'per_recipe' && $user->chefProfile->contract_type === 'annual_subscription') {
            $statusRecipes = Recipe::where('status', 1)->update(['status' => 0]);
            \Log::info("Updated $statusRecipes recipes to status 1");
        }

        $chefProfile = $user->chefProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'contract_type' => $validatedData['contract_type'],
                'subscription_3_months_price' => ($validatedData['contract_type'] === 'annual_subscription') ? $validatedData['subscription_3_months_price'] : null,
                'subscription_6_months_price' => ($validatedData['contract_type'] === 'annual_subscription') ? $validatedData['subscription_6_months_price'] : null,
                'subscription_12_months_price' => ($validatedData['contract_type'] === 'annual_subscription') ? $validatedData['subscription_12_months_price'] : null,
            ]
        );

        return redirect()->route('c1he3f.profile.profile')->with('success', 'تم تحديث نوع التعاقد بنجاح!');
    }
    public function updateChefBio(Request $request)
    {
        // 1. التأكد أن المستخدم مسجل الدخول
        if (!Auth::check()) {
            return redirect()->route('sign-in.get')->with('error', 'يجب تسجيل الدخول أولاً.');
        }

        $user = Auth::user(); // جلب المستخدم المسجل دخوله حالياً

        // 2. التحقق من صحة البيانات (اختياري، لكن يوصى به دائمًا)
        $request->validate([
            'bio' => 'nullable|string|max:1000', // مثال: يمكن أن يكون فارغًا، يجب أن يكون نصًا، والحد الأقصى 1000 حرف
        ], [
            'bio.string' => 'البيو يجب أن يكون نصًا.',
            'bio.max' => 'البيو لا يمكن أن يتجاوز 1000 حرف.',
        ]);

        // 3. البحث عن الـ ChefProfile المرتبط بالمستخدم أو إنشائه إذا لم يكن موجودًا
        // (هذا مهم لضمان وجود سجل ChefProfile قبل محاولة تحديثه)
        $chefProfile = $user->chefProfile; // حاول جلب ChefProfile الحالي
        if (!$chefProfile) {
            // إذا لم يكن هناك ChefProfile، قم بإنشاء واحد جديد وربطه بالمستخدم
            $chefProfile = new ChefProfile();
            $chefProfile->user_id = $user->id;
        }

        // 4. تحديث حقل 'bio' في كائن ChefProfile
        $chefProfile->bio = $request->bio;

        // 5. حفظ التغييرات في قاعدة البيانات
        $chefProfile->save();

        // 6. إعادة التوجيه برسالة نجاح
        return redirect()->route('c1he3f.profile.profile')
            ->with('success', 'تم تحديث البيو بنجاح!');
    }

    public function updateTransfer(Request $request)
    {
        // 1. التأكد أن المستخدم مسجل الدخول وهو طاه (أضفت شرط الدور كأفضل ممارسة)
        if (!Auth::check() || Auth::user()->role !== 'طاه') {
            return redirect()->route('sign-in.get')->with('error', 'لا تملك الصلاحية للوصول لهذه الصفحة.');
        }

        $user = Auth::user(); // جلب المستخدم المسجل دخوله حالياً

        // 2. التحقق من صحة البيانات
        $request->validate([
            'profit_transfer_details' => 'nullable|string|max:1000',
        ], [
            'profit_transfer_details.string' => 'تفاصيل تحويل الأرباح يجب أن تكون نصًا.',
            'profit_transfer_details.max' => 'تفاصيل تحويل الأرباح لا يمكن أن تتجاوز 1000 حرف.',
        ]);

        // 3. البحث عن الـ ChefProfile المرتبط بالمستخدم أو إنشائه إذا لم يكن موجودًا
        $chefProfile = $user->chefProfile;
        if (!$chefProfile) {
            $chefProfile = new ChefProfile();
            $chefProfile->user_id = $user->id;
        }

        // 4. تحديث حقل 'profit_transfer_details' في كائن ChefProfile
        $chefProfile->profit_transfer_details = $request->profit_transfer_details;

        // 5. حفظ التغييرات في قاعدة البيانات
        $chefProfile->save();

        // 6. إعادة التوجيه برسالة نجاح
        return redirect()->route('c1he3f.profile.profile') // العودة لنفس صفحة بيانات التحويل
            ->with('success', 'تم تحديث بيانات تحويل الأرباح بنجاح!');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('system', 'مدير');
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
            'email.unique' => 'هذا البريد الإلكتروني مسجل مسبقاً',
            'password.required' => 'حقل كلمة السر مطلوب',
            'password.min' => 'كلمة السر يجب أن تكون 8 أحرف على الأقل',
            'role.required' => 'حقل الصلاحية مطلوب',
        ];

        // إضافة قواعد التحقق الخاصة بالطاهي إذا كان الدور 'طاه'
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

        // إعداد بيانات المستخدم
        $userData = [
            'system' => 'مدير', // **إضافة هذا السطر**
            'name' => $request->name, // الاسم الرئيسي (يفترض أنه باللغة العربية)
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status ?? 'بانتظار التفعيل', // الحالة الأولية
            'email_verified_at' => null, // يجب أن تكون null حتى يتم تأكيد الـ OTP
            'otp' => null, // سيتم تعيينه لاحقاً إذا كان طاهياً
            'otp_expires_at' => null, // سيتم تعيينه لاحقاً إذا كان طاهياً
        ];

        // ترجمة الاسم للغات الأخرى
        $tr = new GoogleTranslate(); // الافتراضي 'en' كـ source language. إذا كان الـ input Arabic, فاجعلها 'ar'.
        // مثال: new GoogleTranslate('ar');
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

        $user = User::create($userData); // تم إنشاء المستخدم

        // logic for chef
        if ($request->role === 'طاه') {
            // إنشاء OTP وتعيينه للمستخدم
            $otp = (string)random_int(100000, 999999);
            $otpExpiresAt = Carbon::now()->addMinutes(config('auth.passwords.otp_expire_minutes', 5));

            $user->forceFill([
                'otp' => $otp,
                'otp_expires_at' => $otpExpiresAt,
            ])->save();

            // إرسال الـ OTP عبر البريد الإلكتروني
            Mail::to($user->email)->send(new OtpMail($otp));

            // بيانات ChefProfile
            $chefProfileData = [
                'user_id' => $user->id,
                'country' => $request->country,
                'bio' => $request->bio,
                'contract_type' => $request->contract_type,
                'profit_transfer_details' => $request->profit_transfer_details,
            ];

            // رفع الصورة
            if ($request->hasFile('official_image')) {
                $imagePath = $request->file('official_image')->store('chef_images', 'public');
                $chefProfileData['official_image'] = $imagePath;
            }

            // أسعار الاشتراك (إذا كان نوع العقد annual_subscription)
            if ($request->contract_type === 'annual_subscription') {
                $chefProfileData['subscription_3_months'] = $request->subscription_3_months_price;
                $chefProfileData['subscription_6_months'] = $request->subscription_6_months_price;
                $chefProfileData['subscription_12_months'] = $request->subscription_12_months_price; // تم تصحيح الاسم
            } else {
                $chefProfileData['subscription_3_months'] = null;
                $chefProfileData['subscription_6_months'] = null;
                $chefProfileData['subscription_12_months'] = null; // تم تصحيح الاسم
            }

            // إنشاء ChefProfile
            ChefProfile::create($chefProfileData);

            // إعادة التوجيه إلى صفحة تأكيد الـ OTP للطهاة
            return redirect()->route('c1he3f.auth.otp-confirm', ['email' => $user->email])
                ->with('success', 'تم التسجيل بنجاح! الرجاء إدخال رمز التحقق الذي تم إرساله إلى بريدك الإلكتروني.');
        } else {
            // إذا لم يكن الدور 'طاه'، قم بتسجيل الدخول مباشرة (كما كان يحدث سابقاً)
            Auth::login($user);
            return redirect()->route('admin.users.index')
                ->with('success', 'تم إضافة المستخدم بنجاح.');
        }
    }

    public function show(User $user)
    {
        $user->load('chefProfile');
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string|max:255', // name_en
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:مدير,مشرف,مدخل بيانات,طاه',
            'status' => 'required|in:فعال,غير فعال,بانتظار التفعيل',
        ];

        $messages = [
            'name.required' => 'حقل الاسم (بالإنجليزية) مطلوب',
            'email.required' => 'حقل البريد الإلكتروني مطلوب',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح',
            'email.unique' => 'هذا البريد الإلكتروني مسجل مسبقاً',
            'password.min' => 'كلمة السر يجب أن تكون 8 أحرف على الأقل',
            'role.required' => 'حقل الصلاحية مطلوب',
            'status.required' => 'حقل الحالة مطلوب',
            'status.in' => 'يجب أن تكون الحالة قيمة صحيحة (فعال، غير فعال، أو بانتظار التفعيل)',
        ];

        if ($request->role === 'طاه') {
            $rules += [
                'country' => 'required|string|max:255',
                'bio' => 'required|string',
                'contract_type' => 'required|in:per_recipe,annual_subscription',
                'profit_transfer_details' => 'required|string',
                'official_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ];
            $messages += [
                'country.required' => 'حقل الدولة مطلوب عند اختيار دور الطاه',
                'bio.required' => 'حقل النبذة التعريفية مطلوب عند اختيار دور الطاه',
                'contract_type.required' => 'حقل نوع التعاقد مطلوب عند اختيار دور الطاه',
                'profit_transfer_details.required' => 'حقل بيانات تحويل الأرباح مطلوب عند اختيار دور الطاه',
                'official_image.image' => 'الملف المختار ليس صورة',
                'official_image.mimes' => 'الصورة يجب أن تكون بصيغة jpeg, png, أو jpg',
                'official_image.max' => 'حجم الصورة يجب ألا يزيد عن 2 ميجابايت',
            ];

            if ($request->contract_type === 'annual_subscription') {
                $rules += [
                    'subscription_3_months_price' => 'nullable|numeric|min:0',
                    'subscription_6_months_price' => 'nullable|numeric|min:0',
                    'subscription_12_months_price' => 'nullable|numeric|min:0',
                ];
                $request->mergeIfMissing([
                    'subscription_3_months_price' => '',
                    'subscription_6_months_price' => '',
                    'subscription_12_months_price' => '',
                ]);
                $rules['subscription_3_months_price'] = [
                    'nullable',
                    'numeric',
                    'min:0',
                    Rule::requiredIf(function () use ($request) {
                        return $request->contract_type === 'annual_subscription' &&
                            empty($request->subscription_6_months_price) &&
                            empty($request->subscription_12_months_price);
                    }),
                ];
                $rules['subscription_6_months_price'] = [
                    'nullable',
                    'numeric',
                    'min:0',
                    Rule::requiredIf(function () use ($request) {
                        return $request->contract_type === 'annual_subscription' &&
                            empty($request->subscription_3_months_price) &&
                            empty($request->subscription_12_months_price);
                    }),
                ];
                $rules['subscription_12_months_price'] = [
                    'nullable',
                    'numeric',
                    'min:0',
                    Rule::requiredIf(function () use ($request) {
                        return $request->contract_type === 'annual_subscription' &&
                            empty($request->subscription_3_months_price) &&
                            empty($request->subscription_6_months_price);
                    }),
                ];

                $messages += [
                    'subscription_3_months_price.required_if' => 'يجب إدخال سعر اشتراك 3 شهور أو 6 شهور أو 12 شهرًا على الأقل.',
                    'subscription_6_months_price.required_if' => 'يجب إدخال سعر اشتراك 3 شهور أو 6 شهور أو 12 شهرًا على الأقل.',
                    'subscription_12_months_price.required_if' => 'يجب إدخال سعر اشتراك 3 شهور أو 6 شهور أو 12 شهرًا على الأقل.',
                    'subscription_3_months_price.numeric' => 'يجب أن يكون سعر اشتراك 3 شهور رقمًا.',
                    'subscription_6_months_price.numeric' => 'يجب أن يكون سعر اشتراك 6 شهور رقمًا.',
                    'subscription_12_months_price.numeric' => 'يجب أن يكون سعر اشتراك 12 شهرًا رقمًا.',
                    'subscription_3_months_price.min' => 'يجب أن يكون سعر اشتراك 3 شهور قيمة موجبة.',
                    'subscription_6_months_price.min' => 'يجب أن يكون سعر اشتراك 6 شهور قيمة موجبة.',
                    'subscription_12_months_price.min' => 'يجب أن يكون سعر اشتراك 12 شهرًا قيمة موجبة.',
                ];
            }
        }

        $request->validate($rules, $messages);

        $data = [
            'name_en' => $request->name, // Save input as name_en
            'name' => $request->name, // Save input as name (for compatibility)
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
        ];

        // Initialize Google Translate
        $tr = new GoogleTranslate('en'); // Source language is English

        // Translate name to other languages
        foreach ($this->targetLanguages as $code => $name) {
            $columnName = 'name_' . $code;
            try {
                if (in_array($columnName, (new User())->getFillable())) {
                    $data[$columnName] = $tr->setTarget($code)->translate($request->input('name'));
                } else {
                    Log::warning("Column {$columnName} not found in User model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $data[$columnName] = null;
                Log::error("Translation failed for {$code} (User Update): " . $e->getMessage());
            }
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        if ($request->role === 'طاه') {
            $chefProfileData = [
                'country' => $request->country,
                'bio' => $request->bio,
                'contract_type' => $request->contract_type,
                'profit_transfer_details' => $request->profit_transfer_details,
            ];

            if ($request->contract_type === 'annual_subscription') {
                $chefProfileData['subscription_3_months_price'] = $request->subscription_3_months_price;
                $chefProfileData['subscription_6_months_price'] = $request->subscription_6_months_price;
                $chefProfileData['subscription_12_months_price'] = $request->subscription_12_months_price;
            } else {
                $chefProfileData['subscription_3_months_price'] = null;
                $chefProfileData['subscription_6_months_price'] = null;
                $chefProfileData['subscription_12_months_price'] = null;
            }

            if ($user->chefProfile) {
                $imagePath = $user->chefProfile->official_image;
                if ($request->hasFile('official_image')) {
                    if ($imagePath && Storage::exists($imagePath)) {
                        Storage::delete($imagePath);
                    }
                    $imagePath = $request->file('official_image')->store('chef_images', 'public');
                }
                $chefProfileData['official_image'] = $imagePath;
                $user->chefProfile->update($chefProfileData);
            } else {
                $imagePath = null;
                if ($request->hasFile('official_image')) {
                    $imagePath = $request->file('official_image')->store('chef_images', 'public');
                }
                $chefProfileData['user_id'] = $user->id;
                $chefProfileData['official_image'] = $imagePath;
                ChefProfile::create($chefProfileData);
            }
        } else {
            if ($user->chefProfile) {
                if ($user->chefProfile->official_image && Storage::exists($user->chefProfile->official_image)) {
                    Storage::delete($user->chefProfile->official_image);
                }
                $user->chefProfile->delete();
            }
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'تم تحديث المستخدم بنجاح');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'لا يمكنك حذف حسابك الشخصي');
        }

        if ($user->chefProfile && $user->chefProfile->official_image) {
            Storage::delete($user->chefProfile->official_image);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'تم حذف المستخدم بنجاح');
    }
}
