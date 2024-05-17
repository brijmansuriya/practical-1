<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/order', [OrderController::class, 'create'])->name('order.create');
    Route::post('/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/view/{id}', [OrderController::class, 'view'])->name('order.view');
});

// // php artisan make:model Product -mc
// // php artisan make:model Order -mfsc