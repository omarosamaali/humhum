<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Models\Kitchens;
use App\Models\MainCategories;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Stichoza\GoogleTranslate\GoogleTranslate;

class RecipesController extends Controller
{
    public function allRecipes()
    {
        $user = Auth::user();

        if ($user && $user->role == 'طاه') {
            // جلب الوصفات النشطة مع العلاقات
            $activeRecipes = Recipe::where('user_id', Auth::user()->id)
                ->where('status', 1)
                ->with(['mainCategories', 'subCategories']) // تحميل العلاقات مسبقاً
                ->get();

            // جلب الوصفات غير النشطة مع العلاقات    
            $inactiveRecipes = Recipe::where('user_id', $user->id)
                ->where('status', 0)
                ->with(['mainCategories', 'subCategories'])
                ->get();
        } else {
            $activeRecipes = collect();
            $inactiveRecipes = collect();
        }

        $mainCategories = MainCategories::select('id', 'name_ar')->get();

        return view('c1he3f.recpies.all_recipes', [
            'activeRecipes' => $activeRecipes,
            'inactiveRecipes' => $inactiveRecipes,
            'mainCategories' => $mainCategories
        ]);
    }

    public function showStepsForm(Recipe $recipe)
    {
        $stepsData = $recipe->steps ? $recipe->steps : [];
        return view('c1he3f.recpies.steps', compact('recipe', 'stepsData'));
    }

