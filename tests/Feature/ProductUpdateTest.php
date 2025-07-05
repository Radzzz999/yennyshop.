<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_product()
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);

        $product = Product::factory()->create();

        $this->actingAs($admin);

        $response = $this->put(route('admin.products.update', $product->id), [
            'nama_product' => 'Produk Update',
            'harga' => 20000,
            'deskripsi' => 'Update deskripsi',
            'foto1' => UploadedFile::fake()->image('foto_update.jpg'),
        ]);

        $response->assertRedirect(route('admin.dashboard'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'nama_product' => 'Produk Update',
            'harga' => 20000,
            'deskripsi' => 'Update deskripsi',
        ]);
    }
}
