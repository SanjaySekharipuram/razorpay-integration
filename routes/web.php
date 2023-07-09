<?php

use App\Http\Controllers\RazorpayController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/payment', [RazorpayController::class, 'formPage'])->name('payment');
Route::post('/make-order', [RazorpayController::class, 'makeOrder'])->name('make.order');
Route::get('/pay', [RazorpayController::class, 'pay'])->name('pay');