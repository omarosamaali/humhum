<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ChefProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Stichoza\GoogleTranslate\GoogleTranslate; // Ensure this is imported

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

        return view('admin.users.index', compact('users'));
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
                'role' => 'required|string|in:مدير,مشرف,مدخل بيانات,طاه',
                'status' => 'required|string|in:فعال,غير فعال,بانتظار التفعيل',
                // Chef-specific validations
                'country' => 'required_if:role,طاه|string|max:255',
                'bio' => 'required_if:role,طاه|string',
                'contract_type' => 'required_if:role,طاه|in:per_recipe,annual_subscription',
                'subscription_3_months_price' => 'nullable|numeric|min:0',
                'subscription_6_months_price' => 'nullable|numeric|min:0',
                'subscription_12_months_price' => 'nullable|numeric|min:0',
                'profit_transfer_details' => 'required_if:role,طاه|string',
                'official_image' => 'required_if:role,طاه|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Base user data
            $userData = [
                'name' => $request->name, // Store the original name in the 'name' column
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'status' => $request->status,
            ];

            $translationErrors = [];
            $originalName = $request->name; // The name entered in the form

            // Translation logic for chef's name
            if ($request->role === 'طاه') {
                $userData['name_ar'] = $originalName; // Store the Arabic name explicitly

                $tr = new GoogleTranslate('ar'); // Initialize Google Translate with source language Arabic

                // Translate name to target languages
                foreach ($this->targetLanguages as $code => $langName) {
                    $columnName = 'name_' . $code;
                    // Only attempt translation if the column exists in the fillable properties of the User model
                    if (in_array($columnName, (new User())->getFillable())) {
                        if ($code === 'ar') {
                            continue; // Arabic is the source, no need to translate to itself again
                        }
                        try {
                            $translatedName = $tr->setTarget($code)->translate($originalName);
                            // Use the translated name, or fall back to the original if translation fails
                            $userData[$columnName] = $translatedName ?: $originalName;
                        } catch (\Exception $e) {
                            $userData[$columnName] = $originalName; // Fallback to original name on error
                            Log::error("Translation failed for {$code} (User Name Store): " . $e->getMessage());
                            $translationErrors[] = "فشل ترجمة الاسم إلى " . $langName . " (" . $e->getMessage() . ")";
                        }
                    } else {
                        Log::warning("Column {$columnName} not found in User model fillable. Skipping translation for this language.");
                    }
                }
            } else {
                // For non-chef roles, ensure name_ar is set and other name_xx fields are null
                $userData['name_ar'] = $originalName;
                foreach ($this->targetLanguages as $code => $langName) {
                    $columnName = 'name_' . $code;
                    if ($columnName !== 'name_ar' && in_array($columnName, (new User())->getFillable())) {
                        $userData[$columnName] = null; // Clear other language fields for non-chefs
                    }
                }
            }
            dd($userData);

            // Create the user
            $user = User::create($userData);

            // Create Chef Profile if role is 'طاه'
            if ($request->role === 'طاه') {
                $imagePath = $request->file('official_image')->store('chef_images', 'public');

                ChefProfile::create([
                    'user_id' => $user->id,
                    'country' => $request->country,
                    'bio' => $request->bio,
                    'contract_type' => $request->contract_type,
                    // Set subscription prices only if contract_type is 'annual_subscription'
                    'subscription_3_months' => $request->contract_type == 'annual_subscription' ? $request->subscription_3_months_price : null,
                    'subscription_6_months' => $request->contract_type == 'annual_subscription' ? $request->subscription_6_months_price : null,
                    'subscription_12' => $request->contract_type == 'annual_subscription' ? $request->subscription_12_months_price : null,
                    'profit_transfer' => $request->profit_transfer_details,
                    'official_image' => $imagePath,
                ]);
            }

            // Provide feedback based on translation success
            if (!empty($translationErrors)) {
                return redirect()->route('admin.users.index')->with('success', 'تم إضافة المستخدم بنجاح.')
                    ->with('warning', 'ولكن حدثت مشكلة في ترجمة الاسم لبعض اللغات: <br>' . implode('<br>', $translationErrors));
            } else {
                return redirect()->route('admin.users.index')->with('success', 'تم إضافة المستخدم بنجاح');
            }
        } catch (\Exception $e) {
            Log::error("Error creating user: " . $e->getMessage());
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
                'role' => 'required|string|in:مدير,مشرف,مدخل بيانات,طاه',
                'status' => 'required|string|in:فعال,غير فعال,بانتظار التفعيل',
                // Chef-specific validations
                'country' => 'required_if:role,طاه|string|max:255',
                'bio' => 'required_if:role,طاه|string',
                'contract_type' => 'required_if:role,طاه|in:per_recipe,annual_subscription',
                'subscription_3_months_price' => 'nullable|numeric|min:0',
                'subscription_6_months_price' => 'nullable|numeric|min:0',
                'subscription_12_months_price' => 'nullable|numeric|min:0',
                'profit_transfer_details' => 'required_if:role,طاه|string',
                'official_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $userDataToUpdate = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'role' => $request->role,
                'status' => $request->status,
            ];

            $translationErrors = [];
            $originalName = $request->name;

            // Translation logic for updating chef's name (user name)
            if ($request->role === 'طاه') {
                $userDataToUpdate['name_ar'] = $originalName; // Store the Arabic name explicitly

                $tr = new GoogleTranslate('ar'); // Assuming input is Arabic

                foreach ($this->targetLanguages as $code => $langName) {
                    $columnName = 'name_' . $code;
                    if (in_array($columnName, $user->getFillable())) {
                        if ($code === 'ar') {
                            continue; // Arabic is the source
                        }
                        try {
                            $translatedName = $tr->setTarget($code)->translate($originalName);
                            $userDataToUpdate[$columnName] = $translatedName ?: $originalName;
                        } catch (\Exception $e) {
                            $userDataToUpdate[$columnName] = $originalName; // Fallback to original name on error
                            Log::error("Translation failed for {$code} (User Name Update): " . $e->getMessage());
                            $translationErrors[] = "فشل ترجمة الاسم إلى " . $langName . " (" . $e->getMessage() . ")";
                        }
                    } else {
                        Log::warning("Column {$columnName} not found in User model fillable. Skipping translation update for user name.");
                    }
                }
            } else {
                // If the role changes from chef to another role, clear translation fields
                $userDataToUpdate['name_ar'] = $originalName; // Keep name_ar updated for non-chefs
                foreach ($this->targetLanguages as $code => $langName) {
                    $columnName = 'name_' . $code;
                    if ($columnName !== 'name_ar' && in_array($columnName, $user->getFillable())) {
                        $userDataToUpdate[$columnName] = null; // Set other name_xx fields to null
                    }
                }
            }

            $user->update($userDataToUpdate);

            // Update ChefProfile logic
            if ($request->role === 'طاه') {
                $chefProfile = $user->chefProfile ?? new ChefProfile(['user_id' => $user->id]);

                $data = [
                    'country' => $request->country,
                    'bio' => $request->bio,
                    'contract_type' => $request->contract_type,
                    'profit_transfer' => $request->profit_transfer_details,
                ];

                // Set subscription prices only if contract_type is 'annual_subscription'
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
            } else {
                // If role changes from chef to non-chef, delete chef profile
                if ($user->chefProfile) {
                    if ($user->chefProfile->official_image) {
                        Storage::disk('public')->delete($user->chefProfile->official_image);
                    }
                    $user->chefProfile->delete();
                }
            }

            // Provide feedback based on translation success
            if (!empty($translationErrors)) {
                return redirect()->route('admin.users.index')->with('success', 'تم تحديث المستخدم بنجاح.')
                    ->with('warning', 'ولكن حدثت مشكلة في ترجمة الاسم لبعض اللغات: <br>' . implode('<br>', $translationErrors));
            } else {
                return redirect()->route('admin.users.index')->with('success', 'تم تحديث المستخدم بنجاح');
            }
        } catch (\Exception $e) {
            Log::error("Error updating user: " . $e->getMessage());
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

        return redirect()->route('admin.users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
}
