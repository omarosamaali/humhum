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

// في web.php أو admin.php
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    
    // Routes الأساسية للوصفات
    
    // Routes خاصة بالترجمات
    Route::prefix('recipes/{recipe}')->name('recipes.')->group(function () {
        // عرض نموذج الترجمة
        Route::get('translate/{lang_code}', [RecipeController::class, 'translate'])
            ->name('translate');
        
        // حفظ الترجمة
        Route::post('translate/{lang_code}', [RecipeController::class, 'storeTranslation'])
            ->name('store-translation');
        
        // تحديث الترجمة
        Route::put('translate/{lang_code}', [RecipeController::class, 'updateTranslation'])
            ->name('update-translation');
        
        // حذف الترجمة
        Route::delete('translation', [RecipeController::class, 'deleteTranslation'])
            ->name('delete-translation');
        
        // نسخ الوصفة بلغة معينة
        Route::post('copy/{lang_code}', [RecipeController::class, 'copyToLanguage'])
            ->name('copy-to-language');
        
        // تصدير الوصفة بلغة معينة
        Route::get('export/{lang_code}', [RecipeController::class, 'exportToLanguage'])
            ->name('export-language');
    });
    
    // Routes إضافية مفيدة
    Route::prefix('recipes')->name('recipes.')->group(function () {
        
        // البحث في الوصفات
        Route::get('search', [RecipeController::class, 'search'])
            ->name('search');
        
        // تصدير جميع الوصفات
        Route::get('export', [RecipeController::class, 'export'])
            ->name('export');
        
        // استيراد الوصفات
        Route::post('import', [RecipeController::class, 'import'])
            ->name('import');
        
        // إحصائيات الترجمات
        Route::get('translation-stats', [RecipeController::class, 'translationStats'])
            ->name('translation-stats');
        
        // تحديث مجمع للترجمات
        Route::post('bulk-translate', [RecipeController::class, 'bulkTranslate'])
            ->name('bulk-translate');
    });
});
Route::get('/recipes/subcategories', [RecipesController::class, 'getSubCategories'])
    ->name('admin.recipes.subcategories');

Route::get('admin/recipes/{recipe}/preview/{lang_code}', [RecipesController::class, 'preview']) // Changed to RecipesController
    ->name('admin.recipes.preview');
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
    // Route::get('/recipes/subcategories', [RecipesController::class, 'getSubCategories'])
    //     ->name('admin.recipes.subcategories');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
