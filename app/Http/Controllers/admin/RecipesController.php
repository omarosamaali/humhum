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
use Illuminate\Support\Str;


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
        \Log::info('Recipe Store Request Data:', $request->all());
        $rules = $this->getValidationRules($request);
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();

        $validatedData['dish_image'] = $this->handleDishImage($request);

        $user = Auth::user();
        if ($user->role === 'طاه') {
            $validatedData['chef_id'] = $user->id;
        } elseif (empty($validatedData['chef_id'])) {
            $validatedData['chef_id'] = null;
        }

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
        $recipe->load(['chef', 'kitchens', 'mainCategories', 'subCategories', 'recipeSteps']);
        $user = $recipe->chef;
        if ($user && !$user->chefProfile) {
            $user->chefProfile()->create();
        }
        $kitchens = Kitchens::select('id', 'name_ar')->get();
        return view('admin.recipes.show', compact('recipe', 'user', 'kitchens'));
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
