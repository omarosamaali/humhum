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
use App\Models\Family;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;

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

        // إنشاء سجل في جدول MyFamily
        $familyMember = MyFamily::create([
            'name' => $request->name,
            'language' => $request->language,
            'user_id' => $user->id,
            'owner' => '0',
        ]);

        // إنشاء حساب مستخدم جديد مربوط بـ MyFamily
        $newUser = User::create([
            'name' => $request->name,
            'email' => 'family_' . $familyMember->id . '@family.local',
            'password' => bcrypt(Str::random(16)),
            'language' => $request->language,
            'family_member_id' => $familyMember->id,
            'country'  => Auth::user()->country,
            'role' => 'مستخدم',
            'status' => 'فعال'
            // الربط هنا
        ]);

        $this->sendNotification(
            __("messages.member_added_success", ['member_name' => $request->name]),
            __('messages.new_member_title'),
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
        $avatars = Family::where('status', '1')->get();
        return view('users.family.chooseImage', compact('myFamily', 'avatars'));
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
            __("messages.avatar_updated_message", ['member_name' => $myFamily->name]),
            __('messages.avatar_updated_title'),
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
            __("messages.name_updated_message", ['old_name' => $oldName, 'new_name' => $request->name]),
            __('messages.name_updated_title'),
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

        $statusText = $request->has_email == '1' ? __('messages.activated') : __('messages.deactivated');

        $this->sendNotification(
            __("messages.access_status_changed_message", [
                'status' => $statusText,
                'member_name' => $myFamily->name
            ]),
            __("messages.access_status_changed_title", ['status' => $statusText]),
            'access_status_changed',
            [
                'member_name' => $myFamily->name,
                'status' => $request->has_email,
                'status_text' => $statusText
            ]
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

        $statusText = $request->send_notification == '1' ? __('messages.enabled') : __('messages.disabled');

        $this->sendNotification(
            __("messages.notification_status_changed_message", [
                'status' => $statusText,
                'member_name' => $myFamily->name
            ]),
            __("messages.notification_status_changed_title", ['status' => $statusText]),
            'notification_status_changed',
            [
                'member_name' => $myFamily->name,
                'status' => $request->send_notification,
                'status_text' => $statusText
            ]
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
            __("messages.language_changed_message", [
                'member_name' => $myFamily->name,
                'language' => __('messages.' . $request->language)
            ]),
            __('messages.language_changed_title'),
            'language_changed',
            [
                'member_name' => $myFamily->name,
                'language' => $request->language,
                'language_text' => __('messages.' . $request->language)
            ]
        );

        return redirect()->route('users.family.show', $myFamily)->with('success', 'تم تحديث البيانات بنجاح');
    }

    public function destroy(MyFamily $myFamily)
    {
        $memberName = $myFamily->name;

        $myFamily->forceDelete();
        $myFamily->delete();

        $this->sendNotification(
            __("messages.member_deleted_message", ['member_name' => $memberName]),
            __('messages.member_deleted_title'),
            'member_deleted',
            ['member_name' => $memberName]
        );

        return redirect()->route('users.family.index')->with('success', 'تم حذف الفرد بنجاح');
    }

    public function family_login($family_number = null, $member_id = null)
    {
        if (session('is_family_logged_in')) {
            return redirect()->route('families.welcome');
        }

        $memberData = null;
        if ($family_number && $member_id) {
            $memberData = MyFamily::where('family_number', $family_number)
                ->where('id', $member_id)
                ->first();
            if($memberData && $memberData->language) {
                App::setLocale($memberData->language);
            }
        }
        if (request()->cookie('family_remember')) {
            try {
                $data = json_decode(decrypt(request()->cookie('family_remember')), true);
                $familyMember = MyFamily::where('family_number', $data['family_number'])
                    ->where('password', $data['password'])
                    ->first();
                if ($familyMember) {
                    if ($familyMember->user_id) {
                        $user = User::find($familyMember->user_id);
                        if ($user) {
                            Auth::login($user);
                        }
                    }
                    session([
                        'family_id' => $familyMember->id,
                        'family_number' => $familyMember->family_number,
                        'family_name' => $familyMember->name,
                        'family_avatar' => $familyMember->avatar,
                        'family_language' => $familyMember->language, // ✅ أضف ده
                        'is_family_logged_in' => true
                    ]);

                    $this->sendFamilyLoginNotification($familyMember);
                    return redirect()->route('families.welcome');
                }
            } catch (\Exception $e) {
                // Cookie invalid
            }
        }

        return view('users.family_members.login', compact('memberData', 'family_number'));
    }

    public function family_login_post(Request $request)
    {
        $request->validate([
            'family_number' => 'required',
            'member_id' => 'required|numeric',
            'password' => 'required|size:4',
        ]);

        // تحقق من الـ family_number + member_id + password مع بعض
        $familyMember = MyFamily::where('family_number', $request->family_number)
            ->where('id', $request->member_id)
            ->where('password', $request->password) // تحقق من الباسورد
            ->first();

        if (!$familyMember) {
            return back()->withErrors(['login' => 'رقم العضوية أو رمز الدخول غير صحيح']);
        }

        session([
            'family_id' => $familyMember->id,
            'family_number' => $familyMember->family_number,
            'family_name' => $familyMember->name,
            'family_avatar' => $familyMember->avatar,
            'family_language' => $familyMember->language,
            'is_family_logged_in' => true
        ]);

        // حفظ cookie بناءً على id بدل password
        cookie()->queue('family_remember', encrypt(json_encode([
            'family_number' => $familyMember->family_number,
            'member_id' => $familyMember->id
        ])), 43200);

        $this->sendFamilyLoginNotification($familyMember);

        return redirect()->route('families.welcome')
            ->with('success', 'تم تسجيل الدخول بنجاح');
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
            __("messages.tips_updated_message", ['member_name' => $myFamily->name]),
            __('messages.tips_updated_title'),
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
            __("messages.tip_deleted_message", ['member_name' => $myFamily->name]),
            __('messages.tip_deleted_title'),
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
            __("messages.tip_added_message", ['member_name' => $myFamily->name]),
            __('messages.tip_added_title'),
            'tip_added',
            ['member_name' => $myFamily->name]
        );

        return redirect()->route('users.family.show', $myFamily)
            ->with('success', 'تم إضافة الإرشاد المخصص بنجاح');
    }
}
