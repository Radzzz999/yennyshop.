<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller

{
  
    public function dashboard()
    {
        // Kirim data produk ke view dashboard
        $products = Product::latest()->take(5)->get(); // ambil 5 produk terbaru
        return view('admin.dashboard', compact('products'));
    }

    public function manageProducts()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }
    public function paymentReport()
    {
        $payments = \App\Models\Payment::with('user')->orderBy('created_at', 'desc')->get();

        return view('admin.payments.report', compact('payments'));
    }

    public function showProduct($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }


}
