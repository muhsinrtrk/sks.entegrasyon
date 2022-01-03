<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SksAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
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
Route::post('superadmin/login',[AuthController::class, 'login'])->name('login');
Route::post('superadmin/signup', [SuperAdminController::class, 'superAdminSignUp'])->name('superAdminSignUp');
Route::group( ['prefix' => 'superadmin','middleware' => ['auth:superadmin-api','scopes:superadmin'] ],function(){
    //SksAdmin
    Route::get('admin', [SksAdminController::class, 'getSksAdmins'])->name('getSksAdmins');
    Route::get('admin/{id}', [SksAdminController::class, 'getSksAdmin'])->name('getSksAdmin');
    Route::post('admin', [SksAdminController::class, 'addSksAdmin'])->name('sksAdminSignUp');
    Route::put('admin/{id}', [SksAdminController::class, 'setSksAdmin'])->name('setSksAdmin');
    Route::delete('admin/{id}', [SksAdminController::class, 'deleteSksAdmin'])->name('deleteSksAdmin');
});
