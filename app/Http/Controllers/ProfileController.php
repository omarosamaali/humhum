<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\ChefMarket;
use App\Models\DeliveryLocation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Snap;use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function deleteAccount(Request $request)
    {
        try {
            // التحقق من أن المستخدم مسجل دخول
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'يجب تسجيل الدخول أولاً'
                ], 401);
            }

            // التحقق من كلمة التأكيد
            if ($request->confirmation !== 'delete') {
                return response()->json([
                    'success' => false,
                    'message' => 'يجب كتابة كلمة delete للتأكيد'
                ], 400);
            }

            $user = Auth::user();
            $userId = $user->id;
            $originalEmail = $user->email;

            // بدء المعاملة
            DB::beginTransaction();

            try {
                // تحديث حالة جميع الوصفات إلى inactive
                Recipe::where('user_id', $userId)->update([
                    'status' => '0',
                    'updated_at' => now()
                ]);

                // تحديث حالة جميع الـ snaps إلى inactive
                Snap::where('user_id', $userId)->update([
                    'status' => '0',
                    'updated_at' => now()
                ]);

                // إنشاء إيميل جديد بإضافة delete_ مع رقم عشوائي
                $randomNumber = rand(100, 999);
                $newEmail = 'delete_' . $randomNumber . $originalEmail;

                // التأكد من أن الإيميل الجديد غير موجود
                while (User::where('email', $newEmail)->exists()) {
                    $randomNumber = rand(100, 999);
                    $newEmail = 'delete_' . $randomNumber . $originalEmail;
                }

                // تحديث بيانات المستخدم
                $user->update([
                    'email' => $newEmail,
                    'status' => 'cancelled', // أو 'deleted' حسب ما تفضل
                    'email_verified_at' => null,
                    'deleted_at' => now(), // إذا كنت تستخدم soft delete
                    'updated_at' => now()
                ]);

                // حذف الجلسات النشطة للمستخدم
                DB::table('sessions')->where('user_id', $userId)->delete();

                // تسجيل خروج المستخدم
                Auth::logout();

                // إنهاء المعاملة
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'تم حذف الحساب بنجاح'
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف الحساب: ' . $e->getMessage()
            ], 500);
        }
    }
    public function checkEmailAvailability(Request $request)
    {
        $email = $request->email;
        $existingUser = User::where('email', $email)->first();
        if ($existingUser && $existingUser->status === 'cancelled') {
            return response()->json([
                'available' => false,
                'message' => 'هذا الإيميل مستخدم مسبقاً'
            ]);
        }
        $deletedUser = User::where('email', 'like', 'delete_%' . $email)->first();
        if ($deletedUser) {
            return response()->json([
                'available' => true,
                'message' => 'يمكن استخدام هذا الإيميل'
            ]);
        }
        return response()->json([
            'available' => !$existingUser,
            'message' => $existingUser ? 'هذا الإيميل مستخدم مسبقاً' : 'يمكن استخدام هذا الإيميل'
        ]);
    }
    public function showDeliveryLocations()
    {
        $deliveryLocations = DeliveryLocation::where('user_id', Auth::id())->get();
        return view('chef.profile.delivery-locations', compact('deliveryLocations'));
    }
    public function selectDeliveryLocation(Request $request, $id)
    {
        DeliveryLocation::where('user_id', auth()->id())->update(['is_selected' => false]);
        $location = DeliveryLocation::where('user_id', auth()->id())->findOrFail($id);
        $location->update(['is_selected' => true]);

        Log::info('Delivery location selected', [
            'user_id' => Auth::id(),
            'location_id' => $id
        ]);

        return response()->json(['success' => true]);
    }
    public function showAddDeliveryAddress()
    {
        // Ensure the user has chosen to have a market
        $chefMarket = ChefMarket::where('user_id', Auth::id())->first();
        if (!$chefMarket || !$chefMarket->has_market) {
            return redirect()->route('c1he3f.profile.market-choice')
                ->with('error', 'يرجى اختيار امتلاك متجر أولاً');
        }

        return view('chef.profile.add-delivery-address');
    }

    public function storeDeliveryAddress(Request $request)
    {
        $request->validate([
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'delivery_fee' => 'required|numeric|min:0',
        ]);

        DeliveryLocation::create([
            'user_id' => Auth::id(),
            'country' => $request->country,
            'city' => $request->city,
            'area' => $request->area,
            'delivery_fee' => $request->delivery_fee,
        ]);

        Log::info('Delivery location saved', [
            'user_id' => Auth::id(),
            'country' => $request->country,
            'city' => $request->city,
            'area' => $request->area,
            'delivery_fee' => $request->delivery_fee,
        ]);

        return redirect()->route('c1he3f.profile.delivery-location')
            ->with('success', 'تم إضافة مكان التوصيل بنجاح');
    }

    public function destroyDeliveryLocation($id)
    {
        $location = DeliveryLocation::where('user_id', Auth::id())->findOrFail($id);
        $location->delete();

        Log::info('Delivery location deleted', [
            'user_id' => Auth::id(),
            'location_id' => $id,
        ]);

        return redirect()->route('c1he3f.profile.delivery-location')
            ->with('success', 'تم حذف مكان التوصيل بنجاح');
    }

    public function comingSoon()
    {
        return view('chef.profile.coming-soon');
    }

    public function showMarketChoice()
    {
        $chefMarket = ChefMarket::where('user_id', Auth::id())->first();
        return view('chef.profile.market-choice', compact('chefMarket'));
    }

    public function saveMarketChoice(Request $request)
    {
        $request->validate([
            'has_market' => 'required|boolean'
        ]);

        ChefMarket::updateOrCreate(
            ['user_id' => Auth::id()],
            ['has_market' => $request->has_market]
        );

        return redirect()->route('c1he3f.profile.delivery-location')
            ->with('success', 'تم حفظ اختيار المتجر بنجاح');
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    public function editDeliveryLocation($id)
    {
        $location = DeliveryLocation::where('user_id', Auth::id())->findOrFail($id);
        return view('c1he3f.profile.edit-delivery-address', compact('location'));
    }
    public function checkMarketStatus()
    {
        $chefMarket = ChefMarket::where('user_id', Auth::id())->first();

        if ($chefMarket) {
            Log::info('Market Status Check', [
                'user_id' => Auth::id(),
                'chef_market_id' => $chefMarket->id,
                'has_market' => $chefMarket->has_market,
                'market_data' => $chefMarket->toArray()
            ]);
        } else {
            Log::info('No ChefMarket found for user', ['user_id' => Auth::id()]);
        }

        return $chefMarket;
    }

    public function updateDeliveryLocation(Request $request, $id)
    {
        $request->validate([
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'delivery_fee' => 'required|numeric|min:0',
        ]);

        $location = DeliveryLocation::where('user_id', Auth::id())->findOrFail($id);
        DeliveryLocation::where('user_id', auth()->id())
            ->update(['is_selected' => false]);
        if ($request->has('selected_location')) {
            DeliveryLocation::where('id', $request->selected_location)
                ->where('user_id', auth()->id())
                ->update(['is_selected' => true]);
        }

        $location->update([
            'country' => $request->country,
            'city' => $request->city,
            'area' => $request->area,
            'delivery_fee' => $request->delivery_fee,
        ]);

        Log::info('Delivery location updated', [
            'user_id' => Auth::id(),
            'location_id' => $id,
            'country' => $request->country,
            'city' => $request->city,
            'area' => $request->area,
            'delivery_fee' => $request->delivery_fee,
        ]);

        return redirect()->route('c1he3f.profile.delivery-location')
            ->with('success', 'تم تحديث مكان التوصيل بنجاح');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/login');
    }
}
