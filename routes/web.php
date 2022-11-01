<?php

use App\Http\Middleware\EnsureWaiter;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureCashier;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\OrdersController;

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

Route::get('/',[ViewController::class, 'home']);

Route::get('/records/{order_number}',[OrdersController::class, 'show'])->middleware('auth');

Route::get('/activities',[ViewController::class, 'logs'])->middleware('auth');

Route::get('/waiter/{order_number}/edit',[OrdersController::class, 'edit'])->middleware('auth');

Route::put('/waiter/{order_number}/update',[OrdersController::class, 'update'])->middleware('auth');

Route::get('/invalid-input',[ViewController::class, 'invalid_input'])->middleware('auth');

Route::get('/waiter/order-created',[ViewController::class,'order_created'])->middleware('auth');

Route::get('/waiter', [ViewController::class, 'waiter'])->middleware(EnsureWaiter::class);

Route::get('/login', [UserController::class, 'login']);

Route::post('/authenticate', [UserController::class, 'auth']);

Route::post('/logout',[UserController::class,'logout'])->middleware('auth');

Route::post('/waiter/store',[OrdersController::class,'store'])->middleware(EnsureWaiter::class);
