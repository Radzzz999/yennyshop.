@extends('layouts.admin')

@section('title', 'Edit Produk')
<link rel="stylesheet" href="{{ asset('css/crudadmin.css') }}">

@section('content')
<div class="card bg-secondary text-white">
    <div class="card-header">
        <h3 class="mb-0">✏️ Edit Produk</h3>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_product" class="form-label">Nama Produk</label>
                <input type="text" name="nama_product" id="nama_product" class="form-control" value="{{ $product->nama_product }}" required>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control" value="{{ $product->harga }}" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4">{{ $product->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label for="foto1" class="form-label">Foto Produk</label>
                <input type="file" name="foto1" id="foto1" class="form-control" accept="image/*">
                @if ($product->foto1)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $product->foto1) }}" width="120" class="img-thumbnail">
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-light">← Kembali</a>
                <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
