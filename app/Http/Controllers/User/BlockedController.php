<?php

namespace App\Http\Controllers\User;

use App\Models\Blocked;
use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MyFamily;

class BlockedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::where('status', 1)->withCount('favoritedBy')->get();
        $my_family = MyFamily::where('user_id', auth()->user()->id)->get();
        return view('users.blocked.index', compact('recipes', 'my_family'));
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
        $request->validate([
            'recipes' => 'required|array',
            'country' => 'required|array',
        ]);

        $user = auth()->user();
        $selectedRecipes = $request->recipes;
        $selectedMembers = $request->country;

        if (in_array("", $selectedMembers)) {
            $selectedMembers = MyFamily::where('user_id', $user->id)->pluck('id')->toArray();
        }

        foreach ($selectedRecipes as $recipeId) {
            foreach ($selectedMembers as $memberId) {
                Blocked::firstOrCreate([
                    'user_id' => $user->id,
                    'family_member_id' => $memberId,
                    'recipe_id' => $recipeId,
                ]);
            }
        }

        return back()->with('success', 'تم حظر الوجبة بنجاح!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Blocked $blocked)
    {
        $user = auth()->user();

        // نجيب كل الوجبات المحظورة للمستخدم مع العلاقات
        $my_blocked = Blocked::where('user_id', $user->id)
            ->with(['recipe.kitchen', 'recipe.subCategories', 'familyMember'])
            ->get()
            ->groupBy('recipe_id'); // نجمعهم حسب الوجبة

        // نجيب عدد أفراد العائلة للمستخدم
        $totalFamilyMembers = MyFamily::where('user_id', $user->id)->count();

        // نحول الداتا لفورمات أحسن للعرض
        $blockedRecipes = [];

        foreach ($my_blocked as $recipeId => $blocks) {
            $recipe = $blocks->first()->recipe;

            // نشوف كام عضو محظور من الوجبة دي
            $blockedMembersCount = $blocks->count();

            // لو عدد المحظورين = عدد أفراد العائلة، يبقى "الجميع"
            if ($blockedMembersCount == $totalFamilyMembers) {
                $membersText = 'الجميع';
            } else {
                // لو لأ، نجيب أسمائهم
                $membersNames = $blocks->pluck('familyMember.name')->toArray();
                $membersText = implode(', ', $membersNames);
            }

            $blockedRecipes[] = [
                'recipe' => $recipe,
                'members_text' => $membersText,
                'blocked_count' => $blockedMembersCount
            ];
        }

        return view('users.blocked.show', compact('blockedRecipes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($recipeId)
    {
        $user = auth()->user();

        // نجيب كل السجلات المحظورة لهذه الوجبة
        $blockedRecords = Blocked::where('user_id', $user->id)
            ->where('recipe_id', $recipeId)
            ->with(['recipe.kitchen', 'recipe.subCategories', 'familyMember'])
            ->get();

        // لو مفيش سجلات محظورة لهذه الوجبة
        if ($blockedRecords->isEmpty()) {
            return redirect()->route('users.blocked.show')->with('error', 'هذه الوجبة غير محظورة');
        }

        $recipe = $blockedRecords->first()->recipe;

        // نجيب الأعضاء المحظورين
        $blockedMembers = $blockedRecords->pluck('familyMember');

        // نجيب كل أفراد العائلة
        $allFamilyMembers = MyFamily::where('user_id', $user->id)->get();

        // نشوف لو محظورة للجميع
        $isBlockedForAll = ($blockedRecords->count() == $allFamilyMembers->count());

        return view('users.blocked.edit', compact('recipe', 'blockedMembers', 'allFamilyMembers', 'isBlockedForAll', 'blockedRecords'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $recipeId)
    {
        $request->validate([
            'members' => 'required|array',
            'members.*' => 'string'
        ]);

        $user = auth()->user();
        $selectedMembers = $request->members;

        // لو اختار "الجميع" أو كانت القيمة فاضية، نجيب كل أفراد العائلة
        if (in_array('all', $selectedMembers) || in_array('', $selectedMembers)) {
            $selectedMembers = MyFamily::where('user_id', $user->id)->pluck('id')->toArray();
        } else {
            // نتأكد إن كل الأعضاء موجودين
            $validMembers = MyFamily::where('user_id', $user->id)
                ->whereIn('id', $selectedMembers)
                ->pluck('id')
                ->toArray();

            if (count($validMembers) !== count($selectedMembers)) {
                return back()->with('error', 'بعض الأعضاء المختارين غير صحيحين');
            }

            $selectedMembers = $validMembers;
        }

        // نحذف كل السجلات القديمة لهذه الوجبة
        Blocked::where('user_id', $user->id)
            ->where('recipe_id', $recipeId)
            ->delete();

        // نضيف السجلات الجديدة
        foreach ($selectedMembers as $memberId) {
            Blocked::create([
                'user_id' => $user->id,
                'family_member_id' => $memberId,
                'recipe_id' => $recipeId,
            ]);
        }

        return redirect()->route('users.blocked.show')
            ->with('success', 'تم تحديث المحظورات بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($recipeId)
    {
        $user = auth()->user();

        // نحذف كل سجلات الحظر لهذه الوجبة
        $deleted = Blocked::where('user_id', $user->id)
            ->where('recipe_id', $recipeId)
            ->delete();

        if ($deleted) {
            return redirect()->route('users.blocked.show')
                ->with('success', 'تم إلغاء حظر الوجبة بنجاح!');
        }

        return redirect()->route('users.blocked.show')
            ->with('error', 'حدث خطأ أثناء إلغاء الحظر');
    }

}
