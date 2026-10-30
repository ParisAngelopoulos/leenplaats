<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leenplaats</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-50 text-stone-800">
    <header class="bg-[#2f6f5e] text-white">
        <div class="max-w-5xl mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold">Leenplaats</h1>
            <p class="text-emerald-100 mt-1">Leen spullen van mensen in de buurt, in plaats van alles zelf te kopen.</p>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-10">
        <h2 class="text-xl font-semibold mb-6">Te leen ({{ $products->count() }} producten)</h2>

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <article class="bg-white border border-stone-200 rounded-xl p-5 flex flex-col">
                    <div class="flex items-start justify-between gap-3">
                        <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                        <span class="text-[#2f6f5e] font-semibold whitespace-nowrap">€ {{ number_format($product->price, 2, ',', '.') }} <span class="text-stone-500 font-normal text-sm">/ dag</span></span>
                    </div>
                    <p class="text-stone-600 text-sm mt-2">{{ $product->description }}</p>

                    <div class="mt-4 text-sm flex-1">
                        @if (!$product->is_available)
                            <span class="inline-block px-2 py-0.5 rounded-full bg-stone-200 text-stone-600">Tijdelijk niet beschikbaar</span>
                        @elseif ($product->reservations->isEmpty())
                            <span class="inline-block px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">Vrij</span>
                        @else
                            <p class="text-stone-500 mb-1">Gereserveerd:</p>
                            <ul class="space-y-1">
                                @foreach ($product->reservations as $reservation)
                                    <li>{{ $reservation->start_date->format('d-m') }} t/m {{ $reservation->end_date->format('d-m') }} · {{ $reservation->user->name }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>

        <p class="text-sm text-stone-500 mt-10">De producten staan ook als JSON op <a class="underline" href="{{ url('api/producten') }}">api/producten</a>.</p>
    </main>
</body>
</html>
