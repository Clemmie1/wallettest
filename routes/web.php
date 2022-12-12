<?php

use App\Http\Controllers\RotesController;
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

Route::get('/', [RotesController::class, 'index']);
Route::get('/payment', [RotesController::class, 'indexPayment']);
Route::get('/cards', [RotesController::class, 'indexCreditCard']);

Route::get('/login', [RotesController::class, 'AuthLogin']);
Route::get('/logout', [RotesController::class, 'AuthLogout']);
Route::get('/walletClosed', [RotesController::class, 'AuthWalletClosed']);
Route::get('/register', [RotesController::class, 'AuthRegister']);


Route::get('/confirm', [RotesController::class, 'AuthConfirm']);
Route::get('/confirm/{ConfirmKey}', [RotesController::class, 'ConfirmKey']);
