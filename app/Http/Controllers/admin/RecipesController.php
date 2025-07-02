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



class RecipesController extends Controller
{
    public function allRecipes()
    {
        // افترض أن الوصفات كلها بتاعت الشيف الحالي
        // لو الوصفات مش مرتبطة بشيف معين، ممكن تجيبها كلها
        // $recipes = Recipe::all();

        // لو الوصفات مرتبطة بشيف معين (مثلاً، عن طريق user_id أو chef_id)
        $user = Auth::user();
        if ($user && $user->role === 'طاه') {
            // افترض أن فيه علاقة بين المستخدم والوصفات (مثلاً user_id في جدول recipes)
            // أو علاقة بين ChefProfile والوصفات
            $allRecipes = Recipe::where('user_id', $user->id)->get();
        } else {
            // لو المستخدم مش شيف أو مش مسجل دخول، ممكن ترجع صفحة خطأ أو وصفات فارغة
            $allRecipes = collect(); // يرجع مجموعة فارغة
        }


        // تقسيم الوصفات لـ "فعالة" و "غير فعالة"
        $activeRecipes = $allRecipes->where('status', 1); // افترض أن فيه عمود اسمه is_active (boolean)
        $inactiveRecipes = $allRecipes->where('status', 0);

        return view('c1he3f.recpies.all_recipes', [
            'activeRecipes' => $activeRecipes,
            'inactiveRecipes' => $inactiveRecipes,
        ]);
    }

    public function showStepsForm(Recipe $recipe)
    {
        // Decode existing steps data for pre-filling the form
        // Ensure 'steps' column is cast to 'array' in your Recipe model.
        $stepsData = $recipe->steps ? $recipe->steps : []; // If cast to array, it's already an array

        // If you stored media paths, they will be part of $step['media']
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
        // 1. Validate the incoming data
        $validatedData = $request->validate([
            'calories' => 'nullable|integer|min:0',
            'fats' => 'nullable|numeric|min:0',
            'carbs' => 'nullable|numeric|min:0',
            'protein' => 'nullable|numeric|min:0',
        ]);

        // 2. Update the recipe's nutritional facts
        // Assuming these columns (calories, fat, carbohydrates, protein) exist in your `recipes` table
        $recipe->calories = $validatedData['calories'];
        $recipe->fats = $validatedData['fats'];
        $recipe->carbs = $validatedData['carbs'];
        $recipe->protein = $validatedData['protein'];

        $recipe->save();
        return redirect()->route('c1he3f.recpies.showChefRecipes', $recipe->id)->with('success', 'تم تحديث الحقائق الغذائية بنجاح!');
    }

    public function showIngredientsForm(Recipe $recipe)
    {
        // If 'ingredients' is cast to 'array' in the Recipe model, it will already be an array.
        // Use null coalescing operator to ensure it's an empty array if null.
        $ingredientsData = $recipe->ingredients ?? [];
        return view('c1he3f.recpies.ingredients', compact('recipe', 'ingredientsData'));
    }
    // App/Http/Controllers/Admin/RecipesController.php

