<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use App\Models\MealPlanDetail;
use App\Models\MyFamily;
use App\Models\Recipe;
use App\Models\Cook;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;

class MealController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $mealPlans = MealPlan::with(['details.recipe'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $breakfasts = [];
        $lunches = [];
        $dinners = [];

        foreach ($mealPlans as $plan) {
            $familyNames = MyFamily::whereIn('id', $plan->family_members ?? [])->pluck('name')->toArray();
            $meals = is_string($plan->meals) ? json_decode($plan->meals, true) : ($plan->meals ?? []);
            $planDetails = $plan->details;
            foreach ($planDetails as $detail) {
                $type = $detail->meal_type;
                $mealDate = $detail->meal_date;
                $mealData = $meals[$type] ?? [];
                if (!($mealData['active'] ?? false)) {
                    continue;
                }
                $excludedDays = $mealData['excluded_days'] ?? [];
                if (in_array($mealDate, $excludedDays)) {
                    continue;
                }

                if (!$detail->recipe_id || !$detail->recipe) {
                    continue; // Skip if no recipe or recipe not found
                }

                $data = [
                    'id' => $plan->id,
                    'meal_plan_id' => $plan->id,
                    'plan' => $plan,
                    'date' => \Carbon\Carbon::parse($mealDate),
                    'family_names' => $familyNames,
                    'type' => $type,
                    'notes' => $mealData['notes'] ?? null,
                    'features' => $mealData['features'] ?? [],
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
                switch ($type) {
                    case 'breakfast':
                        $breakfasts[] = $data;
                        break;
                    case 'lunch':
                        $lunches[] = $data;
                        break;
                    case 'dinner':
                        $dinners[] = $data;
                        break;
                }
            }
        }

        return view('users.meals.index', compact('breakfasts', 'lunches', 'dinners'));
    }

    public function show(string $id)
    {
        $recipe = Recipe::find($id);
        $cookieName = 'recipe_view_' . $id;
        if (!request()->cookie($cookieName)) {
            $recipe->increment('views');
            cookie()->queue($cookieName, 'true', 43200);
        }
        return view('users.meals.show', compact('recipe'));
    }

    public function showMeal(string $id)
    {
        $recipe = Recipe::find($id);
        $mealPlan = MealPlan::whereHas('details', function ($query) use ($id) {
            $query->where('recipe_id', $id);
        })->first();
        return view('users.meals.show-meal', compact('recipe', 'mealPlan'));
    }

    public function ingredients(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('users.meals.ingredients', compact('recipe'));
    }

    public function steps(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        $steps = is_string($recipe->steps) ? json_decode($recipe->steps, true) : $recipe->steps;
        $completedSteps = session()->get("recipe_{$id}_completed_steps", []);
        return view('users.meals.steps', compact('recipe', 'steps', 'completedSteps'));
    }

    public function completeStep(Request $request)
    {
        try {
            $recipeId = $request->recipe_id;
            $recipeTitle = $request->meal_name;
            $stepIndex = $request->step_index;
            $completedSteps = session()->get("recipe_{$recipeId}_completed_steps", []);

            if (!in_array($stepIndex, $completedSteps)) {
                $completedSteps[] = $stepIndex;
                session()->put("recipe_{$recipeId}_completed_steps", $completedSteps);

                // نرسل الإشعار فقط عند بداية أول خطوة
                if ($stepIndex === 0) {
                    $familyId = session('family_id');
                    $cookId = session('cook_id');
                    $messageContent = "";
                    $userId = null;

                    if ($cookId) {
                        $cook = \App\Models\Cook::find($cookId);
                        if ($cook) {
                            $userId = $cook->user_id;
                            $messageContent = "الطاهي {$cook->name} بدأ في طبخ {$recipeTitle}";
                        }
                    } elseif ($familyId) {
                        $familyMember = \App\Models\MyFamily::find($familyId);
                        if ($familyMember) {
                            $userId = $familyMember->user_id;
                            $messageContent = "أحد أفراد العائلة {$familyMember->name} بدأ في طبخ {$recipeTitle}";
                        }
                    }

                    if ($messageContent != "" && $userId) {
                        // 1. التخزين في قاعدة البيانات
                        \App\Models\Notification::create([
                            'user_id' => $userId,
                            'message' => $messageContent,
                            'is_read' => false
                        ]);

                        // 2. إرسال لـ Firebase
                        $messaging = app('firebase.messaging');
                        $targetTopic = "family_group_" . $userId;

                        $fcmMessage = \Kreait\Firebase\Messaging\CloudMessage::withTarget('topic', $targetTopic)
                            ->withNotification(\Kreait\Firebase\Messaging\Notification::create('تنبيه طبخ جديد 🍳', $messageContent))
                            ->withAndroidConfig(\Kreait\Firebase\Messaging\AndroidConfig::fromArray([
                                'priority' => 'high', // ضروري جداً للتطبيق المغلق
                                'notification' => [
                                    'sound' => 'default',
                                    'channel_id' => 'default', // تأكد أن BuildNatively تستخدم default
                                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                                    'visibility' => 'public',
                                ],
                            ]))
                            ->withData([
                                'title' => 'تنبيه طبخ جديد 🍳',
                                'body' => $messageContent,
                                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                            ]);

                        $messaging->send($fcmMessage);

                        // اختياري: تسجيل في الـ Log للتأكد من الإرسال
                        \Log::info("FCM Sent to topic: $targetTopic");
                    }
                }
            }

            return response()->json(['success' => true, 'completed_steps' => $completedSteps]);
        } catch (\Exception $e) {
            \Log::error("FCM Error: " . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function resetSteps(Request $request)
    {
        $recipeId = $request->recipe_id;
        session()->forget("recipe_{$recipeId}_completed_steps");
        return response()->json(['success' => true]);
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

        return view('users.meals.families', compact('recipe', 'familyMembers'));
    }

    public function facts(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('users.meals.facts', compact('recipe'));
    }

    public function tableCook()
    {
        $recipe = MealPlanDetail::whereRelation('mealPlan', 'user_id', Auth::user()->id)
            ->with(['recipe' => function ($q) {
                $q->withCount('favorites');
            }, 'mealPlan'])
            ->first();
        $recipeCount = MealPlanDetail::whereRelation('mealPlan', 'user_id', Auth::user()->id)->count();
        $nextMeal = null;
        $nextMealType = null;
        if ($recipe && $recipe->mealPlan) {
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
            usort($mealTimes, function ($a, $b) {
                return strcmp($a['time'], $b['time']);
            });
            foreach ($mealTimes as $meal) {
                if ($meal['time'] > $currentTime) {
                    $nextMealType = $meal['type'];
                    $nextMeal = $meal['data'];
                    break;
                }
            }
            if (!$nextMeal && !empty($mealTimes)) {
                $nextMealType = $mealTimes[0]['type'];
                $nextMeal = $mealTimes[0]['data'];
            }
        }

        return view('users.meals.table-cook', compact('recipe', 'recipeCount', 'nextMeal', 'nextMealType'));
    }

    public function destroy(string $id)
    {
        $meals = MealPlan::findOrFail($id);
        $meals->delete();
        return redirect()->route('users.meals.table-cook');
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

        return view('users.meals.view-meal', compact('recipe'));
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
        return view('users.meals.change-recipe', compact('mealDetail', 'alternatives', 'type'));
    }

    public function updateRecipe(Request $request, string $id)
    {
        $request->validate([
            'new_recipe_id' => 'required|exists:recipes,id',
            'type' => 'required|in:recipe,salad,drink,appetizer,healthyFood,soup,dessert,sauce,sideDish'
        ]);
        $mealDetail = MealPlanDetail::findOrFail($id);
        $type = $request->type;
        $mealDetail->{$type . '_id'} = $request->new_recipe_id;
        $mealDetail->save();
        return redirect()
            ->route('users.meals.view-meal', $id)
            ->with('success', 'تم تغيير الوجبة بنجاح');
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

        return view('users.meals.view-meal-lunch', compact('recipe'));
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

        return view('users.meals.view-meal-dinner', compact('recipe'));
    }
}
