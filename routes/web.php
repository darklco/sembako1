<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\user\KasirController;
use App\Http\Controllers\user\UsersProductsController;
use App\Http\Controllers\DashboardController;

// =======================
// AUTH ADMIN
// =======================
Route::prefix('admin')->name('admin.')->group(function () {

    // login
    Route::get('/login', [UserController::class, 'showLogin'])->name('login');

    Route::post('/login', [UserController::class, 'login'])->name('login.process');

    // dashboard
   Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // Transaksi
    Route::post('/transaction', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transaction/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');

      // products CRUD
    Route::resource('products', ProductsController::class)->middleware('auth');
});

// |-----------------
// | USER / KASIR
// |-----------------
Route::prefix('users')->name('users.')->group(function () {

    Route::get('/', [KasirController::class, 'index'])->name('index');

    Route::get('/riwayat', [TransactionController::class, 'riwayatKasir'])->name('riwayat');

    Route::get('/pembayaran', [KasirController::class, 'pembayaran'])->name('pembayaran');
   
    Route::get('/products', [UsersProductsController::class, 'index'])->name('products');
    Route::get('/products/{product}', [UsersProductsController::class, 'show']) ->name('showproducts');

    Route::get('/transaction/{id}', [TransactionController::class, 'detail'])->name('detail');

    Route::get('/transaction/{id}/print', [TransactionController::class, 'print'])->name('print');

    Route::post('/transaction', [TransactionController::class, 'store']) ->name('transaction.store');
});
