<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Leenplaats') · Leenplaats</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-stone-50 text-stone-800 min-h-screen flex flex-col">
    <header class="bg-brand text-white">
        <div class="max-w-5xl mx-auto px-4 py-4 flex flex-wrap items-center justify-between gap-3">
            <a href="{{ route('products.index') }}" class="text-2xl font-bold tracking-tight">Leenplaats</a>
            <nav class="flex flex-wrap items-center gap-4 text-sm">
                <a href="{{ route('products.index') }}" class="hover:underline">Alle spullen</a>
                @auth
                    <a href="{{ route('products.create') }}" class="hover:underline">Iets aanbieden</a>
                    <a href="{{ route('reservations.index') }}" class="hover:underline">Mijn reserveringen</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="bg-white/15 hover:bg-white/25 rounded-full px-3 py-1">Uitloggen ({{ auth()->user()->name }})</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-brand font-semibold rounded-full px-4 py-1.5 hover:bg-emerald-50">Inloggen</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="max-w-5xl w-full mx-auto px-4 py-8 flex-1">
        @if (session('status'))
            <div class="mb-6 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-900 px-4 py-3">{{ session('status') }}</div>
        @endif
        @yield('content')
    </main>

    <footer class="text-center text-sm text-stone-500 py-6">
        Leenplaats is een project van <a class="underline" href="https://parisangelopoulos.com">Paris Angelopoulos</a> · gemaakt met Laravel
    </footer>
</body>
</html>
