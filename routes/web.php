<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ExportPaymentController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return redirect()->route('accounts.index');
});

Route::prefix('account')->group(function () {
    Route::resource('accounts', AccountController::class);
    Route::get('info/{account}', [AccountController::class, 'accountInfo'])->name('account-info');
});

Route::prefix('payment')->group(function () {
    Route::resource('payments', PaymentController::class);
    Route::post('add-transaction', [PaymentController::class, 'addTransaction'])->name('add-transaction');
    // EXPORT
    Route::get('payment-export/{payment_id}', [ExportPaymentController::class, 'export'])->name('payment-export');
});

// DELATE ROUTES
Route::post('/del-transaction', [PaymentController::class, 'delTransaction'])->name('del-transaction');
Route::post('/del-payment', [PaymentController::class, 'delPayment'])->name('del-payment');
Route::post('/del-account', [AccountController::class, 'delAccount'])->name('del-account');

// SET PAYMENT STATUS
Route::post('/set-payment-status', [PaymentController::class, 'setPaymentStatus'])->name('set-payment-status');