    public function updateSteps(Request $request, Recipe $recipe)
    {
        Log::info('UpdateSteps Request:', ['all' => $request->all(), 'files' => $request->file()]);

        try {
            $request->validate([
                'steps_data' => 'nullable|json',
                'step_media.*.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,mp4,mov,avi,ogg,qt|max:512000',
            ]);

            $newStepsData = [];
            $stepsFromRequest = json_decode($request->input('steps_data'), true) ?? [];
            $uploadedFiles = $request->file('step_media') ?? [];

            foreach ($stepsFromRequest as $index => $step) {
                $description = $step['description'] ?? '';
                $currentStepMedia = $step['media'] ?? [];

                if (isset($uploadedFiles[$index]) && is_array($uploadedFiles[$index])) {
                    foreach ($uploadedFiles[$index] as $key => $file) {
                        if ($file && $file->isValid()) {
                            $path = $file->store('recipes/steps', 'public');
                            $type = Str::startsWith($file->getMimeType(), 'image/') ? 'image' : 'video';
                            $currentStepMedia[] = [
                                'path' => $path,
                                'url' => Storage::url($path),
                                'type' => $type,
                            ];
                            Log::info("File uploaded for step {$index}, key {$key}: {$path}, Type: {$type}");
                        } else {
                            Log::warning("Invalid file for step {$index}, key {$key}", ['file' => $file]);
                        }
                    }
                }

                $newStepsData[] = [
                    'description' => $description,
                    'media' => $currentStepMedia,
                ];
            }

            $recipe->steps = $newStepsData;
            $recipe->save();

            Log::info("Steps updated for Recipe ID: {$recipe->id}", ['steps' => $newStepsData]);
            return redirect()->route('c1he3f.recpies.showChefRecipes', $recipe->id)->with('success', 'تم تحديث الخطوات بنجاح!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error("Validation error updating steps for Recipe ID: {$recipe->id}: " . $e->getMessage(), ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors())->withInput()->with('error', 'خطأ في التحقق من صحة البيانات: ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error("Failed to update steps for Recipe ID: {$recipe->id}", ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث الخطوات: ' . $e->getMessage());
        }
    }

    public function showNutritionalFactsForm(Recipe $recipe)
    {
        return view('c1he3f.recpies.facts', compact('recipe'));
    }

    public function updateNutritionalFacts(Request $request, Recipe $recipe)
    {
        $validatedData = $request->validate([
            'calories' => 'nullable|integer|min:0',
            'fats' => 'nullable|numeric|min:0',
            'carbs' => 'nullable|numeric|min:0',
            'protein' => 'nullable|numeric|min:0',
        ]);
        $recipe->calories = $validatedData['calories'];
        $recipe->fats = $validatedData['fats'];
        $recipe->carbs = $validatedData['carbs'];
        $recipe->protein = $validatedData['protein'];
        $recipe->save();
        return redirect()->route('c1he3f.recpies.showChefRecipes', $recipe->id)->with('success', 'تم تحديث الحقائق الغذائية بنجاح!');
    }

    public function showIngredientsForm(Recipe $recipe)
    {
        $ingredientsData = $recipe->ingredients ?? [];
        return view('c1he3f.recpies.ingredients', compact('recipe', 'ingredientsData'));
    }

    public function updateIngredients(Request $request, Recipe $recipe)
    {
        Log::info('Update Ingredients Request received for recipe ID: ' . $recipe->id);
        $request->validate([
            'ingredients_data' => 'nullable|string',
            'redirect_url' => 'nullable|string',
        ]);

        $ingredientsDataString = $request->input('ingredients_data');
        $formattedIngredients = '';

        if (!empty($ingredientsDataString)) {
            $ingredientsArray = json_decode($ingredientsDataString, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($ingredientsArray)) {
                $lines = [];
                foreach ($ingredientsArray as $item) {
                    $description = trim($item['description'] ?? '');
                    $isHeading = filter_var($item['is_heading'] ?? false, FILTER_VALIDATE_BOOLEAN);

                    if (!empty($description)) {
                        if ($isHeading) {
                            $lines[] = '##' . $description;
                        } else {
                            $lines[] = $description;
                        }
                    }
                }
                $formattedIngredients = implode("\n", $lines);
                Log::info('Formatted ingredients string for saving:', ['string' => $formattedIngredients]);
            } else {
                Log::error('Failed to decode ingredients_data JSON or invalid array structure.', [
                    'json_error' => json_last_error_msg(),
                    'input_data' => $ingredientsDataString
                ]);
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'حدث خطأ في معالجة بيانات المكونات (JSON). الرجاء المحاولة مرة أخرى.'
                    ], 422);
                }
                return back()->with('error', 'حدث خطأ في معالجة بيانات المكونات (JSON). الرجاء المحاولة مرة أخرى.');
            }
        } else {
            Log::info('ingredients_data was empty. Saving empty string to database.');
        }
        $recipe->ingredients = $formattedIngredients;
        try {
            $recipe->save();
            Log::info('Recipe ingredients updated successfully for ID: ' . $recipe->id);
            $redirectUrl = $request->input('redirect_url', url()->previous());
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم تحديث المكونات بنجاح!',
                    'redirect' => $redirectUrl
                ]);
            }
            return redirect($redirectUrl)->with('success', 'تم تحديث المكونات بنجاح!');
        } catch (\Exception $e) {
            Log::error('Database save error for recipe ID: ' . $recipe->id, [
                'error' => $e->getMessage()
            ]);
            $errorMessage = 'حدث خطأ أثناء حفظ المكونات في قاعدة البيانات: ' . $e->getMessage();
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ], 500);
            }
            return back()->with('error', $errorMessage);
        }
    }

    public function index()
    {
        $recipes = Recipe::with(['kitchen', 'chef', 'mainCategories', 'subCategories'])->paginate(10);
        $kitchens = Kitchens::select('id', 'name_ar')->get();
        return view('admin.recipes.index', compact('recipes', 'kitchens'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $rules = $this->getValidationRules($request, true);
        try {
            $validatedData = $request->validate($rules);

            $validatedData['dish_image'] = $this->handleDishImage($request, $recipe);

            $user = Auth::user();
            if ($user->role === 'طاه') {
                $validatedData['chef_id'] = $user->id;
            }

            $processedSteps = $this->processRecipeSteps($request, $recipe);
            if (isset($processedSteps['errors'])) {
                if ($recipe->dish_image) {
                    Storage::disk('public')->delete($recipe->dish_image);
                }
                $recipe->delete();
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'خطأ في بيانات الخطوات',
                        'errors' => $processedSteps['errors']
                    ], 422);
                }
                return back()->withErrors($processedSteps['errors'])->withInput();
            }
            $validatedData['steps'] = $processedSteps;

            // التأكد من تحديث kitchen_type_id كقيمة واحدة
            $kitchenTypeId = $request->input('kitchen_type_id');
            if ($kitchenTypeId && is_numeric($kitchenTypeId)) {
                $validatedData['kitchen_type_id'] = $kitchenTypeId;
            } else {
                $validatedData['kitchen_type_id'] = null; // أو قيمة افتراضية إذا لزم
            }

            unset($validatedData['steps_data']);

            $recipe->update($validatedData);

            $recipe->subCategories()->sync($request->input('sub_categories', []));

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم تحديث الوصفة بنجاح!',
                    'redirect_url' => route('admin.recipes.index')
                ]);
            }
            return redirect()->route('admin.recipes.index')->with('success', 'تم تحديث الوصفة بنجاح!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error: ', $e->errors());
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'خطأ في التحقق من البيانات.',
                    'errors' => $e->errors()
                ], 422);
            }
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Update Error: ' . $e->getMessage(), ['exception' => $e]);
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ غير متوقع.',
                    'errors' => ['general' => [$e->getMessage()]]
                ], 500);
            }
            return back()->withErrors(['general' => [$e->getMessage()]])->withInput();
        }
    }

    public function editChef(Recipe $recipe)
    {
        $kitchens = Kitchens::select('id', 'name_ar')->get();
        $mainCategories = MainCategories::select('id', 'name_ar')->get();
        $chefs = collect();

        if (Auth::user()->role === 'مدير') {
            $chefs = User::where('role', 'طاه')->select('id', 'name')->get();
        }

        // تحديد التصنيفات الفرعية المختارة
        $selectedSubCategories = $recipe->subCategories->pluck('id')->toArray();

        // جلب التصنيفات الفرعية الخاصة بالتصنيف الرئيسي الحالي
        $subCategories = [];
        if ($recipe->main_category_id) {
            $subCategories = SubCategory::where('category_id', $recipe->main_category_id)
                ->select('id', 'name_ar')
                ->get();
        }

        return view('c1he3f.recpies.editChef', compact(
            'recipe',
            'kitchens',
            'mainCategories',
            'subCategories',
            'chefs',
            'selectedSubCategories'
        ));
    }

    public function updateChef(Request $request, Recipe $recipe)
    {
        $rules = $this->getValidationRules($request, true);

        if (auth()->user()->chefProfile->contract_type === 'per_recipe' && $request->input('is_free') == 0) {
            $rules['price'] = 'required|numeric|min:0';
        } else {
            $rules['price'] = 'nullable|numeric|min:0'; // السماح بـ null أو 0
        }

        try {
            $validatedData = $request->validate($rules);
            $validatedData['dish_image'] = $this->handleDishImage($request, $recipe);
            $user = Auth::user();
            if ($user->role === 'طاه') {
                $validatedData['chef_id'] = $user->id;
            }

            // تعيين السعر بناءً على is_free
            $validatedData['price'] = $request->input('is_free') == 1 ? 0 : ($validatedData['price'] ?? null);

            if ($request->has('steps_data') && !empty($request->input('steps_data'))) {
                $processedSteps = $this->processRecipeSteps($request, $recipe);
                if (isset($processedSteps['errors'])) {
                    if ($recipe->dish_image) {
                        Storage::disk('public')->delete($recipe->dish_image);
                    }
                    $recipe->delete();
                    if ($request->ajax()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'خطأ في بيانات الخطوات',
                            'errors' => $processedSteps['errors']
                        ], 422);
                    }
                    return back()->withErrors($processedSteps['errors'])->withInput();
                }
                $validatedData['steps'] = $processedSteps;
            }

            $kitchenTypeId = $request->input('kitchen_type_id');
            $validatedData['kitchen_type_id'] = $kitchenTypeId && is_numeric($kitchenTypeId) ? $kitchenTypeId : null;

            unset($validatedData['steps_data']);
            $recipe->update($validatedData);
            $recipe->subCategories()->sync($request->input('sub_categories', []));

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم تحديث الوصفة بنجاح!',
                    'redirect_url' => route('c1he3f.recpies.all_recipes')
                ]);
            }
            return redirect()->route('c1he3f.recpies.all_recipes')->with('success', 'تم تحديث الوصفة بنجاح!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'خطأ في التحقق من البيانات.',
                    'errors' => $e->errors()
                ], 422);
            }
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Update Error in updateChef: ' . $e->getMessage(), ['exception' => $e]);
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ غير متوقع.',
                    'errors' => ['general' => [$e->getMessage()]]
                ], 500);
            }
            return back()->withErrors(['general' => [$e->getMessage()]])->withInput();
        }
    }
    public function getSubCategories(Request $request)
    {
        try {
            $mainCategoryId = $request->get('category_id');

            if (!$mainCategoryId) {
                return response()->json([]);
            }

            $subCategories = SubCategory::where('category_id', $mainCategoryId)
                ->select('id', 'name_ar')
                ->orderBy('name_ar', 'asc')
                ->get();

            return response()->json($subCategories);
        } catch (\Exception $e) {
            \Log::error('Error fetching subcategories: ' . $e->getMessage());
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function edit(Recipe $recipe)
    {
        $kitchens = Kitchens::select('id', 'name_ar')->get();
        $mainCategories = MainCategories::select('id', 'name_ar')->get();
        $subCategories = SubCategory::select('id', 'name_ar')->get();
        $chefs = collect();
        if (Auth::user()->role === 'مدير') {
            $chefs = User::where('role', 'طاه')->select('id', 'name')->get();
        }
        $selectedSubCategories = $recipe->subCategories->pluck('id')->toArray();
        return view('admin.recipes.edit', compact('recipe', 'kitchens', 'mainCategories', 'subCategories', 'chefs', 'selectedSubCategories'));
    }

    public function create(Request $request)
    {
        $kitchens = Kitchens::select('id', 'name_ar')->get();
        $mainCategories = MainCategories::where('status', true)
            ->select('id', 'name_ar')->get();

        $chefs = collect();
        if (Auth::user()->role === 'مدير') {
            $chefs = User::where('role', 'طاه')->select('id', 'name')->get();
        }

        return view('admin.recipes.create', compact('kitchens', 'mainCategories', 'chefs'));
    }

    protected function getValidationRules(Request $request, $isUpdate = false, $isPublic = false)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'kitchen_type_id' => 'required|exists:kitchens,id',
            'main_category_id' => 'required|exists:main_categories,id',
            'sub_categories' => 'required|array',
            'sub_categories.*' => 'exists:sub_categories,id',
            'ingredients' => 'nullable|string',
            'is_free' => 'required|in:0,1',
            'servings' => 'required|integer|min:1',
            'preparation_time' => 'required|integer|min:1',
            'status' => 'required|boolean',
            'price' => 'nullable|numeric|min:0',
        ];

        if (!$isPublic) {
            $rules = array_merge($rules, [
                'steps_data' => 'nullable|string', // جعل steps_data اختياريًا
                'calories' => 'nullable|numeric|min:0',
                'fats' => 'nullable|numeric|min:0',
                'carbs' => 'nullable|numeric|min:0',
                'protein' => 'nullable|numeric|min:0',
                'chef_id' => Auth::user()->role === 'طاه' ? 'nullable|exists:users,id' : 'nullable|exists:users,id',
            ]);

            if ($request->hasFile('step_media')) {
                $rules['step_media.*.*'] = 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,mp4,mov,avi,ogg,qt|max:512000';
            }
        }

        return $rules;
    }

    public function storePublicRecipe(Request $request)
    {
        Log::info('Public Recipe Store Request Data:', $request->all());

        $rules = $this->getValidationRules($request, false, true);
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();
        $user = Auth::user();
        $validatedData['user_id'] = $user->id;
        $validatedData['chef_id'] = $user->id; // Direct assignment of chef_id

        $validatedData['dish_image'] = $this->handleDishImage($request);

        $recipe = Recipe::create($validatedData);

        if ($request->has('steps_data')) {
            $processedSteps = $this->processRecipeSteps($request, $recipe);
            if (isset($processedSteps['errors'])) {
                if ($recipe->dish_image) {
                    Storage::disk('public')->delete($recipe->dish_image);
                }
                $recipe->delete();
                return redirect()->back()->withErrors($processedSteps['errors'])->withInput();
            }
            $recipe->update(['steps' => $processedSteps]);
        }

        if ($request->has('sub_categories')) {
            $recipe->subCategories()->sync($request->sub_categories);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم إضافة الوصفة بنجاح',
                'redirect_url' => url('c1he3f/index')
            ]);
        }
        return redirect('c1he3f/recpies/all_recipes')->with('success', 'تم إضافة الوصفة بنجاح');
    }

    public function store(Request $request)
    {
        Log::info('Recipe Store Request Data:', $request->all());
        $rules = $this->getValidationRules($request);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $validatedData = $validator->validated();
        $user = Auth::user();
        $validatedData['user_id'] = $user->id;
        if ($user->role === 'طاه') {
            $validatedData['chef_id'] = $user->id;
        } else {
            $validatedData['chef_id'] = $request->input('chef_id');
        }
        if ($validatedData['is_free'] == 0) {
            $validatedData['price'] = $request->input('price');
        }
        $validatedData['dish_image'] = $this->handleDishImage($request);
        $recipe = Recipe::create($validatedData);
        $processedSteps = $this->processRecipeSteps($request, $recipe);
        if (isset($processedSteps['errors'])) {
            if ($recipe->dish_image) {
                Storage::disk('public')->delete($recipe->dish_image);
            }
            $recipe->delete();
            return redirect()->back()->withErrors($processedSteps['errors'])->withInput();
        }
        $recipe->update(['steps' => $processedSteps]);

        if ($request->has('sub_categories')) {
            $recipe->subCategories()->sync($request->sub_categories);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم إضافة الوصفة بنجاح',
                'redirect_url' => route('admin.recipes.index')
            ]);
        }
        return redirect()->route('admin.recipes.index')->with('success', 'تم إضافة الوصفة بنجاح');
    }

    protected function handleDishImage(Request $request, Recipe $recipe = null): mixed
    {
        $dishImagePath = $recipe ? $recipe->dish_image : null;
        if ($request->input('remove_current_image') == '1') {
            if ($dishImagePath) {
                Storage::disk('public')->delete($dishImagePath);
            }
            return null;
        } elseif ($request->hasFile('dish_image')) {
            if ($dishImagePath) {
                Storage::disk('public')->delete($dishImagePath);
            }
            return $request->file('dish_image')->store('recipes', 'public');
        }
        return $dishImagePath;
    }

    public function show(Recipe $recipe)
    {
        $allLanguages = Language::all();
        $recipe->load([
            'chef.chefProfile',
            'kitchen' => function ($query) {
                $query->select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi', 'image');
            },
            'mainCategories' => function ($query) {
                $query->select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi', 'image');
            },
            'subCategories' => function ($query) {
                $query->select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi'); // أضف جميع أعمدة الاسم للترجمة
            },
        ]);

        $currentLanguageCode = app()->getLocale();
        $currentLanguage = $allLanguages->where('code', $currentLanguageCode)->first();

        if (!$currentLanguage) {
            $currentLanguage = $allLanguages->where('code', 'ar')->first();
            app()->setLocale('ar');
        }

        $selectedKitchen = null;
        if ($recipe->kitchen_type_id) {
            $selectedKitchen = Kitchens::select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi', 'image')
                ->where('id', $recipe->kitchen_type_id)
                ->first();
        }
        $mainCategories = null;
        if ($recipe->main_category_id) {
            $selectedMainCategory = MainCategories::select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi', 'image')
                ->where('id', $recipe->main_category_id)
                ->first();
        }
        $translationStatus = [];
        foreach ($allLanguages as $language) {
            $translationStatus[$language->code] = $this->checkTranslationStatus($recipe, $language->code, $selectedKitchen);
        }

        // No need to pass 'mainCategories' in compact, as it's loaded onto the $recipe object.
        return view('admin.recipes.show', compact('recipe', 'selectedKitchen', 'currentLanguage', 'allLanguages', 'translationStatus', 'currentLanguageCode'));
    }

    public function showFrontend(Recipe $recipe)
    {
        $recipe->load(['kitchen', 'chef', 'subCategories', 'mainCategories']);
        return view('c1he3f.recipe.show', compact('recipe'));
    }

    public function showChefRecipes(Recipe $recipe)
    {
        $allLanguages = Language::all();
        $recipe->load([
            'chef.chefProfile',
            'kitchen' => function ($query) {
                $query->select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi', 'image');
            },
            'mainCategories' => function ($query) {
                $query->select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi', 'image');
            },
            'subCategories' => function ($query) {
                $query->select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi'); // أضف جميع أعمدة الاسم للترجمة
            },
        ]);

        $currentLanguageCode = app()->getLocale();
        $currentLanguage = $allLanguages->where('code', $currentLanguageCode)->first();

        if (!$currentLanguage) {
            $currentLanguage = $allLanguages->where('code', 'ar')->first();
            app()->setLocale('ar');
        }

        $selectedKitchen = null;
        if ($recipe->kitchen_type_id) {
            $selectedKitchen = Kitchens::select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi', 'image')
                ->where('id', $recipe->kitchen_type_id)
                ->first();
        }
        $mainCategories = null;
        if ($recipe->main_category_id) {
            $selectedMainCategory = MainCategories::select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi', 'image')
                ->where('id', $recipe->main_category_id)
                ->first();
        }
        $translationStatus = [];
        foreach ($allLanguages as $language) {
            $translationStatus[$language->code] = $this->checkTranslationStatus($recipe, $language->code, $selectedKitchen);
        }

        // No need to pass 'mainCategories' in compact, as it's loaded onto the $recipe object.
        return view('c1he3f.recpies.showChefRecipes', compact('recipe', 'selectedKitchen', 'currentLanguage', 'allLanguages', 'translationStatus', 'currentLanguageCode'));
    }

    private function checkTranslationStatus(Recipe $recipe, string $languageCode, $selectedKitchen = null): array
    {
        if ($languageCode === 'ar') {
            return [
                'is_translated' => true,
                'status' => 'original',
                'completeness' => 100
            ];
        }
        $translation = $recipe->translations()->where('language_code', $languageCode)->first();
        $translationFields = [
            'title',
            'description',
            'ingredients',
            'instructions'
        ];
        $translatedFields = 0;
        $totalFields = count($translationFields);
        foreach ($translationFields as $field) {
            if (!empty($translation->{$field})) {
                $translatedFields++;
            }
        }
        if ($selectedKitchen) {
            $kitchenNameField = 'name_' . $languageCode;
            if (!empty($selectedKitchen->{$kitchenNameField})) {
                $translatedFields++;
            } else {
                Log::warning("Missing kitchen translation for language: {$languageCode}, kitchen ID: {$selectedKitchen->id}");
            }
            $totalFields++;
        }
        if ($recipe->mainCategories) {
            $mainCategoryNameField = 'name_' . $languageCode;
            if (!empty($recipe->mainCategories->{$mainCategoryNameField})) {
                $translatedFields++;
            } else {
                Log::warning("Missing main category translation for language: {$languageCode}, Main Category ID: {$recipe->mainCategories->id}");
            }
            $totalFields++;
        }
        $stepsTranslated = true;
        if ($recipe->recipeSteps && $recipe->recipeSteps->count() > 0) {
            foreach ($recipe->recipeSteps as $step) {
                $stepTranslation = $step->translations()->where('language_code', $languageCode)->first();
                if (!$stepTranslation || empty($stepTranslation->step_text)) {
                    $stepsTranslated = false;
                    break;
                }
            }

            if ($stepsTranslated) {
                $translatedFields++;
            }
            $totalFields++;
        }

        $completeness = $totalFields > 0 ? ($translatedFields / $totalFields) * 100 : 0;

        return [
            'is_translated' => $completeness === 100,
            'status' => $completeness === 100 ? 'complete' : ($completeness > 0 ? 'partial' : 'missing'),
            'completeness' => round($completeness)
        ];
    }

    public function translate(Recipe $recipe, string $langCode)
    {
        $language = Language::where('code', $langCode)->firstOrFail();

        // تحميل الوصفة مع خطواتها والترجمات
        $recipe->load(['recipeSteps', 'translations']);

        // البحث عن الترجمة الحالية إن وجدت
        $currentTranslation = $recipe->translations()->where('language_code', $langCode)->first();

        return view('admin.recipes.translate', compact('recipe', 'language', 'currentTranslation'));
    }

    public function storeTranslation(Request $request, Recipe $recipe, string $langCode)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'required|string',
            'instructions' => 'nullable|string',
            'steps' => 'nullable|array',
            'steps.*.step_text' => 'required|string'
        ]);

        // حفظ أو تحديث ترجمة الوصفة الرئيسية
        $translation = $recipe->translations()->updateOrCreate(
            ['language_code' => $langCode],
            [
                'title' => $request->title,
                'description' => $request->description,
                'ingredients' => $request->ingredients,
                'instructions' => $request->instructions,
                'translatable_type' => 'App\Models\Recipe',
                'translatable_id' => $recipe->id
            ]
        );

        // حفظ ترجمة الخطوات
        if ($request->has('steps')) {
            foreach ($request->steps as $stepId => $stepData) {
                $step = $recipe->recipeSteps()->find($stepId);
                if ($step) {
                    $step->translations()->updateOrCreate(
                        ['language_code' => $langCode],
                        [
                            'step_text' => $stepData['step_text'],
                            'translatable_type' => 'App\Models\RecipeStep',
                            'translatable_id' => $step->id
                        ]
                    );
                }
            }
        }

        return redirect()
            ->route('admin.recipes.show', $recipe->id)
            ->with('success', 'تم حفظ الترجمة بنجاح');
    }

    public function preview(Recipe $recipe, string $langCode)
    {
        $language = Language::where('code', $langCode)->firstOrFail();
        $recipe->load([
            'recipeSteps.translations',
            'chef.chefProfile',
            'kitchen.translations',
            'mainCategories.translations',
            'subCategories.translations',
            'translations',
        ]);

        app()->setLocale($langCode);
        $allLanguages = Language::all();
        $recipe->load([
            'chef.chefProfile',
            'kitchen' => function ($query) {
                $query->select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi', 'image');
            },
            'mainCategories' => function ($query) {
                $query->select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi', 'image');
            },
            'subCategories' => function ($query) {
                $query->select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi');
            },
        ]);

        $currentLanguageCode = app()->getLocale();
        $currentLanguage = $allLanguages->where('code', $currentLanguageCode)->first() ?? $allLanguages->where('code', 'ar')->first();
        app()->setLocale($currentLanguage->code);

        // Translation logic for title, ingredients, and steps
        $translatedTitle = $recipe->title; // Default to Arabic
        $translatedIngredients = $recipe->ingredients; // Default to Arabic
        $translatedSteps = $recipe->steps; // Default to Arabic
        if ($currentLanguageCode !== 'ar') {
            try {
                $translate = new GoogleTranslate();
                $translate->setTarget($currentLanguageCode);
                $translatedTitle = $translate->translate($recipe->title);

                // Translate ingredients
                if (strpos($recipe->ingredients, '##') !== false) {
                    $sections = explode('##', $recipe->ingredients);
                    $translatedSections = [];
                    foreach ($sections as $section) {
                        $section = trim($section);
                        if ($section !== '') {
                            $lines = explode("\n", $section);
                            $translatedLines = array_map(function ($line) use ($translate) {
                                return trim($line) !== '' ? $translate->translate(trim($line)) : '';
                            }, $lines);
                            $translatedSections[] = implode("\n", array_filter($translatedLines));
                        }
                    }
                    $translatedIngredients = implode('##', array_filter($translatedSections));
                } else {
                    $lines = explode("\n", $recipe->ingredients);
                    $translatedLines = array_map(function ($line) use ($translate) {
                        return trim($line) !== '' ? $translate->translate(trim($line)) : '';
                    }, $lines);
                    $translatedIngredients = implode("\n", array_filter($translatedLines));
                }

                // Translate steps
                if (is_array($recipe->steps) && count($recipe->steps) > 0) {
                    $translatedSteps = [];
                    foreach ($recipe->steps as $step) {
                        $translatedStep = $step;
                        if (isset($step['description']) && !empty($step['description'])) {
                            $translatedStep['description'] = $translate->translate($step['description']);
                        }
                        $translatedSteps[] = $translatedStep;
                    }
                }
            } catch (\Exception $e) {
                \Log::error('Translation failed: ' . $e->getMessage());
                $translatedTitle = $recipe->title; // Fallback
                $translatedIngredients = $recipe->ingredients; // Fallback
                $translatedSteps = $recipe->steps; // Fallback
            }
        }

        $selectedKitchen = $recipe->kitchen_type_id ? Kitchens::select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi', 'image')->where('id', $recipe->kitchen_type_id)->first() : null;
        $selectedMainCategory = $recipe->main_category_id ? MainCategories::select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi', 'image')->where('id', $recipe->main_category_id)->first() : null;

        $translationStatus = [];
        foreach ($allLanguages as $language) {
            $translationStatus[$language->code] = $this->checkTranslationStatus($recipe, $language->code, $selectedKitchen);
        }

        return view('admin.recipes.preview', compact('recipe', 'language', 'selectedKitchen', 'currentLanguage', 'allLanguages', 'translationStatus', 'currentLanguageCode', 'selectedMainCategory', 'translatedTitle', 'translatedIngredients', 'translatedSteps'));
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->steps && is_array($recipe->steps)) {
            foreach ($recipe->steps as $step) {
                if (isset($step['media']) && is_array($step['media'])) {
                    foreach ($step['media'] as $media) {
                        if (isset($media['url']) && Storage::disk('public')->exists($media['url'])) {
                            Storage::disk('public')->delete($media['url']);
                        }
                    }
                }
            }
        }
        if ($recipe->dish_image) {
            Storage::disk('public')->delete($recipe->dish_image);
        }
        $recipe->delete();
        return redirect()->route('admin.recipes.index')->with('success', 'تم حذف الوصفة بنجاح!');
    }

    public function ajaxUpdate(Request $request, Recipe $recipe)
    {
        try {
            $rules = $this->getValidationRules($request, true);
            $validatedData = $request->validate($rules);
            $validatedData['dish_image'] = $this->handleDishImage($request, $recipe);
            $user = Auth::user();
            if ($user->role === 'طاه') {
                $validatedData['chef_id'] = $user->id;
            }
            $processedSteps = $this->processRecipeSteps($request, $recipe);
            if (isset($processedSteps['errors'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'خطأ في بيانات الخطوات.',
                    'errors' => $processedSteps['errors']
                ], 422);
            }
            $validatedData['steps'] = $processedSteps;
            unset($validatedData['steps_data']);
            $recipe->update($validatedData);
            $recipe->subCategories()->sync($request->input('sub_categories', []));
            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الوصفة بنجاح!',
                'redirect_url' => route('admin.recipes.index')
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطأ في التحقق من البيانات.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('AJAX Recipe Update Error: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ غير متوقع أثناء التحديث.',
                'errors' => ['general' => [$e->getMessage()]]
            ], 500);
        }
    }

    protected function processRecipeSteps(Request $request, Recipe $recipe)
    {
        $stepsData = json_decode($request->steps_data, true);
        if (empty($stepsData) || !is_array($stepsData)) {
            return ['errors' => ['steps_data' => 'يجب إضافة خطوة واحدة على الأقل.']];
        }
        $processedSteps = [];
        foreach ($stepsData as $stepIndex => $stepContent) {
            $currentStepMedia = [];
            if (isset($stepContent['media']) && is_array($stepContent['media'])) {
                foreach ($stepContent['media'] as $mediaItem) {
                    if (isset($mediaItem['url']) && isset($mediaItem['type'])) {
                        $currentStepMedia[] = [
                            'url' => $mediaItem['url'],
                            'type' => $mediaItem['type'],
                            'original_name' => $mediaItem['original_name'] ?? null,
                        ];
                    }
                }
            }
            if ($request->hasFile("step_media.{$stepIndex}")) {
                foreach ($request->file("step_media.{$stepIndex}") as $mediaFile) {
                    if ($mediaFile && $mediaFile->isValid()) {
                        $mediaPath = $mediaFile->store("recipe_steps_media/{$recipe->id}", 'public');
                        $currentStepMedia[] = [
                            'url' => $mediaPath,
                            'type' => Str::startsWith($mediaFile->getMimeType(), 'image') ? 'image' : 'video',
                            'original_name' => $mediaFile->getClientOriginalName(),
                        ];
                    }
                }
            }
            $processedSteps[] = [
                'description' => $stepContent['description'] ?? '',
                'media' => $currentStepMedia,
            ];
        }
        return $processedSteps;
    }
}
