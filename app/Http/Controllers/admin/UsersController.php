<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ChefProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
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
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'role' => 'required|string|in:مدير,مشرف,مدخل بيانات,طاه',
                'status' => 'required|string|in:فعال,غير فعال,بانتظار التفعيل',
                'country' => 'required_if:role,طاه|string|max:255',
                'bio' => 'required_if:role,طاه|string',
                'contract_type' => 'required_if:role,طاه|in:per_recipe,annual_subscription',
                'profit_transfer_details' => 'required_if:role,طاه|string',
                'official_image' => 'required_if:role,طاه|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'status' => $request->status,
            ]);

            if ($request->role === 'طاه') {
                $imagePath = $request->file('official_image')->store('chef_images', 'public');

                ChefProfile::create([
                    'user_id' => $user->id,
                    'country' => $request->country,
                    'bio' => $request->bio,
                    'contract_type' => $request->contract_type,
                    'profit_transfer_details' => $request->profit_transfer_details,
                    'official_image' => $imagePath,
                ]);
            }

            return redirect()->route('admin.users.index')->with('success', 'تم إضافة المستخدم بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $user = User::with('chefProfile')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::with('chefProfile')->findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:مدير,مشرف,مدخل بيانات,طاه',
            'status' => 'required|string|in:فعال,غير فعال,بانتظار التفعيل',
            'country' => 'required_if:role,طاه|string|max:255',
            'bio' => 'required_if:role,طاه|string',
            'contract_type' => 'required_if:role,طاه|in:per_recipe,annual_subscription',
            'profit_transfer_details' => 'required_if:role,طاه|string',
            'official_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        if ($request->role === 'طاه') {
            $chefProfile = $user->chefProfile ?? new ChefProfile(['user_id' => $user->id]);

            $data = [
                'country' => $request->country,
                'bio' => $request->bio,
                'contract_type' => $request->contract_type,
                'profit_transfer_details' => $request->profit_transfer_details,
            ];

            if ($request->hasFile('official_image')) {
                if ($chefProfile->official_image) {
                    Storage::disk('public')->delete($chefProfile->official_image);
                }
                $data['official_image'] = $request->file('official_image')->store('chef_images', 'public');
            }

            $chefProfile->fill($data)->save();
        } else {
            if ($user->chefProfile) {
                Storage::disk('public')->delete($user->chefProfile->official_image);
                $user->chefProfile->delete();
            }
        }

        return redirect()->route('admin.users.index')->with('success', 'تم تحديث المستخدم بنجاح');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->chefProfile) {
            Storage::disk('public')->delete($user->chefProfile->official_image);
            $user->chefProfile->delete();
        }
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
}
