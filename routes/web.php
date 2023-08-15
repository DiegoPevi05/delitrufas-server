<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminServiceController;
use App\Http\Controllers\AdminDiscountCodeController;
use App\Http\Controllers\AdminSpecialistController;
use App\Http\Controllers\AdminSpecialistTimesController;
use App\Http\Controllers\AdminMeetController;
use App\Http\Controllers\Calendar;
use App\Http\Controllers\AdminMeetHistoryController;
use App\Http\Controllers\ZoomController;
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

    Route::resource('calendars',Calendar::class);


    Route::middleware('role:' . User::ROLE_MODERATOR . ',' . User::ROLE_ADMIN)->group(function () {
        Route::resource('services', AdminServiceController::class);
        Route::resource('discountcodes', AdminDiscountCodeController::class);
        Route::resource('specialists', AdminSpecialistController::class);
        Route::resource('specialiststimes', AdminSpecialistTimesController::class);
        Route::resource('meets',AdminMeetController::class);
        Route::resource('meethistories',AdminMeetHistoryController::class);
        Route::resource('zooms',ZoomController::class);
        Route::get('/search-users',[UserController::class,'searchByName']);
        Route::get('/search-services',[AdminServiceController::class,'searchByName']);
        Route::get('/search-services-specialist',[AdminServiceController::class,'searchBySpecialist']);
        Route::get('/search-specialists',[AdminSpecialistController::class,'searchByName']);
        Route::get('/search-discounts',[AdminDiscountCodeController::class,'searchByName']);
    });

    Route::middleware('role:' . User::ROLE_ADMIN)->group(function () {
        Route::resource('users', UserController::class);
    });


});

Route::get('validate-zoom-token', [ZoomController::class, 'callBackZoomUri']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('recover-password', [AuthController::class, 'showRecoverPasswordForm'])->name('recover-password');
Route::post('recover-password', [AuthController::class, 'recoverPassword']);
