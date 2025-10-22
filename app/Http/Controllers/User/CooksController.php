<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\NotificationHelper;
use App\Traits\NotificationHelperUser;
use Illuminate\Support\Facades\DB;

class CooksController extends Controller
{
    use NotificationHelper, NotificationHelperUser;

    public function index()
    {
        $cooks = Cook::all();
        $count = Cook::where('user_id', Auth::user()->id)->count();
        return view('users.cooks.index', compact( 'cooks', 'count'));
    }

    public function create()
    {
        return view('users.cooks.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'language' => 'required'
        ]);

        Cook::create([
            'name' => $request->name,
            'language' => $request->language,
            'password' => $request->password,
            'user_id' => Auth::user()->id,
            'cook_number' => Auth::user()->membership_number,
        ]);


        $this->sendNotification(
            "تمت إضافة الطباخ {$request->name}",
        );


        return redirect()->route('users.cooks.index')->with('success', 'تم إضافة الطباخ بنجاح');
    }

    public function edit(Cook $cook)
    {
        return view('users.cooks.edit', compact('cook'));
    }

    public function update(Request $request, Cook $cook)
    {
        $request->validate([
            'name' => 'required',
            'language' => 'required',
            'password' => 'nullable|string|size:4',
        ]);

        $updateData = [
            'name' => $request->name,
            'language' => $request->language,
            'user_id' => Auth::user()->id,
        ];

        $this->sendNotification(
            "تم تحديث بيانات الطباخ {$cook->name}",
        );

        $cook->update($updateData);

        return redirect()->route('users.cooks.index')->with('success', 'تم تحديث الطباخ بنجاح');
    }

    public function destroy(Cook $cook) {
        $cookName = $cook->name;

        $cook->forceDelete();
        $cook->delete();

        $this->sendNotification(
            "تم حذف العضو {$cookName}",
            'حذف عضو',
            'member_deleted',
            ['member_name' => $cookName]
        );

        return redirect()->route('users.cooks.index')->with('success', 'تم حذف الطباخ بنجاح');
    }

    public function chooseImage(Cook $cook)
    {
        return view('users.cooks.chooseImage', compact('cook'));
    }

    public function updateImage(Cook $cook, Request $request)
    {
        $request->validate([
            'image' => 'required|string'
        ]);

        $cook->update([
            'image' => $request->image,
        ]);

        $this->sendNotification(
            "تم تحديث صورة {$cook->name}",
            'تحديث الصورة',
            'image_updated',
            ['member_name' => $cook->name]
        );

        return redirect()->route('users.cooks.index', $cook->id)->with('success', 'تم تحديث الصورة بنجاح');
    }

    public function cook_login()
    {
        if (session('is_cook_logged_in')) {
            return redirect()->route('users.welcome');
        }

        if (request()->cookie('cook')) {
            try {
                $data = json_decode(decrypt(request()->cookie('cook')), true);

                // استخدم Cook Model بدلاً من DB::table
                $cook = Cook::where('cook_number', $data['cook_number'])
                    ->where('password', $data['password'])
                    ->first();

                if ($cook) {
                    session([
                        'cook_id' => $cook->id,
                        'cook_number' => $cook->cook_number,
                        'is_cook_logged_in' => true
                    ]);
                    return redirect()->route('users.welcome');
                }
            } catch (\Exception $e) {
                // Cookie invalid, continue to login page
            }
        }

        return view('users.cooks_members.login');
    }
    public function cook_login_post(Request $request)
    {
        $request->validate([
            'cook_number' => 'required',
            'password' => 'required|size:4',
        ], [
            'cook_number.required' => 'رقم العضوية مطلوب',
            'password.required' => 'رمز الدخول مطلوب',
            'password.size' => 'رمز الدخول يجب أن يكون 4 أرقام',
        ]);

        // استخدم Cook Model بدلاً من DB::table
        $cook = Cook::where('cook_number', $request->cook_number)
            ->where('password', $request->password)
            ->first();

        if ($cook) {
            session([
                'cook_id' => $cook->id,
                'cook_number' => $cook->cook_number,
                'is_cook_logged_in' => true
            ]);

            cookie()->queue('cook_remember', encrypt(json_encode([
                'cook_number' => $cook->cook_number,
                'password' => $request->password
            ])), 43200);

            $this->sendCookLoginNotification($cook);

            return redirect()->route('users.welcome')
                ->with('success', 'تم تسجيل الدخول بنجاح');
        }

        return back()
            ->withInput($request->only('cook_number'))
            ->withErrors(['login' => 'رقم العضوية أو رمز الدخول غير صحيح']);
    }
}
