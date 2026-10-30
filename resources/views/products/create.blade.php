@extends('layouts.app')

@section('title', 'Iets aanbieden')

@section('content')
    <div class="max-w-xl mx-auto bg-white border border-stone-200 rounded-xl p-6">
        <h1 class="text-2xl font-bold mb-1">Iets aanbieden</h1>
        <p class="text-stone-600 mb-6">Zet iets online dat je wilt uitlenen. Anderen kunnen het daarna meteen reserveren.</p>
        <form method="POST" action="{{ route('products.store') }}" class="space-y-4">
            @csrf
            <label class="block">
                <span class="label">Naam</span>
                <input name="name" value="{{ old('name') }}" class="input" placeholder="Bijvoorbeeld: Statafel" required>
            </label>
            <label class="block">
                <span class="label">Beschrijving</span>
                <textarea name="description" rows="3" class="input" placeholder="Wat is het, en waar moet iemand op letten?">{{ old('description') }}</textarea>
            </label>
            <label class="block">
                <span class="label">Prijs per dag (€)</span>
                <input name="price" type="number" step="0.50" min="0" value="{{ old('price', '5.00') }}" class="input" required>
            </label>
            @if ($errors->any())
                <p class="text-sm text-red-600">{{ $errors->first() }}</p>
            @endif
            <button class="btn-primary">Online zetten</button>
        </form>
    </div>
@endsection