    public function updateIngredients(Request $request, Recipe $recipe)
    {
        Log::info('Update Ingredients Request received for recipe ID: ' . $recipe->id);

        $request->validate([
            'ingredients_data' => 'nullable|string', // This hidden field holds the JSON
        ]);

        $ingredientsDataString = $request->input('ingredients_data');
        $formattedIngredients = ''; // Initialize as empty string

        if (!empty($ingredientsDataString)) {
            // Attempt to decode the JSON string from the frontend
            $ingredientsArray = json_decode($ingredientsDataString, true);

            // Check if JSON decoding was successful and it's an array
            if (json_last_error() === JSON_ERROR_NONE && is_array($ingredientsArray)) {
                $lines = [];
                foreach ($ingredientsArray as $item) {
                    $description = trim($item['description'] ?? '');
                    // Ensure is_heading is treated as a boolean (it might come as "1" or "0" string)
                    $isHeading = filter_var($item['is_heading'] ?? false, FILTER_VALIDATE_BOOLEAN);

                    if (!empty($description)) {
                        if ($isHeading) {
                            $lines[] = '##' . $description; // Prepend '##' for headings
                        } else {
                            $lines[] = $description; // No '##' for regular ingredients
                        }
                    }
                }
                // Join all the processed lines into a single string with newlines
                $formattedIngredients = implode("\n", $lines);
                Log::info('Formatted ingredients string for saving:', ['string' => $formattedIngredients]);
            } else {
                Log::error('Failed to decode ingredients_data JSON or invalid array structure.', [
                    'json_error' => json_last_error_msg(),
                    'input_data' => $ingredientsDataString
                ]);
                return back()->with('error', 'حدث خطأ في معالجة بيانات المكونات (JSON). الرجاء المحاولة مرة أخرى.');
            }
        } else {
            // If ingredients_data is empty, it means no ingredients or all were removed.
            // So, save an empty string to the database.
            Log::info('ingredients_data was empty. Saving empty string to database.');
        }

        // Assign the correctly formatted string to the recipe's ingredients attribute
        $recipe->ingredients = $formattedIngredients;

        // Save the recipe
        try {
            $recipe->save();
            Log::info('Recipe ingredients updated successfully for ID: ' . $recipe->id);
            return redirect()->back()->with('success', 'تم تحديث المكونات بنجاح!');
        } catch (\Exception $e) {
            Log::error('Database save error for recipe ID: ' . $recipe->id, [
                'error' => $e->getMessage(),
                'sql' => $e->getSql(), // This might not be available directly on all exceptions
                'bindings' => $e->getBindings() // Same as above
            ]);
            return back()->with('error', 'حدث خطأ أثناء حفظ المكونات في قاعدة البيانات: ' . $e->getMessage());
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

    public function getSubCategories(Request $request)
    {
        $mainCategoryId = $request->get('category_id');

        if (!$mainCategoryId) {
            return response()->json([]);
        }

        $subCategories = SubCategory::where('category_id', $mainCategoryId)
            ->select('id', 'name_ar')
            ->get();

        return response()->json($subCategories);
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
        $mainCategories = MainCategories::where('status', true) // إضافة التحقق من الحالة
            ->select('id', 'name_ar')->get();

        $chefs = collect();
        if (Auth::user()->role === 'مدير') {
            $chefs = User::where('role', 'طاه')->select('id', 'name')->get();
        }

        return view('admin.recipes.create', compact('kitchens', 'mainCategories', 'chefs'));
    }

    protected function getValidationRules(Request $request, $isUpdate = false, $isPublic = false)
    {
        // قواعد التحقق الأساسية للنموذج العام (c1he3f)
        $rules = [
            'title' => 'required|string|max:255',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // بدلاً من dish_image
            'kitchen_type_id' => 'required|exists:kitchens,id',
            'main_category_id' => 'required|exists:main_categories,id',
            'sub_categories' => 'required|array',
            'sub_categories.*' => 'exists:sub_categories,id',
            'is_free' => 'required|in:0,1',
            'servings' => 'required|integer|min:1',
            'preparation_time' => 'required|integer|min:1',
            'status' => 'required|boolean',
        ];

        // إذا كان النموذج الإداري (store أو update)
        if (!$isPublic) {
            $rules = array_merge($rules, [
                // 'ingredients' => 'required|string', // لن نتحقق منها هنا بل في updateIngredients
                'steps_data' => 'required|string',
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

        // Always set user_id and chef_id to the authenticated user's ID
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

        $rules = $this->getValidationRules($request); // استخدام القواعد الإدارية
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();
        $user = Auth::user();

        // Always set user_id and chef_id to the authenticated user's ID
        $validatedData['user_id'] = $user->id;
        $validatedData['chef_id'] = $user->id; // Direct assignment of chef_id

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
            // Keep 'mainCategories' as is, since it's the correct relationship name
            'mainCategories' => function ($query) { // هنا تستخدم اسم العلاقة كما هي في الموديل
                $query->select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi', 'image');
            },

            'subCategories' => function ($query) {
                $query->select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi'); // أضف جميع أعمدة الاسم للترجمة
            },
            // باقي العلاقات...
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
            // Keep 'mainCategories' as is, since it's the correct relationship name
            'mainCategories' => function ($query) { // هنا تستخدم اسم العلاقة كما هي في الموديل
                $query->select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi', 'image');
            },

            'subCategories' => function ($query) {
                $query->select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi'); // أضف جميع أعمدة الاسم للترجمة
            },
            // باقي العلاقات...
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
        // إذا كانت اللغة العربية (اللغة الأساسية)
        if ($languageCode === 'ar') {
            return [
                'is_translated' => true,
                'status' => 'original',
                'completeness' => 100
            ];
        }

        // البحث عن الترجمة في جدول الترجمات
        $translation = $recipe->translations()->where('language_code', $languageCode)->first();

        // الحقول التي يجب التحقق من ترجمتها
        $translationFields = [
            'title',
            'description',
            'ingredients',
            'instructions'
        ];

        $translatedFields = 0;
        $totalFields = count($translationFields);

        // التحقق من ترجمة الحقول الأساسية
        foreach ($translationFields as $field) {
            if (!empty($translation->{$field})) {
                $translatedFields++;
            }
        }

        // التحقق من ترجمة اسم المطبخ
        if ($selectedKitchen) {
            $kitchenNameField = 'name_' . $languageCode;
            if (!empty($selectedKitchen->{$kitchenNameField})) {
                $translatedFields++;
            } else {
                Log::warning("Missing kitchen translation for language: {$languageCode}, kitchen ID: {$selectedKitchen->id}");
            }
            $totalFields++;
        }

        // **** أضف هذا الجزء للتحقق من ترجمة التصنيف الرئيسي ****
        if ($recipe->mainCategories) { // تأكد من أن العلاقة تم تحميلها
            $mainCategoryNameField = 'name_' . $languageCode;
            if (!empty($recipe->mainCategories->{$mainCategoryNameField})) {
                $translatedFields++;
            } else {
                Log::warning("Missing main category translation for language: {$languageCode}, Main Category ID: {$recipe->mainCategories->id}");
            }
            $totalFields++;
        }
        // ******************************************************

        // التحقق من ترجمة خطوات الوصفة
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
            // 'ingredients' 
            // Add if ingredients relation exists
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

        $selectedKitchen = $recipe->kitchen_type_id ? Kitchens::select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi', 'image')->where('id', $recipe->kitchen_type_id)->first() : null;
        $selectedMainCategory = $recipe->main_category_id ? MainCategories::select('id', 'name_ar', 'name_am', 'name_bn', 'name_ml', 'name_fil', 'name_ur', 'name_ta', 'name_en', 'name_ne', 'name_ps', 'name_id', 'name_hi', 'image')->where('id', $recipe->main_category_id)->first() : null;

        $translationStatus = [];
        foreach ($allLanguages as $language) {
            $translationStatus[$language->code] = $this->checkTranslationStatus($recipe, $language->code, $selectedKitchen);
        }

        return view('admin.recipes.preview', compact('recipe', 'language', 'selectedKitchen', 'currentLanguage', 'allLanguages', 'translationStatus', 'currentLanguageCode', 'selectedMainCategory'));
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
