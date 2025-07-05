<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Yennyshop') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: linear-gradient(to bottom right, #5b2c94, #a86cc1);
            font-family: 'Poppins', sans-serif;
            color: white;
        }

        nav.appbar {
            background-color: #4B1C89;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        nav.appbar a {
            color: white;
            text-decoration: none;
            margin-left: 1.25rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav.appbar a:hover,
        .logout-btn:hover {
            color: #fbd6ff;
        }

        .logout-btn {
            background: transparent;
            border: none;
            color: #f093fb;
            font-weight: 500;
            cursor: pointer;
            padding: 0;
        }
    </style>
</head>
<body>
    {{-- App Bar Custom --}}
    <nav class="appbar">
        <div class="flex items-center gap-4">
            <div class="text-xl font-bold">🛍️ Yennyshop</div>
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('products.index') }}">Produk</a>
            <a href="{{ route('cart.index') }}">Keranjang</a>
        </div>
        <div class="flex items-center gap-4">
            @auth
                <span class="font-medium">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Daftar</a>
            @endauth
        </div>
    </nav>

    {{-- Konten Halaman --}}
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>