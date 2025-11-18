<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Kitchens;
use App\Models\Recipe;
use App\Models\MealPlanDetail;
use Illuminate\Support\Facades\Auth;
use App\Models\MyFamily;
use App\Models\Notification;
use App\Models\User;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner = Banner::where('display_location', 'mobile_app')
            ->where('status', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->latest()
            ->first();

        $dailyRecipe = $this->getDailyRecipeForUser();
        $nextRecipe = null;

        if ($dailyRecipe) {
            $nextRecipe = Recipe::where('id', '>', $dailyRecipe->id)
                ->orderBy('id', 'asc')
                ->first();
            if (!$nextRecipe) {
                $nextRecipe = Recipe::orderBy('id', 'asc')->first();
            }
            $favorites_count = $dailyRecipe->favoritedBy()->count();
        } else {
            $favorites_count = 0;
        }

        $kitchens = Kitchens::where('status', 1)->withCount('recipes')->get();
        $topRecipes = Recipe::withCount('favoritedBy')
            ->orderByDesc('favorited_by_count')
            ->take(3)
            ->get();

        $latest_recipes = Recipe::latest()->take(5)->get();

        // ✅ التحقق من وجود user مسجل دخول أولاً
        $recipe = null;
        $completedSteps = [];

        if (Auth::check()) {
            $recipe = MealPlanDetail::whereRelation('mealPlan', 'user_id', Auth::id())
                ->with(['recipe' => function ($q) {
                    $q->withCount('favorites');
                }, 'mealPlan'])
                ->first();

            // جلب الخطوات المكتملة فقط لو الـ recipe موجودة
            if ($recipe && $recipe->recipe) {
                $completedSteps = session()->get("recipe_{$recipe->recipe->id}_completed_steps", []);
            }
        }

        // تحديد الـ user_id من السيشن أو الأوث
        $userId = session('user_id') ?? auth()->id() ?? null;

        if (session('family_id')) {
            $familyMember = MyFamily::find(session('family_id'));
            $userId = $familyMember->user_id ?? null;
        }

        // الإشعارات تكون اختيارية
        $notifications = null;

        if (Auth::check()) {       // <<< هنا التعويض الصحيح
            $notifications = User::find(Auth::id())->allNotifications();
        }

        return view('users.welcome', compact(
            'favorites_count',
            'latest_recipes',
            'banner',
            'dailyRecipe',
            'nextRecipe',
            'kitchens',
            'topRecipes',
            'recipe',
            'completedSteps',
            'notifications'
        ));
    }

    private function getDailyRecipeForUser()
    {
        $userId = auth()->id();
        $today = now()->format('Y-m-d');
        $seed = crc32($userId . $today);
        $recipesCount = Recipe::count();
        if ($recipesCount == 0) {
            return null;
        }
        $randomIndex = $seed % $recipesCount;
        return Recipe::skip($randomIndex)->first();
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
