<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', 1)->get();
        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function create()
    {
        if (auth()->user()->is_admin) {
            return view('admin.products.create');
        }
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_product' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'foto1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('foto1')->store('products', 'public');

        Product::create([
            'sku' => 'SKU-' . uniqid(),
            'nama_product' => $request->nama_product,
            'kategori' => 'Umum',
            'type' => 'Standard',
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'stok' => 0,
            'foto1' => $path,
            'is_active' => true,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function destroy(Product $product)
    {
        if ($product->foto1 && \Storage::disk('public')->exists($product->foto1)) {
            \Storage::disk('public')->delete($product->foto1);
        }

        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil dihapus!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Cek apakah user admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Anda bukan admin.');
        }

        // Validasi input
        $request->validate([
            'nama_product' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->nama_product = $request->nama_product;
        $product->harga = $request->harga;
        $product->deskripsi = $request->deskripsi;

        if ($request->hasFile('foto1')) {
            $path = $request->file('foto1')->store('produk', 'public');
            $product->foto1 = $path;
        }

        $product->save();

        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil diperbarui.');
    }

}
