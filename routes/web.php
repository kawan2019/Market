<?php

use Illuminate\Support\Facades\Route;




Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => false,
    'password.request' => false,
    'password.reset' => false,

]);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
