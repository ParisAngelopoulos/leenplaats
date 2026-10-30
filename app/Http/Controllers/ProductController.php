<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // All products with their upcoming reservations
    public function index()
    {
        $products = Product::with(['owner', 'upcomingReservations.user'])->orderBy('name')->get();

        return view('products.index', ['products' => $products]);
    }

    public function show(Product $product)
    {
        $product->load(['owner', 'upcomingReservations.user']);

        return view('products.show', ['product' => $product]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
            'price' => ['required', 'numeric', 'min:0', 'max:1000'],
        ]);

        $product = $request->user()->products()->create($data + ['is_available' => true]);

        return redirect()->route('products.show', $product)->with('status', 'Je product staat online. Anderen kunnen het nu reserveren.');
    }

    // Only the owner can switch a product between available and not available
    public function toggle(Request $request, Product $product)
    {
        abort_unless($product->user_id === $request->user()->id, 403);
        $product->update(['is_available' => !$product->is_available]);

        return back()->with('status', $product->is_available ? 'Je product is weer te leen.' : 'Je product is tijdelijk niet te leen.');
    }
}
