<?php

use App\Enums\ProviderEnum;
use App\Http\Controllers\Api\UserCreateController;
use App\Http\Controllers\Api\UserLoginController;
use App\Http\Controllers\Api\WeatherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/home', [WeatherController::class, 'getWeather'])
    ->middleware(['auth:api'])
    ->name('api.home');

Route::post('/login', UserLoginController::class)->name('api.login');
Route::post('/register/{provider}', [UserCreateController::class, 'provider'])
    ->whereIn('provider', ProviderEnum::toArray())->name('api.register');
Route::get('/google/redirect', [UserCreateController::class, 'google'])->name('google.api.redirect');
Route::get('/google/callback', [UserCreateController::class, 'googleCallback'])->name('google.api.callback');
