<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReservationController;

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

Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::middleware('guest')->group(function () {
    Route::get('/inloggen', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/inloggen', [AuthController::class, 'login']);
    Route::get('/registreren', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/registreren', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/uitloggen', [AuthController::class, 'logout'])->name('logout');
    Route::get('/producten/nieuw', [ProductController::class, 'create'])->name('products.create');
    Route::post('/producten', [ProductController::class, 'store'])->name('products.store');
    Route::patch('/producten/{product}/beschikbaar', [ProductController::class, 'toggle'])->name('products.toggle');
    Route::post('/producten/{product}/reserveren', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/mijn-reserveringen', [ReservationController::class, 'index'])->name('reservations.index');
    Route::delete('/reserveringen/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});

Route::get('/producten/{product}', [ProductController::class, 'show'])->name('products.show');
