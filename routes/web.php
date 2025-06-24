<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController; // للملف الشخصي العام إذا كان موجودًا
use App\Models\Kitchens;
use App\Models\MainCategories;
use App\Models\SubCategory;
use App\Models\Recipe;
use App\Http\Controllers\Admin\RecipesController; // قد تحتاجها لمسارات الوصفات العامة
use App\Models\AboutUs;
use App\Models\Faq;
use App\Http\Controllers\MessageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/c1he3f/new-message', [MessageController::class, 'create'])->name('c1he3f.new-message');
Route::post('/c1he3f/messages', [MessageController::class, 'store'])->name('c1he3f.messages.store');
Route::get('/c1he3f/messages', [MessageController::class, 'index'])->name('c1he3f.messages');
Route::get('/c1he3f/messages/{id}', [MessageController::class, 'show'])->name('c1he3f.messages.show');
Route::post('/c1he3f/messages/{id}/reply', [MessageController::class, 'reply'])->name('c1he3f.messages.reply');

Route::get('/c1he3f/about', function () {
    $about = AboutUs::latest()->first();
    return view('/c1he3f/about', compact('about'));
})->name('c1he3f.about');

Route::get('/c1he3f/faq', function () {
    $faqs = Faq::whereIn('place', ['chef', 'both'])->get();
    return view('/c1he3f/faq', compact('faqs'));
})->name('c1he3f.faq');

// -----------------------------------------------------------------------------
// Global Authentication Routes (Login, Register, Logout) - مسارات المصادقة العامة
// يتم تحميلها من ملف routes/auth.php
// -----------------------------------------------------------------------------
require __DIR__ . '/auth.php'; // هذا الملف سيحتوي على مسارات تسجيل الدخول/التسجيل العامة

// -----------------------------------------------------------------------------
// General User Profile Routes - مسارات الملف الشخصي للمستخدمين العاديين (إذا كانوا موجودين)
// -----------------------------------------------------------------------------
// إذا كان لديك أنواع مستخدمين آخرين بخلاف الطهاة والإدارة
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// -----------------------------------------------------------------------------
// Chef Specific Routes - مسارات خاصة بالطهاة (تتضمن مصادقتهم الخاصة)
// -----------------------------------------------------------------------------
require __DIR__ . '/chef_routes.php';

// -----------------------------------------------------------------------------
// Admin Specific Routes - مسارات خاصة بالإدارة
// -----------------------------------------------------------------------------
require __DIR__ . '/admin_routes.php';

// -----------------------------------------------------------------------------
// Other General Routes (if any)
// -----------------------------------------------------------------------------


Route::get('c1he3f/category/{category}', function ($categoryId) {
    // Ensure user is authenticated
    if (!Auth::check()) {
        return redirect()->route('c1he3f.auth.sign-in')->with('error', 'يجب تسجيل الدخول كطاهٍ أولاً.');
    }

    // Get the authenticated chef's ID
    $chefId = Auth::id();

    // Fetch the specific category by ID
    $selectedCategory = MainCategories::findOrFail($categoryId);

    // Fetch all main categories with their recipes, filtered by chef_id
    $mainCategories = MainCategories::with([
        'recipes' => function ($query) use ($chefId) {
            $query->where('status', 1)
                ->where('chef_id', $chefId) // Filter by authenticated chef
                ->with(['kitchen', 'chef', 'subCategories'])
                ->latest();
        }
    ])->withCount(['recipes' => function ($query) use ($chefId) {
        $query->where('status', 1)
            ->where('chef_id', $chefId);
    }])->get();

    // Debug: Log loaded data
    \Log::info('Category Page Data for Chef ID: ' . $chefId, [
        'selected_category' => $selectedCategory->name_ar,
        'category_id' => $categoryId,
        'categories' => $mainCategories->pluck('name_ar', 'id'),
        'recipe_counts' => $mainCategories->pluck('recipes_count', 'id'),
        'recipes_per_category' => $mainCategories->map(function ($cat) {
            return [
                'category' => $cat->name_ar,
                'recipes' => $cat->recipes->pluck('title', 'id')
            ];
        }),
    ]);

    return view('c1he3f.category.show', compact('mainCategories', 'selectedCategory'));
})->name('c1he3f.category.show');

