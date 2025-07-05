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

<style>
    nav.appbar {
        background-color: #4B1C89;
        padding: 1rem 2rem;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        font-family: 'Poppins', sans-serif;
    }

    nav.appbar a {
        color: white;
        text-decoration: none;
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