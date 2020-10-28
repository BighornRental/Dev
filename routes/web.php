<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;

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

// Route::get('/', function () {

//     return view('welcome');
// });

Route::get('/customers', [CustomersController::class, 'index']);
Route::post('/customers', [CustomersController::class, 'store']);
Route::get('/customers/create', [CustomersController::class, 'create']);
Route::get('/customers/{customer}', [CustomersController::class, 'show']);
Route::get('/customers/{customer}/edit', [CustomersController::class, 'edit']);
Route::put('/customers/{customer}/', [CustomersController::class, 'update']);
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
