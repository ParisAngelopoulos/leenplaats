<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

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

// Overzicht van alle producten met hun komende reserveringen
Route::get('/', function () {
    $products = Product::with(['reservations' => fn ($q) => $q->where('end_date', '>=', now()->startOfDay())->orderBy('start_date'), 'reservations.user'])
        ->orderBy('name')
        ->get();

    return view('producten', ['products' => $products]);
});
