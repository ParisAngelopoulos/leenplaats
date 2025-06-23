<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Illuminate\Http\Request;

Route::get('/producten', function () {
    return response()->json([
        'producten' => Product::all()
    ]);
});


Route::post('/producten', function (Request $request) {
    $product = Product::create($request->all());
    return response()->json($product);
});
