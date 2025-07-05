@extends('layouts.admin')

@section('content')
<div class="container text-white text-center" style="background: #8a2be2; min-height: 100vh; padding-top: 50px;">
    <h2>⚡ CRUD Produk Admin</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">+ Tambah Produk</a>

    <table class="table table-bordered table-dark text-white">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $i => $product)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $product->nama_product }}</td>
                    <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="text-info">Lihat</a> |
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-warning">Edit</a> |
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-link text-danger p-0 m-0" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Tidak ada produk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
