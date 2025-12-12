<?php

use Illuminate\Support\Facades\Route;

Route::get('/wokaapi', function () {
    return view('wokaapi');
})->name('wokaapi.page');