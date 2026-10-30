@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <a href="{{ route('products.index') }}" class="text-sm text-brand hover:underline">&larr; Alle spullen</a>

    <div class="mt-4 grid gap-6 md:grid-cols-5">
        <section class="md:col-span-3 bg-white border border-stone-200 rounded-xl p-6">
            <div class="flex items-start justify-between gap-4">
                <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
                <span class="text-brand text-xl font-semibold whitespace-nowrap">€ {{ number_format($product->price, 2, ',', '.') }} <span class="text-stone-500 font-normal text-base">/ dag</span></span>
            </div>
            <p class="text-stone-600 mt-3">{{ $product->description }}</p>
            @if ($product->owner)
                <p class="text-sm text-stone-500 mt-4">Aangeboden door <strong class="text-stone-700">{{ $product->owner->name }}</strong></p>
            @endif

            @auth
                @if ($product->user_id === auth()->id())
                    <form method="POST" action="{{ route('products.toggle', $product) }}" class="mt-4">
                        @csrf @method('PATCH')
                        <button class="btn-secondary">{{ $product->is_available ? 'Tijdelijk niet uitlenen' : 'Weer uitlenen' }}</button>
                    </form>
                @endif
            @endauth

            <h2 class="text-lg font-semibold mt-8 mb-3">Komende reserveringen</h2>
            @forelse ($product->upcomingReservations as $reservation)
                <div class="flex justify-between border-t border-stone-100 py-2 text-sm">
                    <span>{{ $reservation->start_date->format('d-m-Y') }} t/m {{ $reservation->end_date->format('d-m-Y') }}</span>
                    <span class="text-stone-500">{{ $reservation->user->name }}</span>
                </div>
            @empty
                <p class="text-sm text-stone-500">Nog niemand heeft dit gereserveerd.</p>
            @endforelse
        </section>

        <aside class="md:col-span-2 bg-white border border-stone-200 rounded-xl p-6 h-fit">
            <h2 class="text-lg font-semibold mb-4">Reserveren</h2>
            @if (!$product->is_available)
                <p class="text-stone-600">Dit product is op dit moment niet te leen.</p>
            @elseif (!auth()->check())
                <p class="text-stone-600 mb-4">Log in om dit product te reserveren.</p>
                <a href="{{ route('login') }}" class="btn-primary w-full text-center">Inloggen</a>
            @elseif ($product->user_id === auth()->id())
                <p class="text-stone-600">Dit is je eigen product.</p>
            @else
                <form method="POST" action="{{ route('reservations.store', $product) }}" class="space-y-4">
                    @csrf
                    <label class="block">
                        <span class="label">Van</span>
                        <input type="date" name="start_date" value="{{ old('start_date', now()->toDateString()) }}" min="{{ now()->toDateString() }}" class="input" required>
                    </label>
                    <label class="block">
                        <span class="label">Tot en met</span>
                        <input type="date" name="end_date" value="{{ old('end_date', now()->addDay()->toDateString()) }}" min="{{ now()->toDateString() }}" class="input" required>
                    </label>
                    @if ($errors->any())
                        <p class="text-sm text-red-600">{{ $errors->first() }}</p>
                    @endif
                    <button class="btn-primary w-full">Reserveer</button>
                </form>
            @endif
        </aside>
    </div>
@endsection
