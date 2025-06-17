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
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }
        $users = $query->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255', // name_en
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:مدير,مشرف,مدخل بيانات,طاه',
            'status' => 'required|in:فعال,غير فعال,بانتظار التفعيل',
        ];

        $messages = [
            'name.required' => 'حقل الاسم (بالإنجليزية) مطلوب',
            'email.required' => 'حقل البريد الإلكتروني مطلوب',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح',
            'email.unique' => 'هذا البريد الإلكتروني مسجل مسبقاً',
            'password.required' => 'حقل كلمة السر مطلوب',
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
                'official_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ];
            $messages += [
                'country.required' => 'حقل الدولة مطلوب عند اختيار دور الطاه',
                'bio.required' => 'حقل النبذة التعريفية مطلوب عند اختيار دور الطاه',
                'contract_type.required' => 'حقل نوع التعاقد مطلوب عند اختيار دور الطاه',
                'profit_transfer_details.required' => 'حقل بيانات تحويل الأرباح مطلوب عند اختيار دور الطاه',
                'official_image.required' => 'حقل الصورة الرسمية مطلوب عند اختيار دور الطاه',
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

        $userData = [
            'name_en' => $request->name, // Save input as name_en
            'name' => $request->name, // Save input as name (for compatibility)
            'email' => $request->email,
            'password' => Hash::make($request->password),
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
                    $userData[$columnName] = $tr->setTarget($code)->translate($request->input('name'));
                } else {
                    Log::warning("Column {$columnName} not found in User model fillable. Skipping translation.");
                }
            } catch (\Exception $e) {
                $userData[$columnName] = null;
                Log::error("Translation failed for {$code} (User Store): " . $e->getMessage());
            }
        }

        $user = User::create($userData);

        if ($request->role === 'طاه') {
            $imagePath = $request->file('official_image')->store('chef_images', 'public');

            $chefProfileData = [
                'user_id' => $user->id,
                'country' => $request->country,
                'bio' => $request->bio,
                'contract_type' => $request->contract_type,
                'profit_transfer_details' => $request->profit_transfer_details,
                'official_image' => $imagePath,
            ];

            if ($request->contract_type === 'annual_subscription') {
                $chefProfileData['subscription_3_months_price'] = $request->subscription_3_months_price;
                $chefProfileData['subscription_6_months_price'] = $request->subscription_6_months_price;
                $chefProfileData['subscription_12_months_price'] = $request->subscription_12_months_price;
            }

            ChefProfile::create($chefProfileData);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'تم إضافة المستخدم بنجاح');
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
