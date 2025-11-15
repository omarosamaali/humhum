<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MealPlanDetail;
use App\Models\MyFamily;
use Illuminate\Support\Facades\Auth;
use App\Models\MealPlan;
use App\Models\Recipe;
use App\Models\Notification;
use App\Models\SpecialRequest;

class RequestsController extends Controller
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

    public function specialRequests()
    {
        $cookId = session('id')
            ?? session('user_id')
            ?? session('cook_id')
            ?? Auth::id();

        $requests = SpecialRequest::with(['user', 'recipe', 'familyMember', 'cook']) // أضف cook هنا
            ->where('cook_id', $cookId)
            ->orderBy('date', 'desc')
            ->get();

        return view('chefs.special-requests', compact('requests'));
    }
    
    public function index()
    {
        return view('chefs.welcome');
    }

    public function show()
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
}
