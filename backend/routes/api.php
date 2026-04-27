<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MetricsController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/metrics', [MetricsController::class, 'index']);

Route::get('/fail', function () {
    abort(500);
});

Route::middleware('auth:api')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);

    Route::apiResource('applications', ApplicationController::class);

});
