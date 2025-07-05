@extends('layouts.admin')

@section('title', 'Tambah Produk')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/crudadmin.css') }}">
@section('content')
<div class="form-container text-white">
    <h1 class="text-2xl font-bold mb-4">➕ Tambah Produk</h1>

    {{-- Tampilkan error validasi jika ada --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada kesalahan input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form tambah produk --}}
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama_product" class="form-label">Nama Produk</label>
            <input type="text" name="nama_product" id="nama_product" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label for="foto1" class="form-label">Foto Produk</label>
            <input type="file" name="foto1" id="foto1" class="form-control" accept="image/*" required>
        </div>

        <div class="form-actions mt-4 d-flex justify-content-between">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">← Kembali</a>
            <button type="submit" class="btn btn-success">Simpan Produk</button>
        </div>
    </form>
</div>
@endsection
