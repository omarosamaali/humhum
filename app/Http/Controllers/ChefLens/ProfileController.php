<?php

namespace App\Http\Controllers\ChefLens;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * يعرض صفحة تعديل الملف الشخصي.
     */
    public function showProfile()
    {
        $user = Auth::user();
        return view('chef_lens.profile.edit-profile', compact('user'));
    }

    /**
     * يعالج طلب تحديث الملف الشخصي للمستخدم.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // التحقق من صحة البيانات
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // للتحقق من الصورة
        ]);

        // تحديث البيانات
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // التعامل مع تحميل الصورة
        if ($request->hasFile('avatar')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($user->avatar) {
                // تأكد أن المسار صحيح
                //Storage::delete('public/' . $user->avatar); 
            }

            // حفظ الصورة الجديدة
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->route('chef_lens.edit-profile')->with('status', 'تم تحديث الملف الشخصي بنجاح.');
    }
}
