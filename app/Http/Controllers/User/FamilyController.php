<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MyFamilyTip;
use App\Models\Tip;
use Illuminate\Http\Request;
use App\Models\MyFamily;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\NotificationHelper;
use App\Traits\NotificationHelperUser;


class FamilyController extends Controller
{
    use NotificationHelper, NotificationHelperUser;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $myFamilies = MyFamily::where('user_id', Auth::user()->id)->get();
        $count = MyFamily::where('user_id', Auth::user()->id)->count();
        return view('users.family.index', compact('myFamilies', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.family.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $familyCount = MyFamily::where('user_id', $user->id)->count();

        if ($familyCount >= 9) {
            return redirect()->route('users.family.index')
                ->with('error', 'لا يمكنك إضافة أكثر من 9 أفراد.');
        }

        $request->validate([
            'name' => 'required',
            'language' => 'required',
        ]);

        MyFamily::create([
            'name' => $request->name,
            'language' => $request->language,
            'user_id' => $user->id,
            'owner' => '0',
        ]);

        $this->sendNotification(
            "تمت إضافة {$request->name} بنجاح!",
            'عضو جديد!',
            'new_member',
            ['member_name' => $request->name]
        );

        return redirect()->route('users.family.index')->with('success', 'تم إضافة فرد بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function chooseImage(MyFamily $myFamily)
    {
        return view('users.family.chooseImage', compact('myFamily'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateImage(MyFamily $myFamily, Request $request)
    {
        $request->validate([
            'avatar' => 'required|string'
        ]);

        $myFamily->update([
            'avatar' => $request->avatar,
        ]);

        $this->sendNotification(
            "تم تحديث صورة {$myFamily->name}",
            'تحديث الصورة',
            'avatar_updated',
            ['member_name' => $myFamily->name]
        );

        return redirect()->route('users.family.index', $myFamily->id)->with('success', 'تم تحديث الصورة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(MyFamily $myFamily)
    {
        $countTips = $myFamily->allTips()->count();
        return view('users.family.show', compact('myFamily', 'countTips'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MyFamily $myFamily)
    {
        return view('users.family.edit', compact('myFamily'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MyFamily $myFamily)
    {
        $oldName = $myFamily->name;

        $request->validate([
            'name' => 'required|string',
        ]);

        $myFamily->update([
            'name' => $request->name,
        ]);

        $this->sendNotification(
            "تم تحديث اسم {$oldName} إلى {$request->name}",
            'تحديث الاسم',
            'name_updated',
            ['old_name' => $oldName, 'new_name' => $request->name]
        );

        return redirect()->route('users.family.index')->with('success', 'تم تحديث البيانات بنجاح');
    }

    public function edit_has_email(MyFamily $myFamily)
    {
        return view('users.family.has_email', compact('myFamily'));
    }

    public function update_has_email(Request $request, MyFamily $myFamily)
    {
        $validationRules = [
            'has_email' => 'required|in:0,1',
        ];

        if ($request->has_email == '1') {
            $validationRules['password'] = 'required|string|size:4';
        }

        $request->validate($validationRules);

        $updateData = [
            'has_email' => $request->has_email,
            'family_number' => Auth::user()->membership_number,
            'password' => $request->has_email == '1' ? $request->password : null,
        ];

        $myFamily->update($updateData);

        $status = $request->has_email == '1' ? 'تفعيل' : 'تعطيل';

        $this->sendNotification(
            "تم {$status} صلاحية الدخول للحساب للعضو {$myFamily->name}",
            "{$status} صلاحية الدخول",
            'access_status_changed',
            ['member_name' => $myFamily->name, 'status' => $request->has_email]
        );

        return redirect()->route('users.family.show', $myFamily)->with('success', 'تم تحديث البيانات بنجاح');
    }

    public function edit_send_notification(MyFamily $myFamily)
    {
        return view('users.family.send_notification', compact('myFamily'));
    }

    public function update_send_notification(Request $request, MyFamily $myFamily)
    {
        $request->validate([
            'send_notification' => 'required|string',
        ]);

        $myFamily->update([
            'send_notification' => $request->send_notification,
        ]);

        $status = $request->send_notification == '1' ? 'تفعيل' : 'تعطيل';

        $this->sendNotification(
            "تم {$status} الإشعارات لـ {$myFamily->name}",
            "{$status} الإشعارات",
            'notification_status_changed',
            ['member_name' => $myFamily->name, 'status' => $request->send_notification]
        );

        return redirect()->route('users.family.show', $myFamily)->with('success', 'تم تحديث البيانات بنجاح');
    }

    public function edit_language(MyFamily $myFamily)
    {
        return view('users.family.language', compact('myFamily'));
    }

    public function update_language(Request $request, MyFamily $myFamily)
    {
        $request->validate([
            'language' => 'required|string',
        ]);

        $myFamily->update([
            'language' => $request->language,
        ]);

        $this->sendNotification(
            "تم تغيير لغة {$myFamily->name} إلى {$request->language}",
            'تغيير اللغة',
            'language_changed',
            ['member_name' => $myFamily->name, 'language' => $request->language]
        );

        return redirect()->route('users.family.show', $myFamily)->with('success', 'تم تحديث البيانات بنجاح');
    }

    public function destroy(MyFamily $myFamily)
    {
        $memberName = $myFamily->name;

        $myFamily->forceDelete();
        $myFamily->delete();

        $this->sendNotification(
            "تم حذف العضو {$memberName}",
            'حذف عضو',
            'member_deleted',
            ['member_name' => $memberName]
        );

        return redirect()->route('users.family.index')->with('success', 'تم حذف الفرد بنجاح');
    }

    public function family_login()
    {
        if (session('is_family_logged_in')) {
            return redirect()->route('users.welcome');
        }

        if (request()->cookie('family_remember')) {
            try {
                $data = json_decode(decrypt(request()->cookie('family_remember')), true);

                // استخدم MyFamily Model بدلاً من DB::table
                $familyMember = MyFamily::where('family_number', $data['family_number'])
                    ->where('password', $data['password'])
                    ->first();

                if ($familyMember) {
                    session([
                        'family_id' => $familyMember->id,
                        'family_number' => $familyMember->family_number,
                        'is_family_logged_in' => true
                    ]);

                    // إرسال الإشعار لليوزر
                    $this->sendFamilyLoginNotification($familyMember);

                    return redirect()->route('users.welcome');
                }
            } catch (\Exception $e) {
                // Cookie invalid, continue to login page
            }
        }

        return view('users.family_members.login');
    }

    public function family_login_post(Request $request)
    {
        $request->validate([
            'family_number' => 'required',
            'password' => 'required|size:4',
        ], [
            'family_number.required' => 'رقم العضوية مطلوب',
            'password.required' => 'رمز الدخول مطلوب',
            'password.size' => 'رمز الدخول يجب أن يكون 4 أرقام',
        ]);

        // استخدم MyFamily Model بدلاً من DB::table
        $familyMember = MyFamily::where('family_number', $request->family_number)
            ->where('password', $request->password)
            ->first();

        if ($familyMember) {
            session([
                'family_id' => $familyMember->id,
                'family_number' => $familyMember->family_number,
                'is_family_logged_in' => true
            ]);

            cookie()->queue('family_remember', encrypt(json_encode([
                'family_number' => $familyMember->family_number,
                'password' => $request->password
            ])), 43200);

            // إرسال الإشعار
            $this->sendFamilyLoginNotification($familyMember);

            return redirect()->route('users.welcome')
                ->with('success', 'تم تسجيل الدخول بنجاح');
        }

        return back()
            ->withInput($request->only('family_number'))
            ->withErrors(['login' => 'رقم العضوية أو رمز الدخول غير صحيح']);
    }
    public function edit_tips(MyFamily $myFamily)
    {
        $tips = Tip::where('status', 1)->get();
        $selectedTips = $myFamily->tips->pluck('id')->toArray();
        $customTips = $myFamily->customTips;

        return view('users.family.tips', compact('myFamily', 'tips', 'selectedTips', 'customTips'));
    }

    public function update_tips(Request $request, MyFamily $myFamily)
    {
        $request->validate([
            'tips' => 'nullable|array',
            'tips.*' => 'exists:tips,id',
        ]);

        MyFamilyTip::where('my_family_id', $myFamily->id)
            ->whereNotNull('tip_id')
            ->delete();

        if ($request->has('tips')) {
            foreach ($request->tips as $tipId) {
                MyFamilyTip::create([
                    'my_family_id' => $myFamily->id,
                    'tip_id' => $tipId,
                ]);
            }
        }

        $this->sendNotification(
            "تم تحديث الإرشادات لـ {$myFamily->name}",
            'تحديث الإرشادات',
            'tips_updated',
            ['member_name' => $myFamily->name]
        );

        return redirect()->route('users.family.show', $myFamily)
            ->with('success', 'تم تحديث الإرشادات بنجاح');
    }

    public function delete_custom_tip(MyFamilyTip $customTip)
    {
        $myFamily = $customTip->myFamily;

        $customTip->delete();

        $this->sendNotification(
            "تم حذف إرشاد من {$myFamily->name}",
            'حذف إرشاد',
            'tip_deleted',
            ['member_name' => $myFamily->name]
        );

        return response()->json(['success' => true]);
    }

    public function add_edit_tips(MyFamily $myFamily)
    {
        return view('users.family.add_tips', compact('myFamily'));
    }

    public function add_update_tips(Request $request, MyFamily $myFamily)
    {
        $request->validate([
            'custom_tip' => 'required|string|max:255',
        ]);

        MyFamilyTip::create([
            'my_family_id' => $myFamily->id,
            'custom_tip' => $request->custom_tip,
        ]);

        $this->sendNotification(
            "تم إضافة إرشاد إلى {$myFamily->name}",
            'إضافة إرشاد',
            'tip_added',
            ['member_name' => $myFamily->name]
        );

        return redirect()->route('users.family.show', $myFamily)
            ->with('success', 'تم إضافة الإرشاد المخصص بنجاح');
    }
}
