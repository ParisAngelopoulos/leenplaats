@extends('layouts.app')

@section('title', 'Mijn reserveringen')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Mijn reserveringen</h1>

    @forelse ($reservations as $reservation)
        @php($days = $reservation->start_date->diffInDays($reservation->end_date) + 1)
        <div class="bg-white border border-stone-200 rounded-xl p-5 mb-3 flex flex-wrap items-center justify-between gap-4">
            <div>
                <a href="{{ route('products.show', $reservation->product) }}" class="font-semibold text-lg hover:text-brand">{{ $reservation->product->name }}</a>
                <p class="text-sm text-stone-600">{{ $reservation->start_date->format('d-m-Y') }} t/m {{ $reservation->end_date->format('d-m-Y') }} · {{ $days }} {{ $days === 1 ? 'dag' : 'dagen' }} · € {{ number_format($days * $reservation->product->price, 2, ',', '.') }}</p>
            </div>
            @if ($reservation->end_date->isFuture() || $reservation->end_date->isToday())
                <form method="POST" action="{{ route('reservations.destroy', $reservation) }}" onsubmit="return confirm('Deze reservering annuleren?')">
                    @csrf @method('DELETE')
                    <button class="btn-secondary">Annuleren</button>
                </form>
            @else
                <span class="badge bg-stone-100 text-stone-500">Voorbij</span>
            @endif
        </div>
    @empty
        <div class="bg-white border border-stone-200 rounded-xl p-6 text-stone-600">
            Je hebt nog niets gereserveerd. <a href="{{ route('products.index') }}" class="text-brand underline">Bekijk wat er te leen is</a>.
        </div>
    @endforelse
@endsection
