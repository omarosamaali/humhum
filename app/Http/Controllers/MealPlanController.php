<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use App\Models\MealPlanDetail;
use App\Models\Recipe;
use App\Models\MyFamily;
use App\Models\Kitchens;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MealPlanController extends Controller
{
    public function create()
    {
        $my_family = MyFamily::where('user_id', auth()->id())->get();
        $recipes = Recipe::where('status', 1)->get();
        $kitchens = Kitchens::where('status', 1)->get();
        return view('users.cook_table.index', compact('my_family', 'recipes', 'kitchens'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'family_members' => 'nullable|array',
            'meals' => 'required|array',
            'meals.*.date' => 'required|date',
            'meals.*.type' => 'required|in:breakfast,lunch,dinner',
            'meals.*.recipe_id' => 'nullable|exists:recipes,id',
            'meals.*.time' => 'nullable|date_format:H:i',
            'meals.*.additions' => 'nullable|array',
            'meals.*.notes' => 'nullable|string',
        ]);

        $mealPlan = MealPlan::create([
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'family_members' => $validated['family_members'],
            'user_id' => auth()->id(),
        ]);

        foreach ($validated['meals'] as $meal) {
            if ($meal['recipe_id']) {
                MealPlanDetail::create([
                    'meal_plan_id' => $mealPlan->id,
                    'meal_date' => $meal['date'],
                    'meal_type' => $meal['type'],
                    'recipe_id' => $meal['recipe_id'],
                    'meal_time' => $meal['time'],
                    'additions' => $meal['additions'],
                    'notes' => $meal['notes'],
                    'is_active' => true,
                ]);
            }
        }

        return redirect()->route('meal_plans.create')->with('success', 'تم إنشاء جدول الوجبات بنجاح');
    }

    public function destroyDay(Request $request, $mealPlanId, $date, $type)
    {
        $mealPlanDetail = MealPlanDetail::where('meal_plan_id', $mealPlanId)
            ->where('meal_date', $date)
            ->where('meal_type', $type)
            ->first();

        if ($mealPlanDetail) {
            $mealPlanDetail->update(['is_active' => false]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
