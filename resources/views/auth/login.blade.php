@extends('layouts.app')

@section('title', 'Inloggen')

@section('content')
    <div class="max-w-md mx-auto bg-white border border-stone-200 rounded-xl p-6">
        <h1 class="text-2xl font-bold mb-6">Inloggen</h1>
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <label class="block">
                <span class="label">E-mailadres</span>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="input" required autofocus>
            </label>
            <label class="block">
                <span class="label">Wachtwoord</span>
                <input id="password" type="password" name="password" class="input" required>
            </label>
            @if ($errors->any())
                <p class="text-sm text-red-600">{{ $errors->first() }}</p>
            @endif
            <button class="btn-primary w-full">Inloggen</button>
        </form>
        <p class="text-sm text-center mt-4">Nog geen account? <a href="{{ route('register') }}" class="text-brand underline">Registreren</a></p>

        {{-- Test accounts, so visitors can try the site without signing up --}}
        <div class="mt-6 rounded-lg bg-brand-soft p-4 text-sm">
            <p class="font-semibold mb-2">Even rondkijken? Kies een testaccount:</p>
            <div class="flex flex-wrap gap-2">
                @foreach (['paris' => 'Paris', 'sanne' => 'Sanne', 'daan' => 'Daan', 'lisa' => 'Lisa'] as $user => $name)
                    <button type="button" onclick="document.getElementById('email').value='{{ $user }}@voorbeeld.nl';document.getElementById('password').value='welkom123'" class="bg-white border border-emerald-300 rounded-full px-3 py-1 hover:bg-emerald-50">{{ $name }}</button>
                @endforeach
            </div>
            <p class="text-stone-600 mt-2">Wachtwoord: <code>welkom123</code></p>
        </div>
    </div>
@endsection
