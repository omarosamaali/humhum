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
// Import Log
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
  
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
