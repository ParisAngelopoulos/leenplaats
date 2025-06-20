<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/producten', function () {

    return response()->json([
        'producten' => [
            ['product_id' => 1, 'product_name' => 'Product A', 'price' => 100.00],
            ['product_id' => 2, 'product_name' => 'Product B', 'price' => 150.00],
        ]
    ]);

});
