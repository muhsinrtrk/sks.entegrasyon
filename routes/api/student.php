<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use \App\Http\Controllers\ReservationController;
use \App\Http\Controllers\CommunityController;
use \App\Http\Controllers\StudentController;
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
Route::post('student/signup',[StudentController::class, 'studentSignUp'])->name('studentSignUp');
Route::post('student/login',[AuthController::class, 'login'])->name('login');

Route::group( ['prefix' => 'student','middleware' => ['auth:student-api','scopes:student'] ],function(){
    Route::get('student/logout',[AuthController::class, 'studentLogout'])->name('studentLogout');
    //Reservation
    Route::get('reservation',[ReservationController::class, 'getReservations'])->name('getReservations');
    Route::get('reservation/{id}',[ReservationController::class, 'getReservation'])->name('getReservation');
    Route::post('reservation',[ReservationController::class, 'addReservation'])->name('addBasketballReservation');
    Route::put('reservation/{id}',[ReservationController::class, 'setReservation'])->name('setReservation');
    Route::delete('reservation/{id}',[ReservationController::class, 'deleteReservation'])->name('deleteReservation');
    //Hour
    Route::get('reservation-hour',[ReservationController::class, 'getReservationHour'])->name('getReservationHour');
    //Community Katılama işlemleri ve düzenleme
    Route::post('joincommunity',[CommunityController::class, 'joinCommunityByStudent'])->name('joinCommunityByStudent');
    //getFacility
    Route::get('facility',[FacilityController::class, 'getFacilities'])->name('getFacilities');
    Route::get('facility/{id}',[FacilityController::class, 'getFacility'])->name('getFacility');

});
