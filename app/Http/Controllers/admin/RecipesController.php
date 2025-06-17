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
// import Log
use Illuminate\Support\Facades\Log;



class RecipesController extends Controller
{
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
        $mainCategoryId = $request->get('main_category_id');

        if (!$mainCategoryId) {
            return response()->json([]);
        }

        \Log::info('Fetching subcategories for ID:', ['id' => $mainCategoryId]);

        $subCategories = SubCategory::where('category_id', $mainCategoryId)
            ->select('id', 'name_ar')
            ->get();

        \Log::info('Subcategories found:', ['count' => $subCategories->count(), 'data' => $subCategories->toArray()]);

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



    public function store(Request $request)
    {
        Log::info('Recipe Store Request Data:', $request->all());

        // نحتاج أن نمرر Request للمتخصص بالتحقق، وليس فقط $this
        $rules = $this->getValidationRules($request);
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();

        // تعيين user_id (الشخص الذي أنشأ الوصفة)
        // هذا لضمان أن user_id هو دائمًا معرف المستخدم المسجل دخوله، بغض النظر عما إذا كان موجودًا في الـ request
        $validatedData['user_id'] = Auth::id();

        // تعيين chef_id (الطاهي المسؤول عن الوصفة)
        $user = Auth::user();
        if ($user->role === 'طاه') {
            // إذا كان المستخدم الحالي هو طاهي، فاجعل chef_id هو معرفه
            $validatedData['chef_id'] = $user->id;
        }
        // إذا لم يكن المستخدم "طاهيًا"، فإننا نعتمد على القيمة المرسلة من الفورم (لو المدير اختار طاهي).
        // إذا لم يختار المدير طاهي (أي أن chef_id جاء فارغاً من السليكت)،
        // فإن قاعدة الـ validation (nullable|exists:users,id) ستسمح بمروره كـ null إذا كان العمود يقبل Null.
        // لا حاجة لتعيينه إلى null يدويًا هنا مرة أخرى.
        // الشرط "elseif (empty($validatedData['chef_id'])) { $validatedData['chef_id'] = null; }"
        // يمكن أن يؤدي إلى تعيين null حتى لو كان حقل السليكت غير مطلوب، لذا إزالته أفضل.

        // معالجة صورة الطبق (يجب أن تكون بعد الـ validation للحصول على البيانات الموثوقة)
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

    // وفي دالة checkTranslationStatus، أضف المطبخ كمعامل:
    // ... (الجزء العلوي من الدالة) ...

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

    /**
     * التحقق من حالة الترجمة للغة معينة
     */


    /**
     * عرض نموذج الترجمة
     */
    public function translate(Recipe $recipe, string $langCode)
    {
        $language = Language::where('code', $langCode)->firstOrFail();

        // تحميل الوصفة مع خطواتها والترجمات
        $recipe->load(['recipeSteps', 'translations']);

        // البحث عن الترجمة الحالية إن وجدت
        $currentTranslation = $recipe->translations()->where('language_code', $langCode)->first();

        return view('admin.recipes.translate', compact('recipe', 'language', 'currentTranslation'));
    }

    /**
     * حفظ الترجمة - محدث للعمل مع جدول الترجمات المنفصل
     */
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
    /**
     * معاينة الوصفة بلغة معينة
     */
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

    protected function getValidationRules(Request $request, $isUpdate = false)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'dish_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'kitchen_type_id' => 'required|exists:kitchens,id', // تأكيد أنه قيمة واحدة
            'main_category_id' => 'required|exists:main_categories,id',
            'sub_categories' => 'nullable|array',
            'sub_categories.*' => 'exists:sub_categories,id',
            'ingredients' => 'required|string',
            'steps_data' => 'required|string',
            'servings' => 'required|integer|min:1',
            'preparation_time' => 'required|integer|min:1',
            'calories' => 'nullable|numeric|min:0',
            'fats' => 'nullable|numeric|min:0',
            'carbs' => 'nullable|numeric|min:0',
            'protein' => 'nullable|numeric|min:0',
            'is_free' => 'required|in:0,1,2',
            'status' => 'required|boolean',
            'chef_id' => Auth::user()->role === 'طاه' ? 'nullable|exists:users,id' : 'nullable|exists:users,id',
        ];
        if ($request->hasFile('step_media')) {
            $rules['step_media.*.*'] = 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,mp4,mov,avi,ogg,qt|max:10240';
        }
        return $rules;
    }


    protected function handleDishImage(Request $request, Recipe $recipe = null)
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
