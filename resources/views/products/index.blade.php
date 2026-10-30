@extends('layouts.app')

@section('title', 'Alle spullen')

@section('content')
    <section class="mb-8 rounded-2xl bg-brand-soft px-6 py-8">
        <h1 class="text-3xl font-bold text-stone-900">Leen spullen van mensen in de buurt</h1>
        <p class="text-stone-600 mt-2 max-w-2xl">Waarom een boormachine kopen die je twee keer per jaar gebruikt? Reserveer hem voor een paar dagen, of zet je eigen spullen erop.</p>
        <div class="mt-4 flex flex-wrap gap-3">
            @auth
                <a href="{{ route('products.create') }}" class="btn-primary">Iets aanbieden</a>
            @else
                <a href="{{ route('login') }}" class="btn-primary">Inloggen om te reserveren</a>
                <a href="{{ route('register') }}" class="btn-secondary">Account maken</a>
            @endauth
        </div>
    </section>

    <h2 class="text-xl font-semibold mb-4">Te leen ({{ $products->count() }} producten)</h2>

    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($products as $product)
            <a href="{{ route('products.show', $product) }}" class="group bg-white border border-stone-200 rounded-xl p-5 flex flex-col hover:shadow-md hover:-translate-y-0.5 transition">
                <div class="flex items-start justify-between gap-3">
                    <h3 class="font-semibold text-lg group-hover:text-brand">{{ $product->name }}</h3>
                    <span class="text-brand font-semibold whitespace-nowrap">€ {{ number_format($product->price, 2, ',', '.') }} <span class="text-stone-500 font-normal text-sm">/ dag</span></span>
                </div>
                <p class="text-stone-600 text-sm mt-2 flex-1">{{ $product->description }}</p>
                <div class="mt-4 flex items-center justify-between text-sm">
                    @if (!$product->is_available)
                        <span class="badge bg-stone-200 text-stone-600">Tijdelijk niet te leen</span>
                    @elseif ($product->upcomingReservations->isEmpty())
                        <span class="badge bg-emerald-100 text-emerald-800">Vrij</span>
                    @else
                        <span class="badge bg-amber-100 text-amber-800">{{ $product->upcomingReservations->count() }}× gereserveerd</span>
                    @endif
                    @if ($product->owner)
                        <span class="text-stone-500 truncate ml-3">van {{ $product->owner->name }}</span>
                    @endif
                </div>
            </a>
        @endforeach
    </div>

    <p class="text-sm text-stone-500 mt-10">De producten staan ook als JSON op <a class="underline" href="{{ url('api/producten') }}">api/producten</a>.</p>
@endsection
