<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Payment\PaymentStatusController;
use App\Http\Controllers\PaymentStore\PaymentStoreController;
use App\Http\Controllers\Refund\RefundController;
use App\Http\Controllers\Refund\RefundStatus;
use App\Http\Controllers\Refund\RefundPrepareController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::post('/payment', [PaymentController::class, 'store'])->name('payment');

Route::get('/paymentstatus', [PaymentStatusController::class, 'index'])->name('paymentstatus');

Route::get('/paymentview', [PaymentStoreController::class, 'index'])->name('paymentview');

Route::get('/refund', [RefundPrepareController::class,'index'])->name('refund');

Route::post('/processrefund', [RefundController::class, 'store'])->name('processrefund');

Route::get('/refundstatus',[RefundStatus::class,'index'])->name('refundstatus');

Route::get('/payment', function () {
    //return view('welcome');
    return view('payment.index');

});
