<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\User\AuthenticatedSessionController;
use App\Http\Controllers\User\ConfirmablePasswordController;
use App\Http\Controllers\User\EmailVerificationNotificationController;
use App\Http\Controllers\User\EmailVerificationPromptController;
use App\Http\Controllers\User\NewPasswordController;
use App\Http\Controllers\User\PasswordController;
use App\Http\Controllers\User\ForgotPasswordController;
use App\Http\Controllers\User\RegisteredUserController;
use App\Http\Controllers\User\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\OtpController;
use App\Http\Controllers\User\WelcomeController;
use App\Http\Controllers\User\FavoriteController;
use App\Http\Controllers\User\RecipeController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\FamilyController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\CooksController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth.user')->group(function () {
    // Cooks Routes
    Route::get('users.cooks.index', [CooksController::class, 'index'])->name('users.cooks.index');
    Route::get('users.cooks.create', [CooksController::class, 'create'])->name('users.cooks.create');
    Route::post('users.cooks.store', [CooksController::class, 'store'])->name('users.cooks.store');
    Route::get('users.cooks.edit.{cook}', [CooksController::class, 'edit'])->name('users.cooks.edit');
    Route::post('users/cooks/{cook}', [CooksController::class, 'update'])->name('users.cooks.update');
    Route::delete('users/cooks/destroy/{cook}', [CooksController::class, 'destroy'])->name('users.cooks.destroy');
    Route::get('users.cooks.choose-image.{cook}', [CooksController::class, 'chooseImage'])
        ->name('users.cooks.chooseImage');
    Route::post('users.cooks.choose-image.{cook}', [CooksController::class, 'updateImage'])
        ->name('users.cooks.updateImage');

    Route::post('/save-fcm-token', function (Request $request) {
        Auth::user()->update(['fcm_token' => $request->token]);
        return response()->json(['success' => true]);
    });

    // Notification Routes
    Route::get('users.notifications.index', [NotificationController::class, 'index'])->name('users.notifications.index');
    Route::delete('users.notifications.destroy.{notification}', [NotificationController::class, 'destroy'])->name('users.notifications.destroy');

    // Family Routes
    Route::get('users.family.index', [FamilyController::class, 'index'])->name('users.family.index');
    Route::get('users.family.create', [FamilyController::class, 'create'])->name('users.family.create');
    Route::get('users.family.show.{myFamily}', [FamilyController::class, 'show'])->name('users.family.show');
    Route::post('users.family.store', [FamilyController::class, 'store'])->name('users.family.store');
    Route::get('users.family.edit.{myFamily}', [FamilyController::class, 'edit'])
    ->name('users.family.edit');
    Route::put('users.family.update.{myFamily}', [FamilyController::class, 'update'])->name('users.family.update');
    Route::get('users.family.choose-image.{myFamily}', [FamilyController::class, 'chooseImage'])
        ->name('users.family.chooseImage');
    Route::post('users.family.choose-image.{myFamily}', [FamilyController::class, 'updateImage'])
        ->name('users.family.updateImage');
    Route::delete('users.family.destroy.{myFamily}', [FamilyController::class, 'destroy'])
        ->name('users.family.destroy');
    Route::get('users.family.has_email.{myFamily}', [FamilyController::class, 'edit_has_email'])->name('users.family.has_email');
    Route::post('users/family/{myFamily}/update-has-email', [FamilyController::class, 'update_has_email'])
        ->name('users.family.update_has_email');
    Route::get('users.family.send_notification.{myFamily}', [FamilyController::class, 'edit_send_notification'])
    ->name('users.family.send_notification');
    Route::post('users/family/{myFamily}/update-send-notification', [FamilyController::class, 'update_send_notification'])
        ->name('users.family.update_send_notification');
    Route::get('users.family.language.{myFamily}', [FamilyController::class, 'edit_language'])
        ->name('users.family.language');
    Route::post('users/family/{myFamily}/update-language', [FamilyController::class, 'update_language'])
        ->name('users.family.update_language');
    Route::get('users.family.tips.{myFamily}', [FamilyController::class, 'edit_tips'])
        ->name('users.family.tips');
    Route::post('users/family/{myFamily}/update-tips', [FamilyController::class, 'update_tips'])
        ->name('users.family.update_tips');
    Route::get('users.family.add_tips.{myFamily}', [FamilyController::class, 'add_edit_tips'])
        ->name('users.family.add_tips');
    Route::post('users/family/{myFamily}/add_update-tips', [FamilyController::class, 'add_update_tips'])
        ->name('users.family.add_update_tips');
    Route::delete('users/family/custom-tip/{customTip}', [FamilyController::class, 'delete_custom_tip'])
        ->name('users.family.delete_custom_tip');

    // Profile Routes
    Route::get('users.profile.index', [ProfileController::class, 'index'])->name('users.profile.index');
    Route::get('users.profile.edit', [ProfileController::class, 'edit'])->name('users.profile.edit');
    Route::put('users.profile/{user}', [ProfileController::class, 'update'])->name('users.profile.update');
    Route::get('users.profile.chooseImage.{user}', [ProfileController::class, 'chooseImage'])->name('users.profile.chooseImage');
    Route::post('users.profile.choose-image.{user}', [ProfileController::class, 'updateImage'])->name('users.profile.updateImage');
    Route::delete('users/profile/delete', [ProfileController::class, 'destroy'])->name('users.profile.destroy');

    Route::get('users/recipes/show/{recipe}', [RecipeController::class, 'show'])->name('users.recipes.show');
    Route::post('/toggle-favorite', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::post('users.auth.logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('users.auth.logout');
});

