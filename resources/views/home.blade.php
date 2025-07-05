<x-layouts.app>

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <!-- Floating decorative elements -->
    <div class="floating-element">🛍️</div>
    <div class="floating-element">✨</div>
    <div class="floating-element">🎁</div>
    <div class="floating-element">💎</div>
    <div class="floating-element">🌟</div>
    <div class="floating-element">🛒</div>
    <div class="decoration-circle"></div>
    <div class="decoration-circle"></div>
    <div class="decoration-circle"></div>

    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">
                <span class="shopping-emoji">🛍️</span>Selamat Datang di <span class="yennyshop-text">Yennyshop</span>
            </h1>
            <p class="hero-subtitle">
                Temukan pilihan produk terbaik, harga bersahabat, dan layanan terpercaya — semua di satu tempat.
            </p>
            <a href="{{ route('products.index') }}" class="btn-hero">
                Lihat Produk <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </section>
</x-layouts.app>