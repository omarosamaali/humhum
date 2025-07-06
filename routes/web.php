<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Models\AboutUs;
use App\Models\Terms;
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

Route::prefix('c1he3f')->middleware(['auth'])->group(function () {
    Route::get('/profile/market-choice', [ProfileController::class, 'showMarketChoice'])->name('c1he3f.profile.market-choice');
    Route::post('/profile/save-market-choice', [ProfileController::class, 'saveMarketChoice'])->name('c1he3f.profile.save-market-choice');
    Route::get('/profile/delivery-locations', [ProfileController::class, 'showDeliveryLocations'])->name('c1he3f.profile.delivery-location');
    Route::get('/profile/add-delivery-address', [ProfileController::class, 'showAddDeliveryAddress'])->name('c1he3f.profile.add-delivery-address');
    Route::post('/profile/store-delivery-address', [ProfileController::class, 'storeDeliveryAddress'])->name('c1he3f.profile.store-delivery-address');
    Route::get('/profile/delivery-location/{id}/edit', [ProfileController::class, 'editDeliveryLocation'])->name('c1he3f.profile.delivery-location.edit');
    Route::put('/profile/delivery-location/{id}', [ProfileController::class, 'updateDeliveryLocation'])->name('c1he3f.profile.delivery-location.update');
    Route::delete('/profile/delivery-location/{id}', [ProfileController::class, 'destroyDeliveryLocation'])->name('c1he3f.profile.delivery-location.destroy');
    Route::get('/coming-soon', [ProfileController::class, 'comingSoon'])->name('c1he3f.coming-soon');
    Route::get('/', function () {
        return view('chef.index');
    })->name('c1he3f.index');
});
Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    $user = Auth::user();
    switch ($user->role) {
        case 'مدير':
            return redirect()->route('admin.dashboard');
        case 'طاه':
            return redirect()->route('c1he3f.index');
        default:
            Auth::logout();
            return redirect()->route('login')->with('error', 'حدث خطأ في تحديد نوع الحساب');
    }
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/get-subcategories', [App\Http\Controllers\Admin\RecipesController::class, 'getSubCategories']);});
Route::post('/c1he3f/snaps/store-snap', [SnapController::class, 'store'])->name('c1he3f.snaps.store-snap');
Route::get('/c1he3f/snaps/get-subcategory-details/{subCategoryId}', [SnapController::class, 'getSubcategoryDetails'])->name('get.subcategory-details');
Route::get(
    '/c1he3f/snaps/get-subcategories/{mainCategoryId}',
    [SnapController::class, 'getSubcategories']
)->name('get.subcategories');
Route::get('/c1he3f/snaps/edit-snap/{snap}', [SnapController::class, 'edit'])->name('c1he3f.snaps.edit-snap');
Route::get('/c1he3f/snaps/lens-show/{snap}', function(Snap $snap){
    return view('c1he3f.snaps.lens-show', compact('snap'));
})->name('c1he3f.snaps.lens-show');
Route::put('/c1he3f/snaps/update-snap/{snap}', [SnapController::class, 'update'])->name('c1he3f.snaps.update-snap');
Route::delete('/c1he3f/snaps/delete/{snap}', [SnapController::class, 'destroy'])->name('c1he3f.snaps.delete');
Route::get('/c1he3f/snaps/all-snap', function () {
    $publishedSnaps = Snap::where('status', 'published')->get();
    $draftSnaps = Snap::where('status', 'draft')->get();
    return view('c1he3f.snaps.all-snap', compact('publishedSnaps', 'draftSnaps'));
})->name('c1he3f.snaps.all-snap');

Route::get('/c1he3f/snaps/add-snap', [SnapController::class, 'create'])->name('c1he3f.snaps.add-snap');

Route::get('/c1he3f/coming-soon', function () {
    return view('c1he3f.coming-soon');
})->name('c1he3f.coming-soon');


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

    $banner = Banner::where('display_location', 'mobile_app')
        ->where('status', 1)
        ->where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->latest()
        ->first();
    $userId = Auth::id();

    $mainCategories = MainCategories::with([
        'recipes' => function ($query) use ($userId) {
            $query->where('user_id', $userId); // افترض ان ال recipes ليها عمود user_id
        }
    ])
        ->withCount(['recipes' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])
        ->get();
    $recipes = Recipe::with(['kitchen', 'chef', 'mainCategories', 'subCategories'])
        ->where('status', 1)
        ->latest()
        ->get();

    return view('c1he3f.index', compact('recipes', 'mainCategories', 'banner'));
})->name('c1he3f.index');

Route::post('/chefThree/snaps/store-snap', [SnapController::class, 'store'])->name('chefThree.snaps.store-snap');
Route::get('/chefThree/snaps/edit-snap/{snap}', [SnapController::class, 'edit'])->name('chefThree.snaps.edit-snap');
Route::get('/chefThree/snaps/lens-show/{snap}', function (Snap $snap) {
    return view('chefThree.snaps.lens-show', compact('snap'));
})->name('chefThree.snaps.lens-show');
Route::put('/chefThree/snaps/update-snap/{snap}', [SnapController::class, 'update'])->name('chefThree.snaps.update-snap');
Route::delete('/chefThree/snaps/delete/{snap}', [SnapController::class, 'destroy'])->name('chefThree.snaps.delete');
Route::get('/chefThree/snaps/all-snap', function () {
    $publishedSnaps = Snap::where('status', 'published')->get();
    $draftSnaps = Snap::where('status', 'draft')->get();
    return view('chefThree.snaps.all-snap', compact('publishedSnaps', 'draftSnaps'));
})->name('chefThree.snaps.all-snap');

Route::get('/chefThree/snaps/add-snap', [SnapController::class, 'create'])->name('chefThree.snaps.add-snap');
Route::get('/chefThree/coming-soon', function () {
    return view('chefThree.coming-soon');
})->name('chefThree.coming-soon');

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
