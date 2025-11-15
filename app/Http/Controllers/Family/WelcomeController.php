<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Kitchens;
use App\Models\Recipe;
use App\Models\MealPlanDetail;
use App\Models\MyFamily;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
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

        // ✅ التحقق من Family Member أو User عادي
        $recipe = null;
        $completedSteps = [];
        $userId = null;

        // التحقق من Family Member أولاً
        if (session('is_family_logged_in')) {
            $familyMember = MyFamily::find(session('family_id'));
            if ($familyMember && $familyMember->user_id) {
                $userId = $familyMember->user_id;
            }
        }
        // إذا مش Family، شوف لو User عادي
        elseif (Auth::check()) {
            $userId = Auth::id();
        }

        // جلب الوصفة بناءً على userId
        if ($userId) {
            $recipe = MealPlanDetail::whereRelation('mealPlan', 'user_id', $userId)
                ->with(['recipe' => function ($q) {
                    $q->withCount('favorites');
                }, 'mealPlan'])
                ->first();

            // جلب الخطوات المكتملة
            if ($recipe && $recipe->recipe) {
                $completedSteps = session()->get("recipe_{$recipe->recipe->id}_completed_steps", []);
            }
        }

        return view('families.welcome', compact(
            'favorites_count',
            'latest_recipes',
            'banner',
            'dailyRecipe',
            'nextRecipe',
            'kitchens',
            'topRecipes',
            'recipe',
            'completedSteps'
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
}
