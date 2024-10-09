<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('customers', CustomerController::class);

Route::middleware(['web'])->group(function () {
    Route::post('/transaction/start', [TransactionController::class, 'startTransaction']);
    Route::post('/transaction/update', [TransactionController::class, 'updateTransactionStep']);
    Route::post('/transaction/complete', [TransactionController::class, 'completeTransaction']);
    Route::post('/transaction/cancel', [TransactionController::class, 'cancelTransaction']);
    Route::get('/transaction/status', [TransactionController::class, 'checkTransactionStatus']);
});
