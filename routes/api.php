<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Reservation;

Route::middleware('auth:sanctum')->post('/reserveer', function (Request $request) {
    $request->validate([
        'product_id' => 'required|exists:products,id'
    ]);

    $product = Product::findOrFail($request->product_id);

    if (!$product->is_available) {
        return response()->json(['message' => 'Product is al uitgeleend'], 409);
    }

    Reservation::create([
        'product_id' => $product->id,
        'user_id' => $request->user()->id,
        'start_date' => now(),
        'end_date' => now()->addDays(7) // voorbeeld
    ]);

    $product->update(['is_available' => false]);

    return response()->json(['message' => 'Product succesvol gereserveerd']);
});


Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json(['token' => $token]);
});

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Ongeldige inloggegevens'], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json(['token' => $token]);
});

Route::get('/producten', function () {
    return response()->json([
        'producten' => Product::all()
    ]);
});

Route::get('/producten', function (Request $request) {
    $query = \App\Models\Product::query();

    if ($request->has('postcode')) {
        $query->where('postcode', $request->input('postcode'));
    }
    return $query->get();
});

Route::post('/producten', function (Request $request) {
    $product = Product::create($request->all());
    return response()->json($product);
});
