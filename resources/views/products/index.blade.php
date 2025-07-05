<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/crud.css') }}">

    {{-- Tombol Tambah Produk --}}
    @auth
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('products.create') }}" class="floating-btn" title="Tambah Produk">➕</a>
        @endif
    @endauth

    {{-- Halaman Produk --}}
    <div class="container mx-auto px-4 py-12 max-w-full overflow-x-hidden">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold mb-1">Produk Kami</h1>
            <p class="text-purple-100">Geser ke kanan untuk menjelajahi koleksi produk terbaik!</p>
        </div>

        <div class="product-scroll-container">
            @forelse ($products as $product)
                <div class="product-card-horizontal">
                    <a href="{{ route('products.show', $product->id) }}">
                        <img src="{{ asset('storage/' . $product->foto1) }}" alt="{{ $product->nama_product }}">
                    </a>
                    <div class="product-content">
                        <h2 class="product-title">
                            <a href="{{ route('products.show', $product->id) }}" style="text-decoration: none; color: inherit;">
                                {{ $product->nama_product }}
                            </a>
                        </h2>
                        <p class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn">Tambah ke Keranjang</button>
                        </form>

                        @auth
                            @if (auth()->user()->role === 'admin')
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn danger" style="margin-top: 8px;">🗑 Hapus</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <p class="text-white px-4">Belum ada produk tersedia.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
