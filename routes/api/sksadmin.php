<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use \App\Http\Controllers\SksAdminController;
use \App\Http\Controllers\FacilityController;
use App\Http\Controllers\AcademicalPersonalController;
use \App\Http\Controllers\CommunityController;
use \App\Http\Controllers\ReservationController;
use \App\Http\Controllers\StudentController;

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
Route::post('sksadmin/signup', [SksAdminController::class, 'addSksAdmin'])->name('addSksAdmin');
Route::post('sksadmin/login', [AuthController::class, 'login'])->name('login');
Route::group(['prefix' => 'sksadmin', 'middleware' => ['auth:sksadmin-api', 'scopes:sksadmin']], function () {
    //Community
    Route::get('community', [CommunityController::class, 'getCommunities'])->name('getCommunities');
    Route::get('community/{id}', [CommunityController::class, 'getCommunity'])->name('getCommunity');
    Route::post('community', [CommunityController::class, 'addCommunity'])->name('addCommunity');
    Route::put('community/{id}', [CommunityController::class, 'setCommunity'])->name('setCommunity');
    Route::delete('community/{id}', [CommunityController::class, 'deleteCommunity'])->name('deleteCommunity');
    //Reservation
    Route::get('reservation',[ReservationController::class, 'getReservations'])->name('getReservations');
    Route::get('reservation/{id}',[ReservationController::class, 'getReservation'])->name('getReservation');
    Route::delete('reservation',[ReservationController::class, 'deleteReservation'])->name('deleteReservation');
    //Facility
    Route::get('facility', [FacilityController::class, 'getFacilities'])->name('getFacilities');
    Route::get('facility/{id}', [FacilityController::class, 'getFacility'])->name('getFacility');
    Route::post('facility', [FacilityController::class, 'addFacility'])->name('addFacility');
    Route::put('facility/{id}', [FacilityController::class, 'setFacility'])->name('setFacility');
    Route::delete('facility/{id}', [FacilityController::class, 'deleteFacility'])->name('deleteFacility');
    //Academical Personal
    Route::get('academical', [AcademicalPersonalController::class, 'getAcademicalPersonals'])->name('getAcademicalPersonals');
    Route::get('academical/{id}', [AcademicalPersonalController::class, 'getAcademicalPersonal'])->name('getAcademicalPersonal');
    Route::post('academical', [AcademicalPersonalController::class, 'addAcademicalPersonal'])->name('addAcademicalPersonal');
    Route::put('academical/{id}', [AcademicalPersonalController::class, 'setAcademicalPersonal'])->name('setAcademicalPersonal');
    Route::delete('academical/{id}', [AcademicalPersonalController::class, 'deleteAcademicalPersonal'])->name('deleteAcademicalPersonal');
    //getStudent
    Route::get('student', [StudentController::class, 'getStudents'])->name('getStudents');
    Route::get('student/{id}', [StudentController::class, 'getStudent'])->name('getStudent');
    //Guesthouse
    /*Route::get('guesthouse', [GuesthouseController::class, 'getGuesthouses'])->name('getGuesthouses');
    Route::get('guesthouse/{id}', [GuesthouseController::class, 'getGuesthouse'])->name('getGuesthouse');
    Route::post('guesthouse', [GuesthouseController::class, 'addGuesthouse'])->name('addGuesthouse');
    Route::put('guesthouse/{id}', [GuesthouseController::class, 'setGuesthouse'])->name('setGuesthouse');
    Route::delete('guesthouse/{id}', [GuesthouseController::class, 'deleteGuesthouse'])->name('deleteGuesthouse');*/
    //logout
    Route::get('logout',[AuthController::class, 'logout'])->name('logout');
});
