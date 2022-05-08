<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('updatePay', [SalesController::class, 'updatePay'])->name('updatePay');
Route::put('changeCustomer/{id}', [SalesController::class, 'changeCustomer'])->name('changeCustomer');
Route::put('returnProduct/{id}', [SalesController::class, 'returnProduct'])->name('returnProduct');
Route::get('getCustomers', [SalesController::class, 'getCustomers'])->name('getCustomers');