<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\RecipeController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\MainCategoriesController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\KitchensController;
use App\Http\Controllers\Admin\FamiliesController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\RecipesController;  // Keep this
use App\Http\Middleware\CheckUserStatus;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', CheckUserStatus::class])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('languages', LanguageController::class);
        Route::resource('packages', PackageController::class);
        Route::resource('plans', PlanController::class);
        Route::resource('mainCategories', MainCategoriesController::class);
        Route::resource('subCategories', SubCategoryController::class);
        Route::resource('kitchens', KitchensController::class);
        Route::resource('families', FamiliesController::class);
        Route::resource('news', NewsController::class);
        Route::resource('about-us', AboutUsController::class);
        Route::resource('faqs', FaqController::class);
        Route::resource('banners', BannerController::class);
        Route::resource('recipes', RecipesController::class);  // This uses plural
        Route::resource('recipeView', RecipeController::class);  // This uses singular
        Route::post('/recipes/{recipe}/ajax-update', [RecipesController::class, 'ajaxUpdate'])
            ->name('recipes.ajax-update');
    });
    Route::get('/recipes/subcategories', [RecipesController::class, 'getSubCategories'])
        ->name('admin.recipes.subcategories');
        
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
