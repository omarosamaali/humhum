<?php

namespace App\Http\Controllers;

use App\Models\ChefProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function toggleFollow(ChefProfile $chefProfile)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['success' => false, 'error' => 'يجب تسجيل الدخول لمتابعة الشيف'], 401);
        }

        if ($user->id === $chefProfile->user_id) {
            return response()->json(['success' => false, 'error' => 'لا يمكنك متابعة نفسك'], 403);
        }

        $isFollowing = $chefProfile->isFollowedBy($user);

        if ($isFollowing) {
            $chefProfile->followers()->detach($user->id);
            $chefProfile->decrement('followers_count');
        } else {
            $chefProfile->followers()->attach($user->id);
            $chefProfile->increment('followers_count');
        }

        $followersCount = $chefProfile->followers_count;

        return response()->json([
            'success' => true,
            'isFollowing' => !$isFollowing,
            'followersCount' => $followersCount,
        ]);
    }
}
