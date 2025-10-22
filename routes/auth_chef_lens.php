<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChefLens\ChefRegisterController;
use App\Http\Controllers\ChefLens\LoginController;
use App\Http\Controllers\ChefLens\ProfileController;
use App\Http\Controllers\VideoController; // تأكد من استيراد متحكم الفيديو
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('chef_lens/edit-profile', [ProfileController::class, 'showProfile'])->name('chef_lens.edit-profile');

// Route لمعالجة تحديث البروفايل (يجب أن يكون من نوع POST)
Route::post('chef_lens/edit-profile', [ProfileController::class, 'updateProfile'])->name('chef_lens.update-profile');

Route::delete('/account', [LoginController::class, 'destroy'])->name('account.delete');

// -------------------------------------------------------------
// Routes لصفحات الطهاة (ChefLens)
// -------------------------------------------------------------

// Route لعرض صفحة تسجيل الدخول
Route::get('chef_lens/sign-in', [LoginController::class, 'showLoginForm'])->name('chef_lens.login');

// Route لمعالجة طلب تسجيل الدخول
Route::post('chef_lens/sign-in', [LoginController::class, 'login'])->name('chef_lens.login.post');


// Route لعرض صفحة تسجيل حساب جديد
Route::get('chef_lens/sign-up', [ChefRegisterController::class, 'showRegistrationForm'])->name('chef_lens.sign-up');

// Route لمعالجة طلب التسجيل
Route::post('chef_lens/sign-up', [ChefRegisterController::class, 'register'])->name('chef_lens.register');


// Route لصفحة استعادة كلمة المرور
Route::get('chef_lens/forgot-password', function () {
    return view('chef_lens.auth.forgot-password');
})->name('chef_lens.forgot-password');

// Route لصفحة تأكيد رمز التحقق
Route::get('chef_lens/otp-confirm', function () {
    return view('chef_lens.auth.otp-confirm');
})->name('chef_lens.otp-confirm');

// Route لصفحة تغيير كلمة المرور
Route::get('chef_lens/change-password', function () {
    return view('chef_lens.auth.change-password');
})->name('chef_lens.change-password');


// -------------------------------------------------------------
// Route لتسجيل الخروج
// -------------------------------------------------------------
Route::post('/chef_lens.logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('chef_lens.login');
})->name('chef_lens.logout');

Route::post('chef_lens/forgot-password', [LoginController::class, 'sendResetLink'])->name('chef_lens.forgot-password.send');
Route::post('chef_lens/otp-confirm', [LoginController::class, 'verifyOtp'])->name('chef_lens.otp-confirm.post');
Route::post('chef_lens/change-password', [LoginController::class, 'changePassword'])->name('chef_lens.change-password.post');
