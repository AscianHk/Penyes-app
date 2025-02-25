<?php

use App\Http\Controllers\DrawsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/draw/{year}', [DrawsController::class, 'getData']);
    Route::post('/draw', [DrawsController::class, 'draw']);
    Route::post('/deletedraw', [DrawsController::class, 'deleteDraw']);
});