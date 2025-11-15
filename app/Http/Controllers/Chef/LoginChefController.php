<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cook;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\NotificationHelper;
use App\Traits\NotificationHelperUser;

class LoginChefController extends Controller
{
    use NotificationHelper, NotificationHelperUser;

    public function login($cook_number = null, $cook_id = null)
    {
        if (session('is_cook_logged_in')) {
            return redirect()->route('chefs.welcome');
        }
        $cookData = null;
        if ($cook_number && $cook_id) {
            $cookData = Cook::where('cook_number', $cook_number)
                ->where('id', $cook_id)
                ->first();
        }
        if (request()->cookie('cook_remember')) {
            try {
                $data = json_decode(decrypt(request()->cookie('cook_remember')), true);
                $cook = Cook::where('cook_number', $data['cook_number'])
                    ->where('password', $data['password'])
                    ->first();
                if ($cook) {
                    if ($cook->user_id) {
                        $user = User::find($cook->user_id);
                        if ($user) {
                            Auth::login($user);
                        }
                    }
                    session([
                        'cook_id' => $cook->id,
                        'cook_number' => $cook->cook_number,
                        'cook_name' => $cook->name,
                        'cook_image' => $cook->image,
                        'cook_language' => $cook->language,
                        'is_cook_logged_in' => true
                    ]);
                    $this->sendCookLoginNotification($cook);
                    return redirect()->route('chefs.welcome');
                }
            } catch (\Exception $e) {
            }
        }
        return view('chefs.auth.login', compact('cookData', 'cook_number'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cook_number' => 'required',
            'password' => 'required|size:4',
        ]);
        $cook = Cook::where('cook_number', $request->cook_number)
            ->where('password', $request->password)
            ->first();
        if (!$cook) {
            return back()->withErrors(['login' => 'رقم العضوية أو رمز الدخول غير صحيح']);
        }
        session([
            'cook_id' => $cook->id,
            'cook_number' => $cook->cook_number,
            'cook_name' => $cook->name,
            'cook_image' => $cook->image,
            'cook_language' => $cook->language,
            'is_cook_logged_in' => true
        ]);
        cookie()->queue('cook_remember', encrypt(json_encode([
            'cook_number' => $cook->cook_number,
            'password' => $request->password
        ])), 43200);
        $this->sendCookLoginNotification($cook);
        return redirect()->route('chefs.welcome')->with('success', 'تم تسجيل الدخول بنجاح');
    }
}
