<?php

use App\Http\Controllers\ApiHistoryController;
use App\Http\Controllers\ApiTesterController;
use Illuminate\Support\Facades\Route;

Route::get('/wokaapi', function () {
    return view('wokaapi');
})->name('wokaapi.page');