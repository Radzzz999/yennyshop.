<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">

    <div class="detail-container">
        <div class="image-wrapper">
            <img src="{{ asset('storage/' . $product->foto1) }}" class="detail-image" alt="{{ $product->nama_product }}">
        </div>

        <div class="detail-content">
            <h2 class="detail-title">{{ $product->nama_product }}</h2>
            <div class="detail-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
            <p class="detail-description">{{ $product->deskripsi }}</p>

            <div class="btn-group">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">← Kembali ke Produk</a>

                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Tambah ke Keranjang 🛒</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
