<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MealPlanDetail;
use App\Models\MyFamily;
use Illuminate\Support\Facades\Auth;
use App\Models\MealPlan;
use App\Models\Recipe;
use App\Models\Notification;

class MealFamilyController extends Controller
{
    protected function getUserId()
    {
        // لو فيه user عامل login
        if (Auth::check()) {
            return Auth::id();
        }

        // لو فيه طباخ عامل login بالـ session
        if (session('is_cook_logged_in')) {
            $cookId = session('cook_id');
            $cook = \App\Models\Cook::find($cookId);
            return $cook?->user_id;
        }

        // لو فيه فرد عائلة عامل login بالـ session
        if (session('is_family_logged_in')) {
            $familyId = session('family_id');
            $family = MyFamily::find($familyId);
            return $family?->user_id;
        }

        return null;
    }

    public function index()
    {
        $userId = $this->getUserId();
        if (!$userId) {
            return redirect()->route('login');
        }
        $recipe = MealPlanDetail::whereRelation('mealPlan', 'user_id', $userId)
            ->with(['recipe' => fn($q) => $q->withCount('favorites'), 'mealPlan'])
            ->first();
        $recipeCount = MealPlanDetail::whereRelation('mealPlan', 'user_id', $userId)->count();
        $nextMeal = $nextMealType = null;
        if ($recipe?->mealPlan) {
            $meals = is_string($recipe->mealPlan->meals)
                ? json_decode($recipe->mealPlan->meals, true)
                : $recipe->mealPlan->meals;
            $now = \Carbon\Carbon::now();
            $currentTime = $now->format('H:i');
            $today = $now->format('Y-m-d');
            $mealTimes = [];
            foreach (['breakfast', 'lunch', 'dinner'] as $type) {
                if (isset($meals[$type]) && ($meals[$type]['active'] ?? false)) {
                    $mealTime = $meals[$type]['time'] ?? null;
                    $excludedDays = $meals[$type]['excluded_days'] ?? [];
                    if ($mealTime && !in_array($today, $excludedDays)) {
                        $mealTimes[] = [
                            'type' => $type,
                            'time' => $mealTime,
                            'data' => $meals[$type]
                        ];
                    }
                }
            }
            usort($mealTimes, fn($a, $b) => $a['time'] <=> $b['time']);
            foreach ($mealTimes as $meal) {
                if ($meal['time'] > $currentTime) {
                    $nextMealType = $meal['type'];
                    $nextMeal = $meal['data'];
                    break;
                }
            }
            if (!$nextMeal && $mealTimes) {
                $nextMealType = $mealTimes[0]['type'];
                $nextMeal = $mealTimes[0]['data'];
            }
        }
        return view('families.meals.index', compact('recipe', 'recipeCount', 'nextMeal', 'nextMealType'));
    }

