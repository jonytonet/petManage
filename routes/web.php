<?php

use App\Http\Controllers\Web\CustomersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/customers-management', [CustomersController::class, 'index'])->name('customers.management');

    Route::get('/bath-and-grooming-management', function () {
        return view('bath_and_grooming.index');
    })->name('bathAndGrooming.management');

    Route::get('/dayCare-management', function () {
        return view('dayCare.index');
    })->name('dayCare.management');

    Route::get('/clinic-management', function () {
        return view('clinic.index');
    })->name('clinic.management');

    Route::get('/financial-management', function () {
        return view('financial.index');
    })->name('financial.management');
    Route::get('/pet-management', function () {
        return view('pet.index');
    })->name('pet.management');
});
