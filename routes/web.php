<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ContractsController;
use App\Http\Controllers\CalcluatorController;
use App\Http\Controllers\SignPDFController;
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

Route::get('/customers', [CustomersController::class, 'index'])->name('customers');
Route::get('/customers/create', [CustomersController::class, 'create']);
Route::get('/customers/{customer}', [CustomersController::class, 'show']);
Route::get('/customers/{customer}/delete', [CustomersController::class, 'destroy']);
Route::post('/customers', [CustomersController::class, 'store'])->name('customers');
Route::get('/customers/{customer}/edit', [CustomersController::class, 'edit']);
Route::put('/customers/{customer}', [CustomersController::class, 'update']);
Route::get('/customers/{customer}/contracts', [CustomersController::class, 'contracts']);

Route::put('/contracts/{contract_id}', [ContractsController::class, 'update']);
Route::get('/contracts/{contract_id}/edit', [ContractsController::class, 'edit']);
Route::get('/contracts/{customer}', [ContractsController::class, 'index'])->name('all_contracts');
Route::get('/contracts/{customer}/create', [ContractsController::class, 'create']);
Route::get('/contracts/{contract}/delete', [ContractsController::class, 'destory']);
Route::get('/contracts/signPDF/{contract}', [SignPDFController::class, 'getPDF']);
Route::get('/contracts/mailPDF/{contract}', [SignPDFController::class, 'mailPDF']);
Route::get('/signedPDFs', [SignPDFController::class, 'signedPDF']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
