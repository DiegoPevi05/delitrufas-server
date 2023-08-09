<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminServiceController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth'])->group(function () {

    Route::post('logout',[AuthController::class, 'logout'])->name('logout');

    Route::get('/', function () {return view('home');})->name('home');

    Route::middleware('role:' . User::ROLE_MODERATOR . ',' . User::ROLE_ADMIN)->group(function () {
        Route::resource('services', AdminServiceController::class);
    });

    Route::middleware('role:' . User::ROLE_ADMIN)->group(function () {
        Route::resource('users', UserController::class);
    });

});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('recover-password', [AuthController::class, 'showRecoverPasswordForm'])->name('recover-password');
Route::post('recover-password', [AuthController::class, 'recoverPassword']);
