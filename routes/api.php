<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

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

/* 
Route::get('/transaction', [TransactionController::class, 'index']);
Route::post('/transaction', [TransactionController::class, 'store']);
Route::get('/transaction/{id}', [TransactionController::class, 'show']);
Route::put('/transaction/{id}', [TransactionController::class, 'update']);
Route::delete('/transaction/{id}', [TransactionController::class, 'destroy']); 
*/

/*
Secara default method Route::resource('user', UserController::class); akan mengikuti method" yang dihasilkan
saat make controller
*/
Route::resource('/transaction', TransactionController::class)->except(['create','edit']);
