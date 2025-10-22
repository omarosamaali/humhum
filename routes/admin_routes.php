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
use App\Http\Controllers\Admin\TermsController;
use App\Http\Controllers\Admin\HospController;
use App\Http\Controllers\Admin\TypesController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\FamiliesController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\RecipesController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TipsController;
use App\Http\Middleware\AdminRole;
use App\Http\Controllers\MessageController;
use App\Models\Contact;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/messages', [MessageController::class, 'adminIndex'])->name('messages.index');
    Route::get('/messages/{id}', [MessageController::class, 'adminShow'])->name('messages.show');
    Route::put('/messages/{id}', [MessageController::class, 'adminUpdate'])->name('messages.update');
    Route::delete('/messages/{id}', [MessageController::class, 'adminDestroy'])->name('messages.destroy');
    Route::post('/messages/{message}/reply', [MessageController::class, 'adminReply'])->name('messages.reply');
    Route::get('/messages/{message}', [MessageController::class, 'adminShowAndReply'])->name('messages.message-show');
    Route::post('/messages/{message}/update-status-and-reply', [MessageController::class, 'adminUpdateStatusAndReply'])->name('messages.update-status-and-reply');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // List contacts
    Route::get('/contacts', function () {
        $contacts = Contact::latest()->paginate(10); // Changed variable to $contacts for consistency
        return view('admin.contacts.index', compact('contacts'));
    })->name('contacts.index');

    // Show contact details
    Route::get('/contacts/{id}', function ($id) {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    })->name('contacts.show');

    // Mark as read
    Route::patch('/contacts/{id}/mark-read', function ($id) {
        $contact = Contact::findOrFail($id);
        $contact->update(['status' => 'read']);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'تم تعليم الرسالة كمقروءة']);
        }

        return redirect()->back()->with('success', 'تم تعليم الرسالة كمقروءة');
    })->name('contacts.mark-read');

    // Mark as unread
    Route::patch('/contacts/{id}/mark-unread', function ($id) {
        $contact = Contact::findOrFail($id);
        $contact->update(['status' => 'unread']);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'تم تعليم الرسالة كغير مقروءة']);
        }

        return redirect()->back()->with('success', 'تم تعليم الرسالة كغير مقروءة');
    })->name('contacts.mark-unread');

    // Delete contact
    Route::delete('/contacts/{id}', function ($id) {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'تم حذف الرسالة بنجاح');
    })->name('contacts.destroy');

    // Bulk update
    Route::patch('/contacts/bulk-update', function () {
        $ids = request('ids', []);
        $action = request('action');

        if (empty($ids) || !$action) {
            return redirect()->back()->with('error', 'يرجى اختيار رسائل وإجراء');
        }

        $statusMap = [
            'mark_read' => 'read',
            'mark_unread' => 'unread',
        ];

        if (isset($statusMap[$action])) {
            Contact::whereIn('id', $ids)->update(['status' => $statusMap[$action]]);
            $message = match ($action) {
                'mark_read' => 'تم تعليم الرسائل المحددة كمقروءة',
                'mark_unread' => 'تم تعليم الرسائل المحددة كغير مقروءة',
            };
            return redirect()->back()->with('success', $message);
        }

        if ($action === 'delete') {
            Contact::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', 'تم حذف الرسائل المحددة');
        }

        return redirect()->back()->with('error', 'إجراء غير صحيح');
    })->name('contacts.bulk-update');
});
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('languages', LanguageController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('plans', PlanController::class);
    Route::resource('mainCategories', MainCategoriesController::class);
    Route::resource('subCategories', SubCategoryController::class);
    Route::resource('kitchens', KitchensController::class);
    Route::resource('families', FamiliesController::class);
    Route::resource('tips', TipsController::class);
    Route::resource('news', NewsController::class);
    Route::resource('about-us', AboutUsController::class);
    Route::resource('terms', TermsController::class);
    Route::resource('hosp', HospController::class);
    Route::resource('types', TypesController::class);
    Route::resource('food', FoodController::class);
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
