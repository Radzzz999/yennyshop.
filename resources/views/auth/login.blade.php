@extends('layouts.clean')

@section('content')
 <link href="{{ asset('css/auth.css') }}" rel="stylesheet">


    <div class="auth-card">
        <h1> Login Akun Yennyshop</h1>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-sm text-white" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full text-black" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-200" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full text-black" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-200" />
            </div>

            <!-- Remember Me -->
            <div class="block mb-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-pink-400 shadow-sm focus:ring-pink-300" name="remember">
                    <span class="ml-2 text-sm text-white">{{ __('Ingat saya') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a class="text-sm" href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif

                <button class="login-btn ms-3">
                    {{ __('Masuk') }}
                </button>
            </div>
        </form>

        <div class="mt-4 text-center text-sm">
            <span>Belum punya akun?</span>
            <a href="{{ route('register') }}" class="underline hover:text-white">Daftar sekarang</a>
        </div>
    </div>
@endsection