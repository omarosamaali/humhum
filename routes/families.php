<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\FamilyController;
use App\Http\Controllers\Family\WelcomeController;
use App\Http\Controllers\Family\ProfileController;
use App\Http\Controllers\Family\MealFamilyController;
use App\Http\Controllers\Family\SpecialFamilyController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\AuthenticatedSessionController;

// Create Special request
Route::get('families.special.index', [SpecialFamilyController::class, 'index'])->name('families.special.index');
Route::get('families.special.create', [SpecialFamilyController::class, 'create'])->name('families.special.create');
Route::post('families.special.store', [SpecialFamilyController::class, 'store'])->name('families.special.store');
Route::get('families.special.show.{id}', [SpecialFamilyController::class, 'show'])->name('families.special.show');
Route::get('/families/meals/load-more', [SpecialFamilyController::class, 'loadMoreMeals'])
        ->name('families.meals.load-more');

// Family Login Routes
Route::get('family_members.login.{family_number?}.{member_id?}', [FamilyController::class, 'family_login'])->name('family_members.login');
Route::post('users/family_members.login', [FamilyController::class, 'family_login_post'])->name('family_members.login.post');
Route::get('families.welcome', [WelcomeController::class, 'index'])->name('families.welcome');

// Family Routes
Route::get('families.profile.index', [ProfileController::class, 'index'])->name('families.profile.index');
Route::get('families.family.index', [ProfileController::class, 'family'])->name('families.family.index');
Route::get('families.cooks.index', [ProfileController::class, 'cooks'])->name('families.cooks.index');
Route::get('families.blocked.index', [ProfileController::class, 'blocked'])->name('families.blocked.index');
Route::get('families.meals.index', [MealFamilyController::class, 'index'])->name('families.meals.index');
Route::get('families.meals.show.{id}', [MealFamilyController::class, 'show'])->name('families.meals.show');
Route::get('families.meals.view-meal.{id}', [MealFamilyController::class, 'viewMeal'])->name('families.meals.view-meal');
Route::get('families.meals.view-meal-lunch.{id}', [MealFamilyController::class, 'viewMealLunch'])->name('families.meals.view-meal-lunch');
Route::get('families.meals.view-meal-dinner.{id}', [MealFamilyController::class, 'viewMealDinner'])->name('families.meals.view-meal-dinner');
Route::get('families/meals/show-meal/{id}', [MealFamilyController::class, 'showMeal'])->name('families.meals.show-meal');

Route::get('families.meals.ingredients.{id}', [MealFamilyController::class, 'ingredients'])->name('families.meals.ingredients');
Route::get('families.meals.steps.{id}', [MealFamilyController::class, 'steps'])->name('families.meals.steps');
Route::post('families.recipe.complete-step', [MealFamilyController::class, 'completeStep'])->name('recipe.complete-step');
Route::post('families.recipe.reset-steps', [MealFamilyController::class, 'resetSteps'])->name('recipe.reset-steps');
Route::get('families.meals.facts.{id}', [MealFamilyController::class, 'facts'])->name('families.meals.facts');
Route::get('families.meals.families.{id}', [MealFamilyController::class, 'families'])->name('families.meals.families');
Route::post('/send-unavailable-notification-family', [NotificationController::class, 'sendUnavailableNotificationFamily'])
->name('send.unavailable.notification-family');
Route::get('families.notifications.index', [ProfileController::class, 'notifications'])->name('families.notifications.index');
