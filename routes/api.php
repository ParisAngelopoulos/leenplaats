<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Reservation;

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

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
        'user' => $user
    ]);
});

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $request->user()->tokens()->delete();
    return response()->json(['message' => 'Uitgelogd']);
});

Route::middleware('auth:sanctum')->post('/reserve', function (Request $request) {
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date'
    ]);

    $product = Product::find($request->product_id);

    if (!$product->is_available) {
        return response()->json(['message' => 'Product niet beschikbaar'], 400);
    }

    Reservation::create([
        'product_id' => $product->id,
        'user_id' => $request->user()->id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ]);

    $product->is_available = 0;
    $product->save();

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
