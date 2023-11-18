<?php

use App\Enums\ProviderEnum;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\Web\UserCreateController;
use App\Http\Controllers\Web\UserLoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [WeatherController::class, 'getWeather'])
    ->middleware(['auth'])
    ->name('web.home');

Route::get('/login', [UserLoginController::class, 'loginView'])->name('login');

Route::post('/login', [UserLoginController::class, 'login'])->name('web.login');
Route::get('/logout', [UserLoginController::class, 'logout'])->name('logout');
Route::get('/register', [UserCreateController::class, 'register'])->name('register');
Route::post('/register/{provider}', [UserCreateController::class, 'provider'])
    ->whereIn('provider', ProviderEnum::toArray())->name('web.register');
Route::get('/google/redirect', [UserCreateController::class, 'google'])->name('google.redirect');
Route::get('/google/callback', [UserCreateController::class, 'googleCallback'])->name('google.callback');
