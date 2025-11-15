<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chef\LoginChefController;
use App\Http\Controllers\Chef\RequestsController;

Route::get('chef.login.{cook_number?}.{cook_id?}', [LoginChefController::class, 'login'])
    ->name('chef.auth.login');
Route::post('chef/login', [LoginChefController::class, 'store'])
    ->name('chef.auth.store');
Route::get('chefs/welcome', [RequestsController::class, 'index'])->name('chefs.welcome');
Route::get('families.meals.index', [RequestsController::class, 'show'])->name('families.meals.index');
Route::get('chefs/special-requests', [RequestsController::class, 'specialRequests'])
    ->name('chefs.special-requests');