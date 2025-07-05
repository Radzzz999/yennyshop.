<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_product()
    {
        // Fake Storage agar tidak nyimpan file asli
        Storage::fake('public');

        // Buat user admin dan login
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($admin);

        // Kirim data POST ke route simpan produk
        $response = $this->post(route('admin.products.store'), [
            'nama_product' => 'Test Produk',
            'harga' => 15000,
            'deskripsi' => 'Produk testing',
            'foto1' => UploadedFile::fake()->image('foto1.jpg'),
        ]);

        // Redirect ke dashboard admin
        $response->assertRedirect(route('admin.dashboard'));

        // Cek apakah data masuk ke database
        $this->assertDatabaseHas('products', [
            'nama_product' => 'Test Produk',
            'harga' => 15000,
            'deskripsi' => 'Produk testing',
            'is_active' => 1,
        ]);

        // Ambil produk pertama dan cek file fotonya tersimpan
        $product = Product::first();
        Storage::disk('public')->assertExists($product->foto1);
    }

    public function test_guest_cannot_create_product()
    {
        // Kirim request tanpa login
        $response = $this->post(route('admin.products.store'), [
            'nama_product' => 'Test Produk',
            'harga' => 15000,
            'deskripsi' => 'Produk testing',
            'foto1' => UploadedFile::fake()->image('foto1.jpg'),
        ]);

        // Harus diarahkan ke halaman login
        $response->assertRedirect('/login');
    }
}
