<?php

use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {return view('dashboard');})->name('/');
Route::get('/', [DashboardController::class, 'index'])->name('/');
Route::resource('productos', ProductsController::class);
Route::resource('clientes', CustomersController::class);
Route::resource('ventas', SalesController::class);