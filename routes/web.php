<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\user\KasirController;

// =======================
// AUTH ADMIN
// =======================
Route::prefix('admin')->name('admin.')->group(function () {

    // login
    Route::get('/login', [UserController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [UserController::class, 'login'])
        ->name('login.process');

    // dashboard
   Route::get('/', [ProductsController::class, 'index'])
    ->middleware('auth')
    ->name('index');

    // logout
    Route::post('/logout', [UserController::class, 'logout'])
        ->name('logout');

    // products CRUD
    Route::resource('products', ProductsController::class)
        ->middleware('auth');

    // Transaksi
    Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');
    Route::get('/transaction/{transaction}', [TransactionController::class, 'show'])->name('transaction.show');
});

// |-----------------
// | USER / KASIR
// |-----------------
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [KasirController::class, 'index'])->name('index');
    Route::get('/riwayat', [KasirController::class, 'riwayat'])->name('riwayat');
    Route::get('/pembayaran', [KasirController::class, 'pembayaran'])->name('pembayaran');
    
   
    Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
});