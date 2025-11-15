<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'country' => 'required|string',
        ]);
        $user->update($validated);
        return redirect()->route('users.profile.index', $user)->with('success', 'تم تحديث البيانات بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function chooseImage(User $user)
    {
        $avatars = Family::where('status', '1')->get();
        return view('users.profile.chooseImage', compact('user', 'avatars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateImage(User $user, Request $request)
    {
        $request->validate([
            'avatar' => 'required|string'
        ]);

        $user->update([
            'avatar' => $request->avatar,
        ]);

        return redirect()->route('users.profile.edit', $user->id)->with('success', 'تم تحديث الصورة بنجاح');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $user = Auth::user();
        $user->my_family()->delete();
        Auth::logout();
        $user->delete();

        return redirect()->route('users.auth.login')->with('success', 'تم حذف الحساب بنجاح');
    }
}
