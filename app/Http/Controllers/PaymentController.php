<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Cart;

class PaymentController extends Controller
{
    // Menampilkan halaman pembayaran
    public function show(Request $request)
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = $cart->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });

        return view('payment.payment', compact('cart', 'total'));
    }

    // Proses simpan pembayaran
    public function process(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:qris,bank',
        ]);

        $user = Auth::user();

        // Hitung ulang total dari cart
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });

        if ($total <= 0) {
            return redirect()->back()->with('error', 'Total pembayaran tidak valid.');
        }

        // Simpan ke tabel payments
        Payment::create([
            'user_id' => $user->id,
            'payment_method' => $request->payment_method,
            'amount' => $total,
            'status' => 'success', // diset sukses langsung
        ]);

        // Kosongkan keranjang
        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('home')->with('success', 'Pembayaran berhasil!');
    }

    // (Optional) Jika ingin simpan data manual dari form
    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);

        Payment::create([
            'user_id' => Auth::id(),
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'status' => 'success',
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil!');
    }
}

