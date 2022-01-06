<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AcademicalPersonalController;
use \App\Http\Controllers\FacilityController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('academicalpersonal/login',[AuthController::class, 'login'])->name('login');
Route::post('academicalpersonal/signup',[AcademicalPersonalController::class, 'addAcademicalPersonal'])->name('addAcademicalPersonal');
Route::group( ['prefix' => 'academicalpersonal','middleware' => ['auth:academicalpersonal-api','scopes:academicalpersonal'] ],function(){
    //Guesthouse
    //Route::get('guesthouse', [GuesthouseController::class, 'getGuesthouses'])->name('getGuesthouses');
    //Route::get('guesthouse/{id}', [GuesthouseController::class, 'getGuesthouse'])->name('getGuesthouse');
    //Route::post('guesthouse', [GuesthouseController::class, 'addGuesthouse'])->name('addGuesthouse');
    //Route::put('guesthouse/{id}', [GuesthouseController::class, 'setGuesthouse'])->name('setGuesthouse');
    //Route::delete('guesthouse/{id}', [GuesthouseController::class, 'deleteGuesthouse'])->name('deleteGuesthouse');
    //Reservation
    Route::get('reservation',[ReservationController::class, 'getReservations'])->name('getReservations');
    Route::get('reservation/{id}',[ReservationController::class, 'getReservation'])->name('getReservation');
    Route::post('reservation',[ReservationController::class, 'addReservation'])->name('addBasketballReservation');
    Route::put('reservation/{id}',[ReservationController::class, 'setReservation'])->name('setReservation');
    Route::delete('reservation/{id}',[ReservationController::class, 'deleteReservation'])->name('deleteReservation');
    //Hour
    Route::post('reservation-hour',[ReservationController::class, 'getReservationHour'])->name('getReservationHour');
    //Logout
    Route::get('logout',[AuthController::class, 'logout'])->name('logout');
    //getFacility
    Route::get('facility',[FacilityController::class, 'getFacilities'])->name('getFacilities');
    Route::get('facility/{id}',[FacilityController::class, 'getFacility'])->name('getFacility');

});
