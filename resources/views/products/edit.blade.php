@extends('layouts.admin')

@section('title', 'Edit Produk')
<link rel="stylesheet" href="{{ asset('css/crud.css') }}">

@section('content')
<h2>Edit Produk</h2>

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Produk</label>
        <input type="text" name="nama_product" class="form-control" value="{{ $product->nama_product }}" required>
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" value="{{ $product->harga }}" required>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control">{{ $product->deskripsi }}</textarea>
    </div>

    <div class="mb-3">
        <label>Foto Produk (kosongkan jika tidak diubah)</label><br>
        <input type="file" name="foto1" class="form-control">
        @if ($product->foto1)
            <img src="{{ asset('storage/' . $product->foto1) }}" width="100" class="mt-2" />
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>
@endsection
