@extends('layouts.app')

@section('title', 'Account maken')

@section('content')
    <div class="max-w-md mx-auto bg-white border border-stone-200 rounded-xl p-6">
        <h1 class="text-2xl font-bold mb-6">Account maken</h1>
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <label class="block">
                <span class="label">Naam</span>
                <input name="name" value="{{ old('name') }}" class="input" required autofocus>
            </label>
            <label class="block">
                <span class="label">E-mailadres</span>
                <input type="email" name="email" value="{{ old('email') }}" class="input" required>
            </label>
            <label class="block">
                <span class="label">Wachtwoord (minstens 8 tekens)</span>
                <input type="password" name="password" class="input" required>
            </label>
            <label class="block">
                <span class="label">Wachtwoord nog een keer</span>
                <input type="password" name="password_confirmation" class="input" required>
            </label>
            @if ($errors->any())
                <p class="text-sm text-red-600">{{ $errors->first() }}</p>
            @endif
            <button class="btn-primary w-full">Account maken</button>
        </form>
        <p class="text-sm text-center mt-4">Heb je al een account? <a href="{{ route('login') }}" class="text-brand underline">Inloggen</a></p>
    </div>
@endsection
