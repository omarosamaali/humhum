<?php

use App\Http\Controllers\User\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\User\BlockedController;
use App\Http\Controllers\Users\CookTableController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\User\FaqController;
use App\Http\Controllers\User\TermsController;
use App\Http\Controllers\User\MessageController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\Users\SpecialController;

Route::post('/save-onesignal-player-id', [AuthenticatedSessionController::class, 'saveOneSignalPlayerId'])
    ->name('users.save-onesignal-player-id');


Route::post('/recipe/complete-step', [MealController::class, 'completeStep'])->name('recipe.complete-step');
Route::get('users/meals/show/{id}', [MealController::class, 'show'])->name('users.meals.show');
Route::get('users/meals/show-meal/{id}', [MealController::class, 'showMeal'])->name('users.meals.show-meal');
Route::get('users.meals.ingredients.{id}', [MealController::class, 'ingredients'])->name('users.meals.ingredients');
Route::get('users.meals.steps.{id}', [MealController::class, 'steps'])->name('users.meals.steps');
Route::post('/recipe/reset-steps', [MealController::class, 'resetSteps'])->name('recipe.reset-steps');
Route::get('users.meals.facts.{id}', [MealController::class, 'facts'])->name('users.meals.facts');

Route::middleware('auth.user')->group(function () {
    // Create Special request
    Route::get('users.special.index', [SpecialController::class, 'index'])->name('users.special.index');
    Route::get('users.special.create', [SpecialController::class, 'create'])->name('users.special.create');
    Route::post('users.special.store', [SpecialController::class, 'store'])->name('users.special.store');
    Route::get('users.special.show.{id}', [SpecialController::class, 'show'])->name('users.special.show');
    Route::get('/meals/load-more', [SpecialController::class, 'loadMoreMeals'])
        ->name('meals.load-more');

    // Meals
    Route::get('users.meals.index', [MealController::class, 'index'])->name('users.meals.index');
    Route::get('users.meals.table-cook', [MealController::class, 'tableCook'])->name('users.meals.table-cook');
    Route::get('users.meals.families.{id}', [MealController::class, 'families'])->name('users.meals.families');
    Route::delete('users.meals.destroy.{id}', [MealController::class, 'destroy'])->name('users.meals.destroy');
    Route::get('user.meal-plans.show.{id}', [MealPlanController::class, 'show'])->name('user.meal-plans.show');
    Route::get('users.meals.view-meal.{id}', [MealController::class, 'viewMeal'])->name('users.meals.view-meal');
    Route::get('users.meals.view-meal-lunch.{id}', [MealController::class, 'viewMealLunch'])->name('users.meals.view-meal-lunch');
    Route::get('users.meals.view-meal-dinner.{id}', [MealController::class, 'viewMealDinner'])->name('users.meals.view-meal-dinner');
    Route::get('users.meals.change-recipe.{id}.{type}', [MealController::class, 'showChangeRecipe'])
        ->name('users.meals.change-recipe');
    Route::post('users/meals/update-recipe/{id}', [MealController::class, 'updateRecipe'])
        ->name('users.meals.update-recipe');

    // Notifications
    Route::post('/send-unavailable-notification', [NotificationController::class, 'sendUnavailableNotification'])->name('send.unavailable.notification');
    Route::post('/send-start-cooking-notification', [NotificationController::class, 'sendStartCookingNotification'])->name('send.start.cooking.notification');
    
    // Messages
    Route::get('users.messages.index', [MessageController::class, 'index'])->name('users.messages.index');
    Route::post('users.messages.index', [MessageController::class, 'store'])->name('users.messages.store');
    Route::get('users/messages/create', [MessageController::class, 'create'])->name('users.messages.create');
    Route::get('users/messages/{message}', [MessageController::class, 'showUser'])->name('users.messages.show');

    // FAQ
    Route::get('users.faq.index', FaqController::class)->name('users.faq.index');

    // About
    Route::get('users.about.index', AboutController::class)->name('users.about.index');

    // Terms
    Route::get('users.terms.index', TermsController::class)->name('users.terms.index');

    // Cook Table Routes
    Route::get('users.cook_table.index', [MealPlanController::class, 'create'])->name('users.cook_table.index');
    Route::post('/meal-plans', [MealPlanController::class, 'store'])->name('meal_plans.store');
    Route::get('meal-plans.{id}', [MealPlanController::class, 'show'])->name('meal_plans.show');
    Route::delete('/meal-plans/{mealPlanId}/{date}/{type}', [MealPlanController::class, 'destroyDay'])->name('meal_plans.destroy_day');
    Route::get('/meal-plans/{id}/edit', [MealPlanController::class, 'edit'])->name('meal_plans.edit');
    Route::put('/meal-plans/{id}', [MealPlanController::class, 'update'])->name('meal_plans.update');

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
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
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
