<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menampilkan isi keranjang
    public function index()
    {
        $cart = Cart::with('product')
                    ->where('user_id', auth()->id())
                    ->get();

        return view('cart.index', compact('cart'));
    }

    // Menambahkan produk ke keranjang
    public function add($id)
    {
        $user = auth()->user();
        $product = Product::findOrFail($id);

        $existing = Cart::where('user_id', $user->id)
                        ->where('product_id', $id)
                        ->first();

        if ($existing) {
            $existing->increment('quantity');
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    // Menghapus produk dari keranjang
    public function remove($id)
    {
        Cart::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->delete();

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }

    // Update jumlah produk di keranjang
    public function update(Request $request, $id)
    {
        $qty = max(1, (int) $request->input('qty', 1));

        Cart::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->update(['quantity' => $qty]);

        return redirect()->back()->with('success', 'Jumlah produk diperbarui.');
    }

    // Tampilkan halaman pembayaran
    public function showPayment()
    {
        $cart = Cart::with('product')
                    ->where('user_id', auth()->id())
                    ->get();

        $total = $cart->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });

        return view('payment.payment', compact('cart', 'total'));
    }
}
