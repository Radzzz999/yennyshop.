@extends('layouts.admin')

@section('title', 'Detail Produk')
<link rel="stylesheet" href="{{ asset('css/crudadmin.css') }}">

@section('content')
<div class="product-detail-container">
    <div class="product-detail-image">
        <img src="{{ asset('storage/' . $product->foto1) }}" alt="{{ $product->nama_product }}">
    </div>
    <div class="product-detail-content">
        <h1>{{ $product->nama_product }}</h1>
        <div class="product-detail-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
        <div class="product-detail-description">
            {{ $product->deskripsi }}
        </div>

        <div class="product-detail-actions">
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Tambah ke Keranjang</button>
            </form>

            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>

@endsection




