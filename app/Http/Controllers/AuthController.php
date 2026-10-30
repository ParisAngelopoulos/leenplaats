<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Dit e-mailadres en wachtwoord horen niet bij elkaar.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('products.index'))->with('status', 'Welkom terug, ' . Auth::user()->name . '!');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'email.unique' => 'Er is al een account met dit e-mailadres.',
            'password.confirmed' => 'De wachtwoorden zijn niet hetzelfde.',
            'password.min' => 'Het wachtwoord moet minstens 8 tekens hebben.',
        ]);

        $user = User::create($data);
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('products.index')->with('status', 'Je account is aangemaakt. Welkom, ' . $user->name . '!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('products.index')->with('status', 'Je bent uitgelogd.');
    }
}
