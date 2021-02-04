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

//Buy Page
Route::get('/buy', [App\Http\Controllers\HomeController::class, 'buy'])->name('Buy');
Route::post('/buy/{status}/{id}', [App\Http\Controllers\HomeController::class, 'addStock'])->name('AddStock');

//Not Left Page
Route::get('/notleft', [App\Http\Controllers\HomeController::class, 'notLeft'])->name('NotLeft');

//Debt List Page
Route::get('/debtlist', [App\Http\Controllers\HomeController::class, 'debtList'])->name('DebtList');

//Expire Page
Route::get('/expire', [App\Http\Controllers\HomeController::class, 'expire'])->name('Expire');

//Seller Page
Route::get('/seller', [App\Http\Controllers\HomeController::class, 'seller'])->name('Seller');

//Sale Page
Route::get('/sale', [App\Http\Controllers\HomeController::class, 'sale'])->name('sale');
Route::post('/sale', [App\Http\Controllers\HomeController::class, 'getSale'])->name('sale');
Route::post('/viewtb', [App\Http\Controllers\HomeController::class, 'viewtb'])->name('viewtb');
Route::post('/undo', [App\Http\Controllers\HomeController::class, 'undo'])->name('undo');
