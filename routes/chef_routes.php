<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\C1he3f\Auth\ChefAuthenticatedSessionController;
use App\Http\Controllers\C1he3f\Auth\ChefPasswordResetLinkController;
use App\Http\Controllers\C1he3f\Auth\ChefNewPasswordController;
use App\Http\Controllers\ChefMarketController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\RecipesController;
use App\Models\Kitchens;
use App\Models\MainCategories;
use App\Models\SubCategory;
use App\Http\Controllers\ProductController;

Route::get('/c1he3f/my-products', [ProductController::class, 'index'])->name('c1he3f.my-products');
Route::get('/c1he3f/products/create', [ProductController::class, 'create'])->name('c1he3f.products.create');
Route::post('/c1he3f/products', [ProductController::class, 'store'])->name('c1he3f.products.store');
Route::get('/c1he3f/products/{product}', [ProductController::class, 'show'])->name('c1he3f.products.show');
Route::get('/c1he3f/products/{product}/edit-product', [ProductController::class, 'edit'])->name('c1he3f.products.edit-product');
Route::put('/c1he3f/products/{product}', [ProductController::class, 'update'])->name('c1he3f.products.update');
Route::delete('/c1he3f/products/{product}', [ProductController::class, 'destroy'])->name('c1he3f.products.destroy');

// يمكنك استخدام Route::resource لتعريف كل الـ routes السابقة بشكل مختصر
// Route::resource('/c1he3f/products', ProductController::class)->names('c1he3f.products');

Route::get('/c1he3f/new-message', [MessageController::class, 'create'])->name('c1he3f.new-message');
Route::post('/c1he3f/messages', [MessageController::class, 'store'])->name('c1he3f.messages.store');
Route::get('/c1he3f/messages', [MessageController::class, 'index'])->name('c1he3f.messages');
Route::get('/c1he3f/messages/{id}', [MessageController::class, 'show'])->name('c1he3f.messages.show');
Route::post('/c1he3f/messages/{id}/reply', [MessageController::class, 'reply'])->name('c1he3f.messages.reply');
Route::get('/c1he3f/recpies/{recipe}/edit', [RecipesController::class, 'edit'])->name('c1he3f.recpies.edit');
// Route::put('/c1he3f/recpies/{recipe}/updateChef', [RecipesController::class, 'updateChef'])->name('c1he3f.recpies.updateChef');
Route::put('/c1he3f/recipes/{recipe}', [RecipesController::class, 'updateChef'])->name('c1he3f.recipes.updateChef');

Route::get('/c1he3f/recpies/{recipe}/editChef', [RecipesController::class, 'editChef'])->name('c1he3f.recpies.editChef');
Route::get('/admin/recipes/subcategories', [RecipesController::class, 'getSubCategories'])
    ->name('admin.recipes.subcategories');
