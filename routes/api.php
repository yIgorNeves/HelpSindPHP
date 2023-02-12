<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BilletController;
use App\Http\Controllers\CondominiumController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarningController;

Route::get('/401', [AuthController::class, 'unauthorized'])->name('login');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::post('/auth/validate', [AuthController::class, 'validateToken']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    //Registro de ocorrencias
    Route::get('/warnings', [WarningController::class, 'getMyWarning']);
    Route::post('/warning', [WarningController::class, 'setWarning']);
    Route::post('/warning/file',[WarningController::class, 'setWarningFile']);

    //Boletos
    Route::get('/billets', [BilletController::class, 'getAll']);

    //Unidades
    Route::get('/unit/{id}', [UnitController::class, 'getInfo']);
    Route::post('/unit/{id}/addperson',[UnitController::class, 'addPerson']);
    Route::post('/unit/{id}/removeperson',[UnitController::class, 'removePerson']);

    //Reservas
    Route::get('/reservations', [ReservationController::class, 'getReservation']);
    Route::post('/myreservation',[ReservationController::class, 'getMyReservation']);

    Route::get('/reservation/{id}/disableddates',[ReservationController::class, 'getDisabledDates']);
    Route::get('/reservation/{id}/times', [ReservationController::class, 'getTimes']);

    Route::delete('/myreservation/{id}',[ReservationController::class, 'delMyReservation']);
    Route::post('/reservation/{id}',[ReservationController::class, 'setMyReservation']);

});

