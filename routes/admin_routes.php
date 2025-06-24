<?php

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
use App\Http\Controllers\Admin\RecipesController;
use App\Http\Middleware\CheckUserStatus;

Route::middleware(['auth', 'verified', CheckUserStatus::class])->prefix('admin')->name('admin.')->group(function () {
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
    Route::resource('recipes', RecipesController::class);
    Route::resource('recipeView', RecipeController::class);

    Route::post('/recipes/{recipe}/ajax-update', [RecipesController::class, 'ajaxUpdate'])->name('recipes.ajax-update');

    Route::prefix('recipes/{recipe}')->name('recipes.')->group(function () {
        Route::get('translate/{lang_code}', [RecipeController::class, 'translate'])->name('translate');
        Route::post('translate/{lang_code}', [RecipeController::class, 'storeTranslation'])->name('store-translation');
        Route::put('translate/{lang_code}', [RecipeController::class, 'updateTranslation'])->name('update-translation');
        Route::delete('translation', [RecipeController::class, 'deleteTranslation'])->name('delete-translation');
        Route::post('copy/{lang_code}', [RecipeController::class, 'copyToLanguage'])->name('copy-to-language');
        Route::get('export/{lang_code}', [RecipeController::class, 'exportToLanguage'])->name('export-language');
    });

    Route::prefix('recipes')->name('recipes.')->group(function () {
        Route::get('search', [RecipeController::class, 'search'])->name('search');
        Route::get('export', [RecipeController::class, 'export'])->name('export');
        Route::post('import', [RecipeController::class, 'import'])->name('import');
        Route::get('translation-stats', [RecipeController::class, 'translationStats'])->name('translation-stats');
        Route::post('bulk-translate', [RecipeController::class, 'bulkTranslate'])->name('bulk-translate');
    });

    Route::get('/recipes/subcategories', [RecipesController::class, 'getSubCategories'])->name('recipes.subcategories');

    Route::get('/recipes/{recipe}/preview/{lang_code}', [RecipesController::class, 'preview'])->name('recipes.preview');
});
