<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::truncate(); // Kosongkan data lama

        $items = [
            ['nama' => 'Jam Tangan Elegan', 'harga' => 250000, 'gambar' => 'products/jam.jpg'],
            ['nama' => 'Tas Kulit Premium', 'harga' => 400000, 'gambar' => 'products/tas.jpg'],
            ['nama' => 'Sneakers Sporty', 'harga' => 320000, 'gambar' => 'products/sepatu.jpg'],
        ];

        foreach ($items as $item) {
            Product::create([
                'sku' => uniqid('SKU-'),
                'nama_product' => $item['nama'],
                'kategori' => 'Fashion',
                'type' => 'Retail',
                'harga' => $item['harga'],
                'deskripsi' => 'Produk unggulan dari Yennyshop.',
                'stok' => 10,
                'foto1' => $item['gambar'],
                'is_active' => true,
            ]);
        }
    }
}