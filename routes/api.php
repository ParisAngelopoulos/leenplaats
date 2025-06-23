<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/producten', function () {
    $producten = Product::all()->map(function ($product) {
        return [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'price' => $product->price
        ];
    });

    return response()->json([
        'producten' => $producten
    ]);
});
