<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use App\Models\Blocked;
use App\Models\Cook;
use Illuminate\Support\Facades\Auth;
use App\Models\MyFamily;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    public function notifications()
    {
        $userId = session('user_id') ?? auth()->id();

        // إذا كان فرد من العائلة، نحصل على owner
        if (session('family_id')) {
            $familyMember = MyFamily::find(session('family_id'));
            $userId = $familyMember->user_id;
        }

        $user = User::find($userId);
        $notifications = $user->allNotifications();

        return view('users.notifications.index', compact('notifications'));
    }


    public function index()
    {
        return view('families.profile.index');
    }

    public function family()
    {
        $myFamilies = collect();
        if (Auth::check()) {
            $myFamilies = MyFamily::where('user_id', Auth::user()->id)->get();
        } elseif (session('is_family_logged_in')) {
            $currentMember = MyFamily::find(session('family_id'));
            if ($currentMember) {
                $myFamilies = MyFamily::where('user_id', $currentMember->user_id)->get();
            }
        }
        return view('families.family.index', compact('myFamilies'));
    }

    public function cooks()
    {
        $myFamilies = collect();

        if (Auth::check()) {
            $myFamilies = Cook::where('user_id', Auth::user()->id)->get();
        } elseif (session('is_family_logged_in')) {
            $familyMember = MyFamily::find(session('family_id'));
            if ($familyMember) {
                $myFamilies = Cook::where('user_id', $familyMember->user_id)->get();
            }
        }

        return view('families.cooks.index', compact('myFamilies'));
    }


    public function blocked()
    {
        $myBlocked = Blocked::with('recipe')
            ->where('family_member_id', session('family_id'))->with('recipe')
            ->get();

        return view('families.blocked.index', compact('myBlocked'));
    }
}
