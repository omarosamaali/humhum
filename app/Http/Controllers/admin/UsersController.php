<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ChefProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Stichoza\GoogleTranslate\GoogleTranslate;

class UsersController extends Controller
{
    // Define target languages for translation
    protected $targetLanguages = [
        'ar' => 'العربية',
        'en' => 'الإنجليزية',
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
        $query = User::query();

        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        $users = $query->paginate(10);
        $chefsProfiles = ChefProfile::with('user')->get();

        return view('admin.users.index', compact('users', 'chefsProfiles'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'country' => 'required|string|max:255',
                'bio' => 'string', // الآن اختيارية إذا لم تكن تريدها مطلوبة
                'contract_type' => 'in:per_recipe,annual_subscription', // الآن اختيارية إذا لم تكن تريدها مطلوبة
                'subscription_3_months_price' => 'nullable|numeric|min:0',
                'subscription_6_months_price' => 'nullable|numeric|min:0',
                'subscription_12_months_price' => 'nullable|numeric|min:0',
                'profit_transfer_details' => 'string', // الآن اختيارية إذا لم تكن تريدها مطلوبة
                'official_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // <--- هذا هو التعديل الرئيسي
            ]);

            // ...
            // تأكد أنك تقوم بحفظ الصورة فقط إذا كانت موجودة
            $imagePath = null; // تهيئة المسار بقيمة null
            if ($request->hasFile('official_image')) {
                $imagePath = $request->file('official_image')->store('chef_images', 'public');
            }

            ChefProfile::create([
                // 'user_id' => $user->id,
                'user_id' => $request->id,
                'country' => $request->country,
                'bio' => $request->bio,
                'contract_type' => $request->contract_type,
                'subscription_3_months' => $request->contract_type == 'annual_subscription' ? $request->subscription_3_months_price : null,
                'subscription_6_months' => $request->contract_type == 'annual_subscription' ? $request->subscription_6_months_price : null,
                'subscription_12' => $request->contract_type == 'annual_subscription' ? $request->subscription_12_months_price : null,
                'profit_transfer' => $request->profit_transfer_details,
                'official_image' => $imagePath,
            ]);

            // Provide feedback based on translation success
            if (!empty($translationErrors)) {
                return redirect()->route('c1he3f.index')->with('success', 'تم إضافة الطاهي بنجاح.')
                    ->with('warning', 'ولكن حدثت مشكلة في ترجمة الاسم لبعض اللغات: <br>' . implode('<br>', $translationErrors));
            } else {
                return redirect()->route('c1he3f.index')->with('success', 'تم إضافة الطاهي بنجاح');
            }
        } catch (\Exception $e) {
            Log::error("Error creating chef: " . $e->getMessage());
            return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8',
                'status' => 'string|in:فعال,غير فعال,بانتظار التفعيل',
                'country' => 'required|string|max:255',
                'bio' => 'string',
                'contract_type' => 'in:per_recipe,annual_subscription',
                'subscription_3_months_price' => 'nullable|numeric|min:0',
                'subscription_6_months_price' => 'nullable|numeric|min:0',
                'subscription_12_months_price' => 'nullable|numeric|min:0',
                'profit_transfer_details' => 'string',
                'official_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $userDataToUpdate = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'role' => 'طاهي', // Fixed role to 'طاهي'
                'status' => $request->status,
            ];

            $translationErrors = [];
            $originalName = $request->name;

            // Translation logic for updating chef's name
            $userDataToUpdate['name_ar'] = $originalName;

            $tr = new GoogleTranslate('ar');

            foreach ($this->targetLanguages as $code => $langName) {
                $columnName = 'name_' . $code;
                if (in_array($columnName, $user->getFillable())) {
                    if ($code === 'ar') {
                        continue;
                    }
                    try {
                        $translatedName = $tr->setTarget($code)->translate($originalName);
                        $userDataToUpdate[$columnName] = $translatedName ?: $originalName;
                    } catch (\Exception $e) {
                        $userDataToUpdate[$columnName] = $originalName;
                        Log::error("Translation failed for {$code} (User Name Update): " . $e->getMessage());
                        $translationErrors[] = "فشل ترجمة الاسم إلى " . $langName . " (" . $e->getMessage() . ")";
                    }
                }
            }

            $user->update($userDataToUpdate);

            // Update ChefProfile
            $chefProfile = $user->chefProfile ?? new ChefProfile(['user_id' => $user->id]);

            $data = [
                'country' => $request->country,
                'bio' => $request->bio,
                'contract_type' => $request->contract_type,
                'profit_transfer' => $request->profit_transfer_details,
            ];

            $data['subscription_3_months'] = $request->contract_type == 'annual_subscription' ? $request->subscription_3_months_price : null;
            $data['subscription_6_months'] = $request->contract_type == 'annual_subscription' ? $request->subscription_6_months_price : null;
            $data['subscription_12'] = $request->contract_type == 'annual_subscription' ? $request->subscription_12_months_price : null;

            if ($request->hasFile('official_image')) {
                if ($chefProfile->official_image) {
                    Storage::disk('public')->delete($chefProfile->official_image);
                }
                $data['official_image'] = $request->file('official_image')->store('chef_images', 'public');
            }

            $chefProfile->fill($data)->save();

            if (!empty($translationErrors)) {
                return redirect()->route('admin.users.index')->with('success', 'تم تحديث الطاهي بنجاح.')
                    ->with('warning', 'ولكن حدثت مشكلة في ترجمة الاسم لبعض اللغات: <br>' . implode('<br>', $translationErrors));
            } else {
                return redirect()->route('admin.users.index')->with('success', 'تم تحديث الطاهي بنجاح');
            }
        } catch (\Exception $e) {
            Log::error("Error updating chef: " . $e->getMessage());
            return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->chefProfile) {
            if ($user->chefProfile->official_image) {
                Storage::disk('public')->delete($user->chefProfile->official_image);
            }
            $user->chefProfile->delete();
        }
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'تم حذف الطاهي بنجاح');
    }
}
