<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use App\Models\MealPlanDetail;
use App\Models\Recipe;
use App\Models\MyFamily;
use App\Models\Kitchens;
use App\Models\MainCategories;
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
        $request->validate([
            'startDatePicker' => 'required|date',
            'endDatePicker'   => 'required|date|after_or_equal:startDatePicker',
            'familyMembers'   => 'required|array|min:1',
            'familyMembers.*' => 'exists:my_family,id',
        ]);

        $selectedMeals = collect(['breakfast', 'lunch', 'dinner'])
            ->filter(fn($type) => $request->has("meal_{$type}_active"))
            ->values();

        if ($selectedMeals->isEmpty()) {
            return back()->withErrors(['meals' => 'يجب اختيار وجبة واحدة على الأقل']);
        }

        $mealTimes = [
            'breakfast' => 'إفطار',
            'lunch' => 'غداء',
            'dinner' => 'عشاء',
        ];

        foreach ($mealTimes as $type => $label) {
            if ($request->has("meal_{$type}_active") && empty($request->input("time_{$type}"))) {
                return back()->withErrors([
                    "time_{$type}" => "يجب إدخال وقت وجبة {$label} عند تفعيلها."
                ])->withInput();
            }
        }

        // التحقق من التكرار
        $startDate = $request->startDatePicker;
        $endDate = $request->endDatePicker;
        $userId = auth()->id();

        foreach ($selectedMeals as $mealType) {
            $existingPlan = MealPlan::where('user_id', $userId)
                ->where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('start_date', [$startDate, $endDate])
                        ->orWhereBetween('end_date', [$startDate, $endDate])
                        ->orWhere(function ($q) use ($startDate, $endDate) {
                            $q->where('start_date', '<=', $startDate)
                                ->where('end_date', '>=', $endDate);
                        });
                })
                ->whereJsonContains('meals->' . $mealType . '->active', true)
                ->first();

            if ($existingPlan) {
                $mealName = $mealTimes[$mealType] ?? $mealType;
                return back()->withErrors([
                    'dates' => "تم إدخال وجبة {$mealName} مسبقاً في الفترة من {$existingPlan->start_date} إلى {$existingPlan->end_date}. يرجى اختيار تواريخ مختلفة أو إلغاء تفعيل الوجبة."
                ])->withInput();
            }
        }

        // جمع الأيام المستبعدة
        $excludedDaysBreakfast = $request->input('excluded_dates_breakfast', []);
        $excludedDaysLunch = $request->input('excluded_dates_lunch', []);
        $excludedDaysDinner = $request->input('excluded_dates_dinner', []);

        // بناء بيانات الوجبات
        $meals = [];
        foreach (['breakfast', 'lunch', 'dinner'] as $type) {
            $active = $request->has("meal_{$type}_active");

            $excludedDays = [];
            if ($type === 'breakfast') {
                $excludedDays = $excludedDaysBreakfast;
            } elseif ($type === 'lunch') {
                $excludedDays = $excludedDaysLunch;
            } elseif ($type === 'dinner') {
                $excludedDays = $excludedDaysDinner;
            }

            $meals[$type] = [
                'active' => $active,
                'time' => $active ? $request->input("time_{$type}") : null,
                'kitchens' => $active ? $request->input("kitchen_{$type}", []) : [],
                'features' => $active ? $request->input("features_{$type}", []) : [],
                'notes' => $active ? $request->input("comments_{$type}") : null,
                'excluded_days' => $active ? array_values($excludedDays) : [],
            ];
        }

        $meals['excluded_days'] = array_values(array_unique(array_merge(
            $excludedDaysBreakfast,
            $excludedDaysLunch,
            $excludedDaysDinner
        )));

        // حفظ الـ Meal Plan
        $mealPlan = MealPlan::create([
            'user_id' => auth()->id(),
            'start_date' => $request->startDatePicker,
            'end_date' => $request->endDatePicker,
            'family_members' => $request->familyMembers,
            'meals' => $meals,
        ]);

        $start = Carbon::parse($request->startDatePicker);
        $end = Carbon::parse($request->endDatePicker);

        // خريطة التصنيفات - محددة بدقة
        $featureCategories = [
            'contains_salad' => 'السلطات',
            'contains_drinks' => 'المشروبات',
            'contains_appetizers' => 'المقبلات',
            'contains_healthy_food' => 'الاكل الصحي',
            'contains_soup' => 'الشوربات',
            'contains_desserts' => 'الحلويات',
            'contains_sauces' => 'الصلصات',
            'contains_side_dish' => 'الاطباق الجانبية'
        ];	

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $currentDate = $date->toDateString();

            foreach ($selectedMeals as $type) {
                $excludedForThisMeal = [];
                if ($type === 'breakfast') {
                    $excludedForThisMeal = $excludedDaysBreakfast;
                } elseif ($type === 'lunch') {
                    $excludedForThisMeal = $excludedDaysLunch;
                } elseif ($type === 'dinner') {
                    $excludedForThisMeal = $excludedDaysDinner;
                }

                if (in_array($currentDate, $excludedForThisMeal)) {
                    continue;
                }

                // الوصفة الرئيسية
                $mainRecipe = Recipe::inRandomOrder()->first();
                if (!$mainRecipe) {
                    continue;
                }

                // معالجة الإضافات
                $additionalData = [];
                $selectedFeatures = $request->input("features_{$type}", []);

                \Log::info("Processing meal type: {$type}", ['features' => $selectedFeatures]);

                foreach ($selectedFeatures as $feature) {
                    if (isset($featureCategories[$feature])) {
                        $categoryName = $featureCategories[$feature];

                        \Log::info("Searching for recipe in category: {$categoryName}");

                        // البحث عن التصنيف أولاً
                        $category = MainCategories::where('name_ar', $categoryName)->first();

                        if ($category) {
                            \Log::info("Found category: {$category->name_ar} with ID: {$category->id}");

                            // البحث عن وصفة في هذا التصنيف
                            $featureRecipe = Recipe::where('main_category_id', $category->id)->inRandomOrder()->first();

                            if ($featureRecipe) {
                                \Log::info("Found feature recipe: {$featureRecipe->id} - {$featureRecipe->name}");

                                // تعيين الوصفة في العمود المناسب
                                switch ($feature) {
                                    case 'contains_salad':
                                        $additionalData['salad_id'] = $featureRecipe->id;
                                        break;
                                    case 'contains_drinks':
                                        $additionalData['drink_id'] = $featureRecipe->id;
                                        break;
                                    case 'contains_appetizers':
                                        $additionalData['appetizers_id'] = $featureRecipe->id;
                                        break;
                                    case 'contains_healthy_food':
                                        $additionalData['healthy_food_id'] = $featureRecipe->id;
                                        break;
                                    case 'contains_soup':
                                        $additionalData['soup_id'] = $featureRecipe->id;
                                        break;
                                    case 'contains_desserts':
                                        $additionalData['desserts_id'] = $featureRecipe->id;
                                        break;
                                    case 'contains_sauces':
                                        $additionalData['sauces_id'] = $featureRecipe->id;
                                        break;
                                    case 'contains_side_dish':
                                        $additionalData['side_dish_id'] = $featureRecipe->id;
                                        break;
                                }
                            } else {
                                \Log::warning("No recipe found for category: {$categoryName}");
                            }
                        } else {
                            \Log::warning("Category not found: {$categoryName}");
                        }
                    } else {
                        \Log::warning("Feature not in mapping: {$feature}");
                    }
                }

                \Log::info("Final additional data:", $additionalData);

                // إنشاء السجل
                MealPlanDetail::create(array_merge([
                    'meal_plan_id' => $mealPlan->id,
                    'meal_date' => $currentDate,
                    'meal_type' => $type,
                    'recipe_id' => $mainRecipe->id,
                    'is_active' => true,
                    'user_id' => auth()->id(),
                ], $additionalData));
            }
        }

        return redirect()->route('users.meals.index')->with('success', 'تم إنشاء جدول الوجبات بنجاح!');
    }

    public function show($id)
    {
        $mealPlan = MealPlan::with([
            'details.recipe',
            'details.salad',    // إضافة العلاقات
            'details.drink',
            'details.appetizer',
            'details.healthyFood',
            'details.soup',
            'details.dessert',
            'details.sauce',
            'details.sideDish'
        ])
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $familyMembers = MyFamily::whereIn('id', $mealPlan->family_members)->get();
        $mealsByDate = $mealPlan->details
            ->groupBy('meal_date')
            ->map(function ($meals) {
                return $meals->groupBy('meal_type');
            });

        return view('users.cook_table.show', compact('mealPlan', 'familyMembers', 'mealsByDate'));
    }
    public function index()
    {
        $plans = MealPlan::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('users.welcome', compact('plans'));
    }

    public function destroyDay(Request $request, $mealPlanId, $date, $type)
    {
        $mealPlanDetail = MealPlanDetail::where('meal_plan_id', $mealPlanId)
            ->where('meal_date', $date)->where('meal_type', $type)->first();
        if ($mealPlanDetail) {
            $mealPlanDetail->update(['is_active' => false]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function edit($id)
    {
        $mealPlan = MealPlan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $my_family = MyFamily::where('user_id', auth()->id())->get();
        $recipes = Recipe::where('status', 1)->get();
        $kitchens = Kitchens::where('status', 1)->get();

        return view('users.cook_table.edit', compact('mealPlan', 'my_family', 'recipes', 'kitchens'));
    }

    public function update(Request $request, $id)
    {
        $mealPlan = MealPlan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $request->validate([
            'startDatePicker' => 'required|date',
            'endDatePicker'   => 'required|date|after_or_equal:startDatePicker',
            'familyMembers'   => 'nullable|array|min:1',
            'familyMembers.*' => 'exists:my_family,id',
        ]);

        $selectedMeals = collect(['breakfast', 'lunch', 'dinner'])
            ->filter(fn($type) => $request->has("meal_{$type}_active"))
            ->values();

        if ($selectedMeals->isEmpty()) {
            return back()->withErrors(['meals' => 'يجب اختيار وجبة واحدة على الأقل']);
        }

        $mealTimes = [
            'breakfast' => 'إفطار',
            'lunch' => 'غداء',
            'dinner' => 'عشاء',
        ];

        foreach ($mealTimes as $type => $label) {
            if ($request->has("meal_{$type}_active") && empty($request->input("time_{$type}"))) {
                return back()->withErrors([
                    "time_{$type}" => "يجب إدخال وقت وجبة {$label} عند تفعيلها."
                ])->withInput();
            }
        }

        // جمع الأيام المستبعدة
        $excludedDaysBreakfast = $request->input('excluded_dates_breakfast', []);
        $excludedDaysLunch = $request->input('excluded_dates_lunch', []);
        $excludedDaysDinner = $request->input('excluded_dates_dinner', []);

        // بناء بيانات الوجبات
        $meals = [];
        foreach (['breakfast', 'lunch', 'dinner'] as $type) {
            $active = $request->has("meal_{$type}_active");

            $excludedDays = [];
            if ($type === 'breakfast') {
                $excludedDays = $excludedDaysBreakfast;
            } elseif ($type === 'lunch') {
                $excludedDays = $excludedDaysLunch;
            } elseif ($type === 'dinner') {
                $excludedDays = $excludedDaysDinner;
            }

            $meals[$type] = [
                'active' => $active,
                'time' => $active ? $request->input("time_{$type}") : null,
                'kitchens' => $active ? $request->input("kitchen_{$type}", []) : [],
                'features' => $active ? $request->input("features_{$type}", []) : [],
                'notes' => $active ? $request->input("comments_{$type}") : null,
                'excluded_days' => $active ? array_values($excludedDays) : [],
            ];
        }

        $meals['excluded_days'] = array_values(array_unique(array_merge(
            $excludedDaysBreakfast,
            $excludedDaysLunch,
            $excludedDaysDinner
        )));

        // تحديث البيانات
        $mealPlan->update([
            'start_date' => $request->startDatePicker,
            'end_date' => $request->endDatePicker,
            'family_members' => $request->familyMembers,
            'meals' => $meals,
        ]);

        // حذف التفاصيل القديمة
        MealPlanDetail::where('meal_plan_id', $mealPlan->id)->delete();

        // إعادة إنشاء التفاصيل
        $start = Carbon::parse($request->startDatePicker);
        $end = Carbon::parse($request->endDatePicker);

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $currentDate = $date->toDateString();

            foreach ($selectedMeals as $type) {
                $excludedForThisMeal = [];
                if ($type === 'breakfast') {
                    $excludedForThisMeal = $excludedDaysBreakfast;
                } elseif ($type === 'lunch') {
                    $excludedForThisMeal = $excludedDaysLunch;
                } elseif ($type === 'dinner') {
                    $excludedForThisMeal = $excludedDaysDinner;
                }

                if (in_array($currentDate, $excludedForThisMeal)) {
                    continue;
                }

                // الوصفة الرئيسية
                $mainRecipe = Recipe::inRandomOrder()->first();
                if (!$mainRecipe) {
                    continue;
                }

                // ✅ نقل $selectedFeatures هنا قبل $additionalData
                $selectedFeatures = $request->input("features_{$type}", []);

                // ✅ الآن نعرف $additionalData بعد جلب الـ features
                $additionalData = [];

                \Log::info("Processing meal type: {$type}", ['features' => $selectedFeatures]);

                foreach ($selectedFeatures as $feature) {
                    if (isset($featureCategories[$feature])) {
                        $categoryName = $featureCategories[$feature];

                        \Log::info("Searching for recipe in category: {$categoryName}");

                        $category = MainCategories::where('name_ar', $categoryName)->first();

                        if ($category) {
                            \Log::info("Found category: {$category->name_ar} with ID: {$category->id}");

                            $featureRecipe = Recipe::where('main_category_id', $category->id)
                                ->inRandomOrder()
                                ->first();

                            if ($featureRecipe) {
                                \Log::info("Found feature recipe: {$featureRecipe->id} - {$featureRecipe->name}");

                                switch ($feature) {
                                    case 'contains_salad':
                                        $additionalData['salad_id'] = $featureRecipe->id;
                                        break;
                                    case 'contains_drinks':
                                        $additionalData['drink_id'] = $featureRecipe->id;
                                        break;
                                    case 'contains_appetizers':
                                        $additionalData['appetizer_id'] = $featureRecipe->id;
                                        break;
                                    case 'contains_healthy_food':
                                        $additionalData['healthy_food_id'] = $featureRecipe->id;
                                        break;
                                    case 'contains_soup':
                                        $additionalData['soup_id'] = $featureRecipe->id;
                                        break;
                                    case 'contains_desserts':
                                        $additionalData['desserts_id'] = $featureRecipe->id;
                                        break;
                                    case 'contains_sauces':
                                        $additionalData['sauces_id'] = $featureRecipe->id;
                                        break;
                                    case 'contains_side_dish':
                                        $additionalData['side_dish_id'] = $featureRecipe->id;
                                        break;
                                }
                            } else {
                                \Log::warning("No recipe found for category: {$categoryName}");
                            }
                        } else {
                            \Log::warning("Category not found: {$categoryName}");
                        }
                    }
                }

                \Log::info("Final additional data:", $additionalData);

                // إنشاء السجل
                MealPlanDetail::create(array_merge([
                    'meal_plan_id' => $mealPlan->id,
                    'meal_date' => $currentDate,
                    'meal_type' => $type,
                    'recipe_id' => $mainRecipe->id,
                    'is_active' => true,
                    'user_id' => auth()->id(),
                ], $additionalData));
            }
        }

        return redirect()->route('meal_plans.show', $mealPlan->id)
            ->with('success', 'تم تحديث جدول الوجبات بنجاح!');
    }
}
