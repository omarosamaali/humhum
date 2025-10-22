<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\User\BlockedController;
use App\Http\Controllers\Users\CookTableController;
use App\Http\Controllers\MealPlanController;

Route::middleware('auth.user')->group(function () {
    // Cook Table Routes
    Route::get('users.cook_table.index', [MealPlanController::class, 'create'])->name('users.cook_table.index');
    // Route::get('/meal-plans/create', [MealPlanController::class, 'create'])->name('meal_plans.create');
    Route::post('/meal-plans', [MealPlanController::class, 'store'])->name('meal_plans.store');
    Route::delete('/meal-plans/{mealPlanId}/{date}/{type}', [MealPlanController::class, 'destroyDay'])->name('meal_plans.destroy_day');


    // Blocked Routes
    Route::get('users.blocked.index', [BlockedController::class, 'index'])->name('users.blocked.index');
    Route::get('users.blocked.show', [BlockedController::class, 'show'])->name('users.blocked.show');
    Route::get('users.blocked.{blocked}.edit', [BlockedController::class, 'edit'])->name('users.blocked.edit');
    Route::put('users.blocked.{blocked}.update', [BlockedController::class, 'update'])->name('users.blocked.update');
    Route::delete('users.blocked.{blocked}.destroy', [BlockedController::class, 'destroy'])->name('users.blocked.destroy');
    Route::post('users.blocked.store', [BlockedController::class, 'store'])->name('users.blocked.store');
    Route::post('/blocked', [BlockedController::class, 'store'])->name('blocked.store');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});
