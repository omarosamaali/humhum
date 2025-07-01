<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Models\AboutUs;
use App\Models\Faq;
use App\Models\MainCategories;
use App\Models\SubCategory;
use App\Models\Recipe;
use App\Models\Kitchens;
use App\Http\Controllers\Admin\RecipesController;
use App\Http\Controllers\SnapController; // Import your SnapController
use App\Models\Snap;
use App\Models\Banner;
use App\Http\Controllers\C1he3f\Auth\ChefAuthenticatedSessionController;

// Route for handling the video upload (using the SnapController)
Route::post('/c1he3f/snaps/store-snap', [SnapController::class, 'store'])->name('c1he3f.snaps.store-snap');
Route::get('/c1he3f/snaps/get-subcategory-details/{subCategoryId}', [SnapController::class, 'getSubcategoryDetails'])->name('get.subcategory-details');
// Route for getting subcategories (using the SnapController)
Route::get(
    '/c1he3f/snaps/get-subcategories/{mainCategoryId}',
    [SnapController::class, 'getSubcategories']
)->name('get.subcategories');
Route::get('/c1he3f/snaps/edit-snap/{snap}', [SnapController::class, 'edit'])->name('c1he3f.snaps.edit-snap');
Route::get('/c1he3f/snaps/lens-show/{snap}', function(Snap $snap){
    return view('c1he3f.snaps.lens-show', compact('snap'));
})->name('c1he3f.snaps.lens-show');
// راوت لمعالجة طلب التعديل (عادةً يكون من نوع POST أو PUT/PATCH)
// نستخدم PUT/PATCH للتعديل كأفضل ممارسة RESTful
Route::put('/c1he3f/snaps/update-snap/{snap}', [SnapController::class, 'update'])->name('c1he3f.snaps.update-snap');
Route::delete('/c1he3f/snaps/delete/{snap}', [SnapController::class, 'destroy'])->name('c1he3f.snaps.delete');
Route::get('/c1he3f/snaps/all-snap', function () {
    $publishedSnaps = Snap::where('status', 'published')->get();
    $draftSnaps = Snap::where('status', 'draft')->get();
    return view('c1he3f.snaps.all-snap', compact('publishedSnaps', 'draftSnaps'));
})->name('c1he3f.snaps.all-snap');

Route::get('/c1he3f/snaps/add-snap', [SnapController::class, 'create'])->name('c1he3f.snaps.add-snap');

Route::get('/c1he3f/get-subcategories/{mainCategoryId}', function ($mainCategoryId) {
    $subCategories = SubCategory::where('category_id', $mainCategoryId)->get();
    return response()->json($subCategories);
})->name('get.subcategories');

Route::get('/c1he3f/coming-soon', function () {
    return view('c1he3f.coming-soon');
})->name('c1he3f.coming-soon');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/c1he3f/transactions', function () {
    return view('c1he3f.transactions');
})->name('c1he3f.transactions');

Route::get('/c1he3f/withdrwal', function () {
    return view('c1he3f.withdrwal');
})->name('c1he3f.withdrwal');

Route::get('/c1he3f/about', function () {
    $about = AboutUs::latest()->first();
    return view('/c1he3f/about', compact('about'));
})->name('c1he3f.about');

Route::get('/c1he3f/faq', function () {
    $faqs = Faq::whereIn('place', ['chef', 'both'])->get();
    return view('/c1he3f/faq', compact('faqs'));
})->name('c1he3f.faq');

require __DIR__ . '/auth.php';

require __DIR__ . '/chef_routes.php';

require __DIR__ . '/admin_routes.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('c1he3f/category/{category}', function ($categoryId) {
    if (!Auth::check()) {
        return redirect()->route('c1he3f.auth.sign-in')->with('error', 'يجب تسجيل الدخول كطاهٍ أولاً.');
    }
    $chefId = Auth::id();
    $selectedCategory = MainCategories::findOrFail($categoryId);
    $mainCategories = MainCategories::with(['recipes' => function ($query) use ($chefId) {
        $query->where('status', 1)
            ->where('chef_id', $chefId)
            ->with(['kitchen', 'chef', 'subCategories'])
            ->latest();
    }])->withCount(['recipes' => function ($query) use ($chefId) {
        $query->where('status', 1)
            ->where('chef_id', $chefId);
    }])->get();
    return view('c1he3f.category.show', compact('mainCategories', 'selectedCategory'));
})->name('c1he3f.category.show');

Route::get('c1he3f/recipe/{id}', [RecipesController::class, 'showFrontend'])->name('c1he3f.recipe.show');
Route::post('chef/logout', [ChefAuthenticatedSessionController::class, 'destroy'])->name('chef.logout');

Route::get('c1he3f/index', function () {
    if (!Auth::check()) {
        return redirect()->route('c1he3f.auth.sign-in')->with('error', 'يجب تسجيل الدخول أولاً.');
    }

    $banner = Banner::where('display_location', 'website')
        ->where('status', 1)
        ->where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->latest()
        ->first();

    $mainCategories = MainCategories::withCount('recipes')->get();
    $recipes = Recipe::with(['kitchen', 'chef', 'mainCategories', 'subCategories'])
        ->where('status', 1)
        ->latest()
        ->get();

    return view('c1he3f.index', compact('recipes', 'mainCategories', 'banner'));
})->name('c1he3f.index');