Route::middleware('check.user')->group(function () {
    // Cooks Login Routes
    Route::get('users.cooks_members.login', [CooksController::class, 'cook_login'])
        ->name('users.cooks_members.login');
    Route::post('users.cooks_members.login', [CooksController::class, 'cook_login_post'])
        ->name('users.cooks.login.post');

        // Registration OTP Routes (for new user registration)
    Route::get('users.auth.register.verify-otp', [OtpController::class, 'showForm'])
        ->name('users.register.verify.otp');
    Route::post('users.auth.register.verify-otp', [OtpController::class, 'verify'])
        ->name('users.register.verify.otp.post');

    // Registration Routes
    Route::get('users.auth.register', [RegisteredUserController::class, 'create'])
        ->name('users.auth.register');
    Route::post('users.auth.register', [RegisteredUserController::class, 'store'])
        ->name('users.auth.store');

    // Login Routes
    Route::get('users.auth.login', [AuthenticatedSessionController::class, 'create'])
        ->name('users.auth.login');
    Route::post('users.auth.post', [AuthenticatedSessionController::class, 'store'])
        ->name('users.auth.post');

    // Forgot Password Routes
    Route::get('users.auth.forgot-password', [ForgotPasswordController::class, 'showEmailForm'])
        ->name('users.auth.password.request');

    Route::post('users.auth.forgot-password', [ForgotPasswordController::class, 'sendOtp'])
        ->name('users.auth.password.email');

    // Password Reset OTP Routes (separate from registration OTP)
    Route::get('users.auth.password.verify-passwrd-otp', [ForgotPasswordController::class, 'showOtpForm'])
        ->name('users.auth.password.verify.otp');

    Route::post('users.auth.password.verify-passwrd-otp', [ForgotPasswordController::class, 'verifyOtp'])
        ->name('users.auth.password.verify.otp.post');

    Route::post('users.auth.password.resend-otp', [ForgotPasswordController::class, 'resendOtp'])
        ->name('users.auth.password.resend.otp');

    // Reset Password Routes
    Route::get('users.auth.reset-password', [ForgotPasswordController::class, 'showResetForm'])
        ->name('users.auth.password.reset.form');

    Route::post('users.auth.reset-password', [ForgotPasswordController::class, 'resetPassword'])
        ->name('users.auth.password.reset.post');

    // Email Verification Routes
    Route::get('users.auth.verify-email', EmailVerificationPromptController::class)
        ->name('users.auth.verification.notice');

    Route::get('users.auth.verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('users.auth.verification.verify');

    Route::post('users.auth.email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('users.auth.verification.send');

    // Password Confirmation Routes
    Route::get('users.auth.confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('users.auth.password.confirm');

    Route::post('users.auth.confirm-password', [ConfirmablePasswordController::class, 'store'])
        ->name('users.auth.password.confirm.post');

    // Password Update Route
    Route::put('users.auth.password', [PasswordController::class, 'update'])
        ->name('users.auth.password.update');
});

Route::get('users.welcome', [WelcomeController::class, 'index'])->name('users.welcome');
Route::post('/set-language', [LanguageController::class, 'setLanguage'])->name('set.language');
