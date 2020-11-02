<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ContractsController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/customers', [CustomersController::class, 'index']);
Route::post('/customers', [CustomersController::class, 'store']);
Route::get('/customers/create', [CustomersController::class, 'create']);
Route::get('/customers/{customer}', [CustomersController::class, 'show']);
Route::get('/customers/{customer}/edit', [CustomersController::class, 'edit']);
Route::put('/customers/{customer_id}', [CustomersController::class, 'update']);
Route::get('/customers/{customer}/contracts', [CustomersController::class, 'contracts']);
Route::get('/contracts/', [ContractsController::class, 'index']);
Route::get('/contracts/create', [ContractsController::class, 'create']);
Route::get('/contracts/{contract}/delete', [ContractsController::class, 'destory']);
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
