<?php

use App\Http\Controllers\ApiHistoryController;
use App\Http\Controllers\ApiTesterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Send API Request
Route::post('/send', [ApiTesterController::class, 'send']);

// History
Route::get('/history', [ApiHistoryController::class, 'index']);
Route::get('/history/{id}', [ApiHistoryController::class, 'show']);
Route::delete('/history/{id}', [ApiHistoryController::class, 'destroy']);
Route::delete('/history', [ApiHistoryController::class, 'clear']);