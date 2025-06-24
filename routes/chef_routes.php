<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\C1he3f\Auth\ChefAuthenticatedSessionController;
use App\Http\Controllers\C1he3f\Auth\ChefPasswordResetLinkController;
use App\Http\Controllers\C1he3f\Auth\ChefNewPasswordController;
use App\Http\Controllers\ChefMarketController;
use App\Http\Controllers\Admin\UserController;

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

    // مسار تسجيل الخروج للطهاة (يفضل أن يكون POST)
    Route::post('/logout', [ChefAuthenticatedSessionController::class, 'destroy'])->name('logout');
});
