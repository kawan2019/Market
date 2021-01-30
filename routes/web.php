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

//casher page
Route::get('/casher', [App\Http\Controllers\HomeController::class, 'casher'])->name('casher');
Route::post('/casher', [App\Http\Controllers\HomeController::class, 'AddCasher'])->name('AddCashier');

//Supplier Page
Route::get('/supplier', [App\Http\Controllers\HomeController::class, 'supplier'])->name('supplier');
Route::post('/supplier/{status}/{id}', [App\Http\Controllers\HomeController::class, 'AddSupplier'])->name('AddSupplier');