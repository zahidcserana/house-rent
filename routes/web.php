<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FlatController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {

    Route::resource('user', UserController::class);
    Route::get('user-list', [UserController::class, 'userList'])->name('users.list');

    Route::resource('house', HouseController::class);
    Route::resource('flat', FlatController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('role', RoleController::class);
    Route::resource('invoice', InvoiceController::class);
    Route::get('invoice/{direct_url}', [InvoiceController::class, 'view'])->name('invoice.direct_url');

    Route::get('customer/flat/{customer}', [CustomerController::class, 'customerFlat'])->name('customer.flat');
    Route::get('/search/customer', [SearchController::class, 'searchCustomer'])->name('search.customer');

    Route::get('change-password', [UserController::class, 'changePassword'])->name('changePassword');
    Route::post('updatePassword', [UserController::class, 'updatePassword'])->name('updatePassword');
});

Route::fallback(function () {
    return view('error');
});
