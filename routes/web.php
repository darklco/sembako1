<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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

// Route::resource('products', ProductsController::class);

// Route::get('/', function () {
//     return view('admin.index');
// });

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductsController::class);
});