// Route for handling the video upload (using the SnapController)
Route::post('/chefThree/snaps/store-snap', [SnapController::class, 'store'])->name('chefThree.snaps.store-snap');
Route::get('/chefThree/snaps/get-subcategory-details/{subCategoryId}', [SnapController::class, 'getSubcategoryDetails'])->name('get.subcategory-details');
// Route for getting subcategories (using the SnapController)
Route::get(
    '/chefThree/snaps/get-subcategories/{mainCategoryId}',
    [SnapController::class, 'getSubcategories']
)->name('get.subcategories');
Route::get('/chefThree/snaps/edit-snap/{snap}', [SnapController::class, 'edit'])->name('chefThree.snaps.edit-snap');
Route::get('/chefThree/snaps/lens-show/{snap}', function (Snap $snap) {
    return view('chefThree.snaps.lens-show', compact('snap'));
})->name('chefThree.snaps.lens-show');
// راوت لمعالجة طلب التعديل (عادةً يكون من نوع POST أو PUT/PATCH)
// نستخدم PUT/PATCH للتعديل كأفضل ممارسة RESTful
Route::put('/chefThree/snaps/update-snap/{snap}', [SnapController::class, 'update'])->name('chefThree.snaps.update-snap');
Route::delete('/chefThree/snaps/delete/{snap}', [SnapController::class, 'destroy'])->name('chefThree.snaps.delete');
Route::get('/chefThree/snaps/all-snap', function () {
    $publishedSnaps = Snap::where('status', 'published')->get();
    $draftSnaps = Snap::where('status', 'draft')->get();
    return view('chefThree.snaps.all-snap', compact('publishedSnaps', 'draftSnaps'));
})->name('chefThree.snaps.all-snap');

Route::get('/chefThree/snaps/add-snap', [SnapController::class, 'create'])->name('chefThree.snaps.add-snap');

Route::get('/chefThree/get-subcategories/{mainCategoryId}', function ($mainCategoryId) {
    $subCategories = SubCategory::where('category_id', $mainCategoryId)->get();
    return response()->json($subCategories);
})->name('get.subcategories');

Route::get('/chefThree/coming-soon', function () {
    return view('chefThree.coming-soon');
})->name('chefThree.coming-soon');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/chefThree/transactions', function () {
    return view('chefThree.transactions');
})->name('chefThree.transactions');

Route::get('/chefThree/withdrwal', function () {
    return view('chefThree.withdrwal');
})->name('chefThree.withdrwal');

Route::get('/chefThree/about', function () {
    $about = AboutUs::latest()->first();
    return view('/chefThree/about', compact('about'));
})->name('chefThree.about');

Route::get('/chefThree/faq', function () {
    $faqs = Faq::whereIn('place', ['chef', 'both'])->get();
    return view('/chefThree/faq', compact('faqs'));
})->name('chefThree.faq');

require __DIR__ . '/auth.php';

require __DIR__ . '/chef_routes.php';

require __DIR__ . '/admin_routes.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('chefThree/category/{category}', function ($categoryId) {
    if (!Auth::check()) {
        return redirect()->route('chefThree.auth.sign-in')->with('error', 'يجب تسجيل الدخول كطاهٍ أولاً.');
    }
    $chefId = Auth::id();
    $selectedCategory = MainCategories::findOrFail($categoryId);
    $mainCategories = MainCategories::with(['recipes' => function ($query) use ($chefId) {
        $query->where('status', 1)
            ->where('chef_id', $chefId)
            ->with(['kitchen', 'chef', 'subCategories'])
            ->latest();
    }])->withCount(['recipes' => function ($query) use ($chefId) {
        $query->where('status', 1)
            ->where('chef_id', $chefId);
    }])->get();
    return view('chefThree.category.show', compact('mainCategories', 'selectedCategory'));
})->name('chefThree.category.show');

Route::get('chefThree/recipe/{id}', [RecipesController::class, 'showFrontend'])->name('chefThree.recipe.show');
Route::post('chef/logout', [ChefAuthenticatedSessionController::class, 'destroy'])->name('chef.logout');

Route::get('chefThree/index', function () {
    if (!Auth::check()) {
        return redirect()->route('chefThree.auth.sign-in')->with('error', 'يجب تسجيل الدخول أولاً.');
    }

    $banner = Banner::where('display_location', 'website')
        ->where('status', 1)
        ->where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->latest()
        ->first();

    $mainCategories = MainCategories::withCount('recipes')->get();
    $recipes = Recipe::with(['kitchen', 'chef', 'mainCategories', 'subCategories'])
        ->where('status', 1)
        ->latest()
        ->get();

    return view('chefThree.index', compact('recipes', 'mainCategories', 'banner'));
})->name('chefThree.index');
