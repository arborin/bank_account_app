<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportPaymentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
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


Route::middleware(['auth', 'prevent-back-button'])->group(
    function () {
        Route::get('/', function () {
            return redirect()->route('dashboard-info');
        });


        Route::prefix('user')->group(
            function () {
                Route::resource('users', UserController::class);
            }
        );

        Route::prefix('dashboard')->group(function () {
            Route::get('info', [DashboardController::class, 'info'])->name('dashboard-info');
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
            // PRINT PAGE
            Route::get('transaction-print/{payment_id}', [PaymentController::class, 'printTransactions'])->name('print-transactions');
        });


        // DELATE ROUTES
        Route::post('/del-transaction', [PaymentController::class, 'delTransaction'])->name('del-transaction');
        Route::post('/del-payment', [PaymentController::class, 'delPayment'])->name('del-payment');
        Route::post('/del-account', [AccountController::class, 'delAccount'])->name('del-account');
        Route::post('/del-user', [UserController::class, 'delUser'])->name('del-user');

        // SET PAYMENT STATUS
        Route::post('/set-payment-status', [PaymentController::class, 'setPaymentStatus'])->name('set-payment-status');
    }
);


Route::group(['middleware' => 'prevent-back-button'], function () {
    // Login Routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Logout Route
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Auth::routes();
