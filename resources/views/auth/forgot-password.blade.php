@extends('layouts.clean')

@section('content')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">

    <div class="auth-card">
        <h1>🔐 Lupa Password</h1>

        <div class="mb-4 text-sm text-white">
            {{ __('Lupa kata sandi? Masukkan email Anda, dan kami akan kirimkan tautan untuk mereset password.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-sm text-white" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full text-black" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-200" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="login-btn">
                    {{ __('Kirim Link Reset Password') }}
                </button>
            </div>
        </form>
    </div>
@endsection