Route::put('/c1he3f/recpies/{recipe}/update', [RecipesController::class, 'update'])->name('c1he3f.recpies.update');
Route::get('/c1he3f/recpies/all_recipes', [RecipesController::class, 'allRecipes'])->name('c1he3f.recpies.all_recipes');
Route::get('/chef/recipes/{id}', [RecipesController::class, 'viewRecipe'])->name('chef.recipes.view');
Route::get('/c1he3f/recpies/add-recpie', [RecipesController::class, 'addRecipe'])->name('c1he3f.recpies.add-recpie');
Route::get('/c1he3f/recpies/subcategories', [RecipesController::class, 'getSubCategories'])->name('c1he3f.recpies.subcategories');
// Route::put('/c1he3f/recpies/{id}/update', [RecipesController::class, 'update'])->name('c1he3f.recpies.update');
Route::group(['prefix' => 'c1he3f', 'as' => 'c1he3f.', 'middleware' => ['auth']], function () {
    Route::get('recipes/{recipe}/steps/edit', [RecipesController::class, 'showStepsForm'])->name('recpies.steps');
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

// -----------------------------------------------------------------------------
// Chef (C1he3f) Auth Routes - مسارات تسجيل الدخول والتسجيل للطهاة
// -----------------------------------------------------------------------------
Route::middleware('guest')->group(function () {
    // لعرض فورم تسجيل الدخول للطهاة (معدل لاستخدام الدالة الجديدة)
    Route::get('c1he3f/auth/sign-in', [ChefAuthenticatedSessionController::class, 'createLogin'])->name('c1he3f.auth.sign-in');

    // لمعالجة تسجيل الدخول للطهاة بعد إدخال البيانات (معدل لاستخدام الدالة الجديدة)
    Route::post('c1he3f/auth/sign-in', [ChefAuthenticatedSessionController::class, 'storeLogin'])->name('c1he3f.auth.sign-in.post');

    // لعرض فورم التسجيل للطاهي (هذه ما زالت تستخدم دالة create الأصلية لـ ChefAuthenticatedSessionController)
    Route::get('c1he3f/auth/sign-up', [ChefAuthenticatedSessionController::class, 'create'])->name('c1he3f.auth.sign-up');

    // لمعالجة تسجيل الطاهي (هذه ما زالت تستخدم دالة store الأصلية لـ ChefAuthenticatedSessionController، التي هي للتسجيل)
    Route::post('c1he3f/auth/sign-up', [ChefAuthenticatedSessionController::class, 'store'])->name('c1he3f.auth.sign-up.post');

    // ... (باقي مسارات الـ OTP واستعادة كلمة المرور كما هي)
    // لعرض فورم تأكيد الـ OTP
    Route::get('c1he3f/auth/otp-confirm', [ChefAuthenticatedSessionController::class, 'showOtpConfirmForm'])->name('c1he3f.auth.otp-confirm');
    // لمعالجة التحقق من الـ OTP
    Route::post('c1he3f/auth/otp-verify', [ChefAuthenticatedSessionController::class, 'verifyOtp'])->name('c1he3f.auth.otp-verify');
    // لإعادة إرسال الـ OTP
    Route::post('c1he3f/auth/otp-resend', [ChefAuthenticatedSessionController::class, 'resendOtp'])->name('c1he3f.auth.otp-resend');

    // مسارات استعادة كلمة المرور للطهاة
    Route::get('c1he3f/auth/forgot-password', [ChefPasswordResetLinkController::class, 'create'])->name('c1he3f.auth.forgot-password.get');
    Route::post('c1he3f/auth/forgot-password', [ChefPasswordResetLinkController::class, 'store'])->name('c1he3f.auth.password.email.chef');
    Route::get('c1he3f/auth/reset-password/{token}', [ChefNewPasswordController::class, 'create'])->name('c1he3f.auth.reset-password.get');
    Route::post('c1he3f/auth/reset-password', [ChefNewPasswordController::class, 'store'])->name('c1he3f.auth.password.update.chef');
});

// -----------------------------------------------------------------------------
// Protected Routes for Authenticated Chefs - مسارات محمية للطهاة بعد تسجيل الدخول
// -----------------------------------------------------------------------------
Route::middleware(['auth'])->prefix('c1he3f/profile')->name('c1he3f.profile.')->group(function () {
    Route::get('/', function () {
        return view('c1he3f/profile/profile');
    })->name('profile');

    Route::get('/my-market', [ChefMarketController::class, 'showMyMarket'])->name('my-market');
    Route::post('/save-market-choice', [ChefMarketController::class, 'saveMyMarketChoice'])->name('save-market-choice');
    Route::get('/delivery-location', [ChefMarketController::class, 'showDeliveryLocations'])->name('delivery-location');
    Route::get('/add-delivery-address', [ChefMarketController::class, 'showAddDeliveryAddressForm'])->name('add-delivery-address');
    Route::post('/store-delivery-address', [ChefMarketController::class, 'storeDeliveryAddress'])->name('store-delivery-address');
    Route::delete('/delivery-location/{deliveryLocation}', [ChefMarketController::class, 'destroyDeliveryLocation'])->name('delivery-location.destroy');
    Route::get('/edit-profile', [ChefMarketController::class, 'edit'])->name('edit-profile');
    Route::post('/update', [ChefMarketController::class, 'update'])->name('update');
    Route::get('/agreement', [ChefMarketController::class, 'showTermsAndConditions'])->name('agreement');
    Route::get('/sign-agreement', [ChefMarketController::class, 'showSignAgreementForm'])->name('sign');
    Route::post('/verify-contract-otp', [ChefMarketController::class, 'verifyContractOtp'])->name('verify-contract-otp');
    Route::post('/resend-contract-otp', [ChefMarketController::class, 'resendContractOtp'])->name('resend-contract-otp');
    Route::get('/transfer', function () {
        $chefProfile = Auth::user()->chefProfile;
        return view('c1he3f/profile/transfer', compact('chefProfile'));
    })->name('transfer');
    Route::post('/updateTransfer', [UserController::class, 'updateTransfer'])->name('updateTransfer');
    Route::get('/agrem', function () {
        return view('c1he3f/profile/agrem');
    })->name('agrem');
    Route::get('/agryType', function () {
        return view('c1he3f/profile/agryType');
    })->name('agryType');
    Route::post('/update-agreement-type', [UserController::class, 'updateChefAgreementType'])->name('updateAgreementType');
    Route::post('/updateBio', [UserController::class, 'updateChefBio'])->name('updateBio');
    Route::get('/bio', function () {
        return view('c1he3f/profile/bio');
    })->name('bio');
    Route::get('/profileDisplayed', function () {
        return view('c1he3f/profile/profileDisplayed');
    })->name('profileDisplayed');
    Route::post('chef/logout', [ChefAuthenticatedSessionController::class, 'destroy'])->name('chef.logout');
});


Route::get('/chefThree/new-message', [MessageController::class, 'create'])->name('chefThree.new-message');
Route::post('/chefThree/messages', [MessageController::class, 'store'])->name('chefThree.messages.store');
Route::get('/chefThree/messages', [MessageController::class, 'index'])->name('chefThree.messages');
Route::get('/chefThree/messages/{id}', [MessageController::class, 'show'])->name('chefThree.messages.show');
Route::post('/chefThree/messages/{id}/reply', [MessageController::class, 'reply'])->name('chefThree.messages.reply');

Route::get('/chefThree/recpies/all_recipes', [RecipesController::class, 'allRecipes'])->name('chef.recipes.all');
Route::get('/chef/recipes/{id}', [RecipesController::class, 'viewRecipe'])->name('chef.recipes.view');
Route::get('/chefThree/recpies/add-recpie', [RecipesController::class, 'create'])->name('chefThree.recpies.add-recpie');

Route::group(['prefix' => 'chefThree', 'as' => 'chefThree.', 'middleware' => ['auth']], function () {
    Route::get('recipes/{recipe}/steps/edit', [RecipesController::class, 'showStepsForm'])->name('recpies.steps');
    Route::put('recipes/{recipe}/steps', [RecipesController::class, 'updateSteps'])->name('recpies.updateSteps');
    Route::get('recipes/{recipe}/ingredients', [RecipesController::class, 'showIngredientsForm'])->name('recpies.ingredients');
    Route::put('recipes/{recipe}/ingredients', [RecipesController::class, 'updateIngredients'])->name('recpies.updateIngredients');
    Route::get('recipes/{recipe}/ingredients/edit', [RecipesController::class, 'showIngredientsForm'])->name('recipes.editIngredients');
    Route::get('recpies/add-recpie', function () {
        $kitchens = Kitchens::select('id', 'name_ar')->get();
        $mainCategories = MainCategories::select('id', 'name_ar')->get();
        $subCategory = SubCategory::select('id', 'name_ar')->get();
        return view('chefThree/recpies/add-recpie', compact('kitchens', 'mainCategories', 'subCategory'));
    })->name('recpies.add-recpie');
    Route::get('recpies/subcategories', [RecipesController::class, 'getSubCategories'])->name('recpies.subcategories');
    Route::get('recpies/{recipe}/facts', [RecipesController::class, 'showNutritionalFactsForm'])->name('recpies.facts');
    Route::put('recpies/{recipe}/update_nutritional_facts', [RecipesController::class, 'updateNutritionalFacts'])->name('recpies.update_nutritional_facts');
    Route::post('recpies/store', [RecipesController::class, 'storePublicRecipe'])->name('recpies.store');
    Route::get('/recpies/favorites', function () {
        return view('chefThree.recpies.favorites');
    })->name('recpies.favorites');
    Route::get('recpies/{recipe}', [RecipesController::class, 'showChefRecipes'])->name('recpies.showChefRecipes');
});

// -----------------------------------------------------------------------------
// Chef (chefThree) Auth Routes - مسارات تسجيل الدخول والتسجيل للطهاة
// -----------------------------------------------------------------------------
Route::middleware('guest')->group(function () {
    // لعرض فورم تسجيل الدخول للطهاة (معدل لاستخدام الدالة الجديدة)
    Route::get('chefThree/auth/sign-in', [ChefAuthenticatedSessionController::class, 'createLogin'])->name('chefThree.auth.sign-in');

    // لمعالجة تسجيل الدخول للطهاة بعد إدخال البيانات (معدل لاستخدام الدالة الجديدة)
    Route::post('chefThree/auth/sign-in', [ChefAuthenticatedSessionController::class, 'storeLogin'])->name('chefThree.auth.sign-in.post');

    // لعرض فورم التسجيل للطاهي (هذه ما زالت تستخدم دالة create الأصلية لـ ChefAuthenticatedSessionController)
    Route::get('chefThree/auth/sign-up', [ChefAuthenticatedSessionController::class, 'create'])->name('chefThree.auth.sign-up');

    // لمعالجة تسجيل الطاهي (هذه ما زالت تستخدم دالة store الأصلية لـ ChefAuthenticatedSessionController، التي هي للتسجيل)
    Route::post('chefThree/auth/sign-up', [ChefAuthenticatedSessionController::class, 'store'])->name('chefThree.auth.sign-up.post');

    // ... (باقي مسارات الـ OTP واستعادة كلمة المرور كما هي)
    // لعرض فورم تأكيد الـ OTP
    Route::get('chefThree/auth/otp-confirm', [ChefAuthenticatedSessionController::class, 'showOtpConfirmForm'])->name('chefThree.auth.otp-confirm');
    // لمعالجة التحقق من الـ OTP
    Route::post('chefThree/auth/otp-verify', [ChefAuthenticatedSessionController::class, 'verifyOtp'])->name('chefThree.auth.otp-verify');
    // لإعادة إرسال الـ OTP
    Route::post('chefThree/auth/otp-resend', [ChefAuthenticatedSessionController::class, 'resendOtp'])->name('chefThree.auth.otp-resend');

    // مسارات استعادة كلمة المرور للطهاة
    Route::get('chefThree/auth/forgot-password', [ChefPasswordResetLinkController::class, 'create'])->name('chefThree.auth.forgot-password.get');
    Route::post('chefThree/auth/forgot-password', [ChefPasswordResetLinkController::class, 'store'])->name('chefThree.auth.password.email.chef');
    Route::get('chefThree/auth/reset-password/{token}', [ChefNewPasswordController::class, 'create'])->name('chefThree.auth.reset-password.get');
    Route::post('chefThree/auth/reset-password', [ChefNewPasswordController::class, 'store'])->name('chefThree.auth.password.update.chef');
});

// -----------------------------------------------------------------------------
// Protected Routes for Authenticated Chefs - مسارات محمية للطهاة بعد تسجيل الدخول
// -----------------------------------------------------------------------------
Route::middleware(['auth'])->prefix('chefThree/profile')->name('chefThree.profile.')->group(function () {
    Route::get('/', function () {
        return view('chefThree/profile/profile');
    })->name('profile');

    Route::get('/my-market', [ChefMarketController::class, 'showMyMarket'])->name('my-market');
    Route::post('/save-market-choice', [ChefMarketController::class, 'saveMyMarketChoice'])->name('save-market-choice');
    Route::get('/delivery-location', [ChefMarketController::class, 'showDeliveryLocations'])->name('delivery-location');
    Route::get('/add-delivery-address', [ChefMarketController::class, 'showAddDeliveryAddressForm'])->name('add-delivery-address');
    Route::post('/store-delivery-address', [ChefMarketController::class, 'storeDeliveryAddress'])->name('store-delivery-address');
    Route::delete('/delivery-location/{deliveryLocation}', [ChefMarketController::class, 'destroyDeliveryLocation'])->name('delivery-location.destroy');
    Route::get('/edit-profile', [ChefMarketController::class, 'edit'])->name('edit-profile');
    Route::post('/update', [ChefMarketController::class, 'update'])->name('update');
    Route::get('/agreement', [ChefMarketController::class, 'showTermsAndConditions'])->name('agreement');
    Route::get('/sign-agreement', [ChefMarketController::class, 'showSignAgreementForm'])->name('sign');
    Route::post('/verify-contract-otp', [ChefMarketController::class, 'verifyContractOtp'])->name('verify-contract-otp');
    Route::post('/resend-contract-otp', [ChefMarketController::class, 'resendContractOtp'])->name('resend-contract-otp');
    Route::get('/transfer', function () {
        $chefProfile = Auth::user()->chefProfile;
        return view('chefThree/profile/transfer', compact('chefProfile'));
    })->name('transfer');
    Route::post('/updateTransfer', [UserController::class, 'updateTransfer'])->name('updateTransfer');
    Route::get('/agrem', function () {
        return view('chefThree/profile/agrem');
    })->name('agrem');
    Route::get('/agryType', function () {
        return view('chefThree/profile/agryType');
    })->name('agryType');
    Route::post('/update-agreement-type', [UserController::class, 'updateChefAgreementType'])->name('updateAgreementType');
    Route::post('/updateBio', [UserController::class, 'updateChefBio'])->name('updateBio');
    Route::get('/bio', function () {
        return view('chefThree/profile/bio');
    })->name('bio');
    Route::get('/profileDisplayed', function () {
        return view('chefThree/profile/profileDisplayed');
    })->name('profileDisplayed');
    Route::post('chef/logout', [ChefAuthenticatedSessionController::class, 'destroy'])->name('chef.logout');
});
