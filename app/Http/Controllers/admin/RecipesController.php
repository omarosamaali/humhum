<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Models\Kitchens;
use App\Models\MainCategories;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // تأكد من استيراد Str

class RecipesController extends Controller
{
    /**
     * Display a listing of the recipes.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $recipes = Recipe::with(['kitchens', 'chef', 'mainCategories', 'subCategories'])->paginate(10);
        $kitchens = Kitchens::select('id', 'name_ar')->get();
        return view('admin.recipes.index', compact('recipes', 'kitchens'));
    }

    /**
     * Show the form for creating a new recipe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $kitchens = Kitchens::select('id', 'name_ar')->get();
        $mainCategories = MainCategories::select('id', 'name_ar')->get();
        $subCategories = SubCategory::select('id', 'name_ar')->get();

        // عرض قائمة الطهاة فقط إذا كان المستخدم الحالي 'مدير'
        $chefs = collect(); // افتراضياً، قائمة فارغة
        if (Auth::user()->role === 'مدير') { // هنا نستخدم 'مدير' كما حددت لدور المدير
            $chefs = User::where('role', 'طاه')->select('id', 'name')->get();
        }

        return view('admin.recipes.create', compact('kitchens', 'mainCategories', 'subCategories', 'chefs'));
    }

    /**
     * Store a newly created recipe in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    /**
     * Store a newly created recipe in storage.
     */
    public function store(Request $request)
    {
        \Log::info('Recipe Store Request Data:', $request->all());

        $rules = $this->getValidationRules($request);
        $validatedData = $request->validate($rules);

        // Handle dish image
        $validatedData['dish_image'] = $this->handleDishImage($request);

        // Handle chef_id based on user role and form input
        $user = Auth::user();
        if ($user->role === 'طاه') {
            // If the current user is a chef, always assign them as the chef
            $validatedData['chef_id'] = $user->id;
        } elseif (empty($validatedData['chef_id'])) {
            // If no chef is selected, set to null
            $validatedData['chef_id'] = null;
        }
        // Otherwise, use the chef_id from the form (for admins/data entry users)

        // Create the recipe with initial data (steps will be updated after creation)
        $recipe = Recipe::create($validatedData);

        // Process and save steps media and update steps data
        $processedSteps = $this->processRecipeSteps($request, $recipe);

        // Check if processRecipeSteps returned an error response (e.g., empty steps)
        if (isset($processedSteps['errors'])) {
            // If steps validation failed, delete the newly created recipe and its dish image
            if ($recipe->dish_image) {
                Storage::disk('public')->delete($recipe->dish_image);
            }
            $recipe->delete(); // Delete the recipe record
            return back()->withErrors($processedSteps['errors'])->withInput();
        }

        // Assuming 'steps' is a JSON casted column in Recipe model
        $recipe->update(['steps' => $processedSteps]);

        // Sync sub categories
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

    /**
     * Update the specified recipe in storage.
     */

    /**
     * Handle AJAX update request for a recipe.
     */
 
    /**
     * Display the specified recipe.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\View\View
     */
    public function show(Recipe $recipe)
    {
        // تأكد من تحميل علاقة 'chef' بشكل صحيح
        $recipe->load(['chef', 'kitchens', 'mainCategories', 'subCategories', 'recipeSteps']);

        // إذا كنت لا تزال بحاجة إلى كائن المستخدم المنفصل، يمكنك الاحتفاظ بهذا
        // ولكن لا يجب أن يكون مطلوبًا إذا كانت علاقة chef محملة بشكل صحيح
        $user = $recipe->chef; // استخدام علاقة chef مباشرةً

        // إذا كنت لا تزال تستخدم chefProfile (على افتراض أنها علاقة على نموذج المستخدم)
        // وكنت بحاجة إليها هنا، تأكد أن $user موجود وليس null
        if ($user && !$user->chefProfile) {
            $user->chefProfile()->create();
        }

        $kitchens = Kitchens::select('id', 'name_ar')->get();
        return view('admin.recipes.show', compact('recipe', 'user', 'kitchens'));
    }

    /**
     * Show the form for editing the specified recipe.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\View\View
     */
    public function edit(Recipe $recipe)
    {
        $kitchens = Kitchens::select('id', 'name_ar')->get();
        $mainCategories = MainCategories::select('id', 'name_ar')->get();
        $subCategories = SubCategory::select('id', 'name_ar')->get();

        // عرض قائمة الطهاة فقط إذا كان المستخدم الحالي 'مدير'
        $chefs = collect();
        if (Auth::user()->role === 'مدير') {
            $chefs = User::where('role', 'طاه')->select('id', 'name')->get();
        }

        $selectedSubCategories = $recipe->subCategories->pluck('id')->toArray();
        return view('admin.recipes.edit', compact(
            'recipe',
            'kitchens',
            'mainCategories',
            'subCategories',
            'chefs',
            'selectedSubCategories'
        ));
    }

    /**
     * Update the specified recipe in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Recipe $recipe)
    {
        $rules = $this->getValidationRules($request, true); // Pass true for update context
        $validatedData = $request->validate($rules);

        // Handle dish image
        $validatedData['dish_image'] = $this->handleDishImage($request, $recipe);

        // Set chef_id based on user role (if chef, use authenticated user's ID)
        $user = Auth::user();
        if ($user->role === 'طاه') { // إذا كان المستخدم طاهياً
            $validatedData['chef_id'] = $user->id;
        }
        // إذا كان المستخدم مديراً، سيتم أخذ chef_id من الـ request بناءً على الـ validation rule

        // Process and save steps media and update steps data
        $processedSteps = $this->processRecipeSteps($request, $recipe);
        if (isset($processedSteps['errors'])) { // Check if processRecipeSteps returned an error response
            return back()->withErrors($processedSteps['errors'])->withInput();
        }
        // Assuming 'steps' is a JSON casted column in Recipe model
        $validatedData['steps'] = $processedSteps;

        // Remove fields not directly stored in the recipe table (handled by helper methods)
        unset($validatedData['steps_data']);
        // 'step_media' files are handled within processRecipeSteps, no need to unset here.

        $recipe->update($validatedData);

        // Update sub categories
        $recipe->subCategories()->sync($request->input('sub_categories', []));

        return redirect()->route('admin.recipes.index')->with('success', 'تم تحديث الوصفة بنجاح!');
    }

    /**
     * Remove the specified recipe from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Recipe $recipe)
    {
        // Delete associated media for steps
        // This assumes 'steps' is a JSON column and contains 'media' array with 'url'
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

        // Delete dish image
        if ($recipe->dish_image) {
            Storage::disk('public')->delete($recipe->dish_image);
        }

        $recipe->delete();

        return redirect()->route('admin.recipes.index')->with('success', 'تم حذف الوصفة بنجاح!');
    }

    /**
     * Handle AJAX update request for a recipe.
     * This method largely reuses the main update logic.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxUpdate(Request $request, Recipe $recipe)
    {
        try {
            $rules = $this->getValidationRules($request, true);
            $validatedData = $request->validate($rules); // Will throw ValidationException on failure

            // Handle dish image
            $validatedData['dish_image'] = $this->handleDishImage($request, $recipe);

            // Set chef_id based on user role (if chef, use authenticated user's ID)
            $user = Auth::user();
            if ($user->role === 'طاه') { // إذا كان المستخدم طاهياً
                $validatedData['chef_id'] = $user->id;
            }

            // Process and save steps media and update steps data
            $processedSteps = $this->processRecipeSteps($request, $recipe);
            if (isset($processedSteps['errors'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'خطأ في بيانات الخطوات.',
                    'errors' => $processedSteps['errors']
                ], 422);
            }
            // Assuming 'steps' is a JSON casted column in Recipe model
            $validatedData['steps'] = $processedSteps;

            // Remove fields not directly stored in the recipe table
            unset($validatedData['steps_data']);

            $recipe->update($validatedData);

            // Update sub categories
            $recipe->subCategories()->sync($request->input('sub_categories', []));

            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الوصفة بنجاح!',
                'redirect_url' => route('admin.recipes.index') // You might remove this if you don't want a redirect
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطأ في التحقق من البيانات.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('AJAX Recipe Update Error: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ غير متوقع أثناء التحديث.',
                'error_details' => $e->getMessage() // Only for debugging, remove in production
            ], 500);
        }
    }

    protected function getValidationRules(Request $request, $isUpdate = false)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'dish_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'kitchen_type_id' => 'required|exists:kitchens,id',
            'main_category_id' => 'required|exists:main_categories,id',
            'sub_categories' => 'nullable|array',
            'sub_categories.*' => 'exists:sub_categories,id',
            'ingredients' => 'required|string',
            'steps_data' => 'required|string', // This will receive JSON from JS
            'servings' => 'required|integer|min:1',
            'preparation_time' => 'required|integer|min:1',
            'calories' => 'nullable|numeric|min:0',
            'fats' => 'nullable|numeric|min:0',
            'carbs' => 'nullable|numeric|min:0',
            'protein' => 'nullable|numeric|min:0',
            'is_free' => 'required|in:0,1,2', // 0=مدفوعة, 1=مجانية, 2=نظام الباقات
            'status' => 'required|boolean',
            'chef_id' => Auth::user()->role === 'طاه' ? 'nullable|exists:users,id' : 'required|exists:users,id',
            'chef_id' => 'nullable|exists:users,id', // Optional field
        ];

        // Add validation for step_media files if they exist in the request
        // The max size here is 10MB (10240 KB)
        if ($request->hasFile('step_media')) {
            $rules['step_media.*.*'] = 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,mp4,mov,avi,ogg,qt|max:10240';
        }

        return $rules;
    }

    /**
     * Handle dish image upload and deletion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe|null  $recipe
     * @return string|null The path to the stored image or null if removed/none
     */
    protected function handleDishImage(Request $request, Recipe $recipe = null)
    {
        $dishImagePath = $recipe ? $recipe->dish_image : null;

        // Check if the current image should be removed
        if ($request->input('remove_current_image') == '1') {
            if ($dishImagePath) {
                Storage::disk('public')->delete($dishImagePath);
            }
            return null; // No image
        } elseif ($request->hasFile('dish_image')) {
            // If a new image is uploaded, delete the old one if it exists
            if ($dishImagePath) {
                Storage::disk('public')->delete($dishImagePath);
            }
            // Store the new image in the 'recipes' folder
            return $request->file('dish_image')->store('recipes', 'public');
        }

        // If no new image uploaded and not marked for removal, keep the existing one
        return $dishImagePath;
    }

    /**
     * Process recipe steps data and handle media uploads for each step.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return array|\Illuminate\Http\RedirectResponse Returns processed steps data or a redirect response on error.
     * Note: The redirect response is typically handled by the caller.
     */
    protected function processRecipeSteps(Request $request, Recipe $recipe)
    {
        $stepsData = json_decode($request->steps_data, true);

        if (empty($stepsData) || !is_array($stepsData)) {
            // Return an array with errors if steps data is invalid/empty
            return ['errors' => ['steps_data' => 'يجب إضافة خطوة واحدة على الأقل.']];
        }

        $processedSteps = [];

        // IMPORTANT: This logic assumes the frontend sends all existing media URLs
        // for a step along with any new files. It does NOT automatically delete
        // media files that are removed from the frontend. For robust cleanup
        // of old, unreferenced media, you would need a more complex strategy
        // (e.g., comparing current stored media with incoming media URLs
        // and deleting those not in the incoming list, or running a daily cleanup job).

        foreach ($stepsData as $stepIndex => $stepContent) {
            $currentStepMedia = [];

            // Add existing media URLs that are passed from the frontend for this step
            if (isset($stepContent['media']) && is_array($stepContent['media'])) {
                foreach ($stepContent['media'] as $mediaItem) {
                    // Ensure the media item has 'url' and 'type' to be valid
                    if (isset($mediaItem['url']) && isset($mediaItem['type'])) {
                        $currentStepMedia[] = [
                            'url' => $mediaItem['url'],
                            'type' => $mediaItem['type'],
                            'original_name' => $mediaItem['original_name'] ?? null,
                        ];
                    }
                }
            }

            // Process newly uploaded media files for this specific step
            // The request's 'step_media' array is indexed by step number
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
                'description' => $stepContent['description'] ?? '', // Ensure description is set
                'media' => $currentStepMedia,
            ];
        }

        return $processedSteps;
    }
}
