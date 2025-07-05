<x-app-layout>
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">

    <div class="container mx-auto px-4 py-12 max-w-3xl text-white">
        <h1 class="text-3xl font-bold mb-6">🛒 Keranjang Belanja</h1>

        @if ($cart->count())
            <div class="flex flex-col gap-6">
                @foreach ($cart as $item)
                    <div class="cart-card">
                        <img src="{{ asset('storage/' . $item->product->foto1) }}" alt="{{ $item->product->nama_product }}">

                        <div class="cart-info">
                            <div class="cart-title">{{ $item->product->nama_product }}</div>
                            <div class="cart-meta">Harga: Rp {{ number_format($item->product->harga, 0, ',', '.') }}</div>
                            <div class="cart-meta">Subtotal: Rp {{ number_format($item->product->harga * $item->quantity, 0, ',', '.') }}</div>
                        </div>

                        {{-- Quantity Control --}}
                        <div class="qty-control">
                            <form action="{{ route('cart.update', $item->product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="qty" value="{{ max(1, $item->quantity - 1) }}">
                                <button type="submit" class="qty-btn">−</button>
                            </form>

                            <input type="number" value="{{ $item->quantity }}" class="qty-input" readonly>

                            <form action="{{ route('cart.update', $item->product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="qty" value="{{ $item->quantity + 1 }}">
                                <button type="submit" class="qty-btn">+</button>
                            </form>
                        </div>

                        {{-- Hapus --}}
                        <form action="{{ route('cart.remove', $item->product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn danger">Hapus</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 text-right font-semibold text-lg">
                @php
                    $total = $cart->sum(fn($item) => $item->product->harga * $item->quantity);
                @endphp
                Total: Rp {{ number_format($total, 0, ',', '.') }}

                <div class="text-right">
                    <a href="{{ route('payment.show') }}" class="checkout-link">Lanjut ke Pembayaran</a>
                </div>
            </div>
        @else
            <p class="text-white">Keranjang kamu masih kosong 😢</p>
        @endif
    </div>
</x-app-layout>