    public function show()
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect()->route('login');
        }

        $mealPlans = MealPlan::with(['details.recipe'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $breakfasts = $lunches = $dinners = [];

        foreach ($mealPlans as $plan) {
            $familyNames = MyFamily::whereIn('id', $plan->family_members ?? [])->pluck('name')->toArray();
            $meals = is_string($plan->meals) ? json_decode($plan->meals, true) : ($plan->meals ?? []);

            foreach ($plan->details as $detail) {
                $type = $detail->meal_type;
                $mealDate = \Carbon\Carbon::parse($detail->meal_date);

                // فلترة الوجبات بتاريخ أكبر أو يساوي اليوم
                if ($mealDate->lt(\Carbon\Carbon::today())) {
                    continue; // تجاهل الوجبات اللي تاريخها قبل اليوم
                }

                $mealData = is_string($plan->meals) ? json_decode($plan->meals, true) : ($plan->meals ?? []);
                $mealTypeData = $mealData[$type] ?? [];

                if (!($mealTypeData['active'] ?? false)) continue;
                if (in_array($mealDate->toDateString(), $mealTypeData['excluded_days'] ?? [])) continue;
                if (!$detail->recipe_id || !$detail->recipe) continue;

                $data = [
                    'id' => $plan->id,
                    'meal_plan_id' => $plan->id,
                    'plan' => $plan,
                    'date' => $mealDate,
                    'family_names' => $familyNames,
                    'type' => $type,
                    'notes' => $mealTypeData['notes'] ?? null,
                    'features' => $mealTypeData['features'] ?? [],
                    'recipe' => $detail->recipe,
                    'recipe_id' => $detail->recipe_id,
                    'detail_id' => $detail->id,
                    'salad_id' => $detail->salad_id,
                    'drink_id' => $detail->drink_id,
                    'appetizers_id' => $detail->appetizers_id,
                    'healthy_food_id' => $detail->healthy_food_id,
                    'soup_id' => $detail->soup_id,
                    'desserts_id' => $detail->desserts_id,
                    'sauces_id' => $detail->sauces_id,
                    'side_dish_id' => $detail->side_dish_id
                ];

                match ($type) {
                    'breakfast' => $breakfasts[] = $data,
                    'lunch'     => $lunches[] = $data,
                    'dinner'    => $dinners[] = $data,
                    default     => null,
                };
            }
        }

        return view('families.meals.show', compact('breakfasts', 'lunches', 'dinners'));
    }

    public function viewMeal(string $id)
    {
        $recipe = MealPlanDetail::with([
            'recipe' => function ($query) {
                $query->withCount('favoritedBy');
            },
            'salad',
            'drink',
            'appetizer',
            'healthyFood',
            'soup',
            'dessert',
            'sauce',
            'sideDish',
            'recipe.kitchen',
            'recipe.subCategories',
            'mealPlan'
        ])->findOrFail($id);
        return view('families.meals.view-meal', compact('recipe'));
    }

    public function viewMealLunch(string $id)
    {
        $recipe = MealPlanDetail::with([
            'recipe' => function ($query) {
                $query->withCount('favoritedBy');
            },
            'salad',    // إضافة العلاقات
            'drink',
            'appetizer',
            'healthyFood',
            'soup',
            'dessert',
            'sauce',
            'sideDish',
            'recipe.kitchen',
            'recipe.subCategories',
            'mealPlan'
        ])->findOrFail($id);
        return view('families.meals.view-meal-lunch', compact('recipe'));
    }

    public function viewMealDinner(string $id)
    {
        $recipe = MealPlanDetail::with([
            'recipe' => function ($query) {
                $query->withCount('favoritedBy');
            },
            'salad',    // إضافة العلاقات
            'drink',
            'appetizer',
            'healthyFood',
            'soup',
            'dessert',
            'sauce',
            'sideDish',
            'recipe.kitchen',
            'recipe.subCategories',
            'mealPlan'
        ])->findOrFail($id);
        return view('families.meals.view-meal-dinner', compact('recipe'));
    }

    public function showMeal(string $id)
    {
        $recipe = Recipe::find($id);
        $mealPlan = MealPlan::whereHas('details', function ($query) use ($id) {
            $query->where('recipe_id', $id);
        })->first();
        return view('families.meals.show-meal', compact('recipe', 'mealPlan'));
    }

    public function showChangeRecipe(Request $request, string $id, string $type)
    {
        $mealDetail = MealPlanDetail::findOrFail($id);
        $currentRecipeId = $type === 'recipe'
            ? $mealDetail->recipe_id
            : $mealDetail->{$type . '_id'};
        $query = Recipe::where('id', '!=', $currentRecipeId);
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%{$search}%");
        }
        $alternatives = $query->with('kitchen')->paginate(10)->appends($request->query());
        return view('families.meals.change-recipe', compact('mealDetail', 'alternatives', 'type'));
    }

    public function ingredients(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('families.meals.ingredients', compact('recipe'));
    }

    public function steps(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        $steps = is_string($recipe->steps) ? json_decode($recipe->steps, true) : $recipe->steps;
        $completedSteps = session()->get("recipe_{$id}_completed_steps", []);
        return view('families.meals.steps', compact('recipe', 'steps', 'completedSteps'));
    }

    public function families(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        $mealPlan = MealPlan::whereHas('details', function ($query) use ($id) {
            $query->where('recipe_id', $id);
        })->first();
        if ($mealPlan && $mealPlan->family_members) {
            $familyMemberIds = is_array($mealPlan->family_members)
                ? $mealPlan->family_members
                : json_decode($mealPlan->family_members, true);
            $familyMembers = MyFamily::whereIn('id', $familyMemberIds)->get();
            foreach ($familyMembers as $member) {
                $tips = \App\Models\MyFamilyTip::where('my_family_id', $member->id)->get();
                $notes = [];
                foreach ($tips as $tip) {
                    if (!empty($tip->custom_tip)) {
                        $notes[] = $tip->custom_tip;
                    }
                    if ($tip->tip && !empty($tip->tip->name_ar)) {
                        $notes[] = $tip->tip->name_ar;
                    }
                }
                $member->family_notes = !empty($notes) ? implode('، ', $notes) : null;
            }
        } else {
            $familyMembers = collect();
        }

        return view('families.meals.families', compact('recipe', 'familyMembers'));
    }

    public function resetSteps(Request $request)
    {
        $recipeId = $request->recipe_id;
        session()->forget("recipe_{$recipeId}_completed_steps");
        return response()->json(['success' => true]);
    }

    public function facts(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('families.meals.facts', compact('recipe'));
    }
}