// Recipe show route
Route::get('c1he3f/recipe/{id}', [RecipesController::class, 'showFrontend'])->name('c1he3f.recipe.show');

// مثال: صفحة وصفات الشيف العامة (تحتاج Auth::check() لتعرف إذا كان المستخدم مسجل دخول أم لا)
Route::get('c1he3f/index', function () {
    if (!Auth::check()) {
        return redirect()->route('c1he3f.auth.sign-in')->with('error', 'يجب تسجيل الدخول أولاً.');
    }
    $mainCategories = MainCategories::withCount('recipes')->get();
    $recipes = Recipe::with(['kitchen', 'chef', 'mainCategories', 'subCategories'])
        ->where('status', 1)
        ->latest()
        ->get();
    return view('c1he3f.index', compact('recipes', 'mainCategories'));
})->name('c1he3f.index');


Route::get('/c1he3f/recpies/all_recipes', [App\Http\Controllers\Admin\RecipesController::class, 'allRecipes'])->name('chef.recipes.all');
Route::get('/chef/recipes/{id}', [App\Http\Controllers\Admin\RecipesController::class, 'viewRecipe'])->name('chef.recipes.view'); // مثال لـ route عرض وصفة واحدة
Route::get('/chef/recipes/{id}/edit', [App\Http\Controllers\Admin\RecipesController::class, 'editRecipe'])->name('chef.recipes.edit'); // مثال لـ route تعديل وصفة
Route::get('/c1he3f/recpies/add-recpie', [App\Http\Controllers\Admin\RecipesController::class, 'addRecipe'])->name('c1he3f.recpies.add-recpie'); // تأكد من الـ route بتاع إضافة الوصفة

// Route::get('/c1he3f/recpies/all_recipes', function () {
//     return view('c1he3f.recpies.all_recipes');
// })->name('chef.recipes.all');

// مسارات الوصفات الشيف (تحتاج إلى التأكد من أن ChefRecipesController موجود)
Route::group(['prefix' => 'c1he3f', 'as' => 'c1he3f.', 'middleware' => ['auth']], function () {
    // Route to display the steps editing form (GET request)
    Route::get('recipes/{recipe}/steps/edit', [RecipesController::class, 'showStepsForm'])->name('recpies.steps');
    // Route to update/save the steps (PUT request)
    Route::put('recipes/{recipe}/steps', [RecipesController::class, 'updateSteps'])->name('recpies.updateSteps');
    Route::get('recipes/{recipe}/ingredients', [RecipesController::class, 'showIngredientsForm'])->name('recpies.ingredients');
    Route::put('recipes/{recipe}/ingredients', [RecipesController::class, 'updateIngredients'])->name('recpies.updateIngredients');
    Route::get('recipes/{recipe}/ingredients/edit', [RecipesController::class, 'showIngredientsForm'])->name('recipes.editIngredients');
    Route::get('recpies/add-recpie', function () {
        $kitchens = Kitchens::select('id', 'name_ar')->get();
        $mainCategories = MainCategories::select('id', 'name_ar')->get();
        $subCategory = SubCategory::select('id', 'name_ar')->get();
        return view('c1he3f/recpies/add-recpie', compact('kitchens', 'mainCategories', 'subCategory'));
    })->name('recpies.add-recpie');
    Route::get('recpies/subcategories', [RecipesController::class, 'getSubCategories'])->name('recpies.subcategories');
    Route::get('recpies/{recipe}/facts', [RecipesController::class, 'showNutritionalFactsForm'])->name('recpies.facts');
    Route::put('recpies/{recipe}/update_nutritional_facts', [RecipesController::class, 'updateNutritionalFacts'])->name('recpies.update_nutritional_facts');
    Route::post('recpies/store', [RecipesController::class, 'storePublicRecipe'])->name('recpies.store');
    Route::get('/recpies/favorites', function () {
        return view('c1he3f.recpies.favorites');
    })->name('recpies.favorites');
    Route::get('recpies/{recipe}', [RecipesController::class, 'showChefRecipes'])->name('recpies.showChefRecipes');
});
