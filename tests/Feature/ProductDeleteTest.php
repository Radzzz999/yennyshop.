<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_delete_product()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $product = Product::factory()->create();

        $this->actingAs($admin);

        $response = $this->delete(route('admin.products.destroy', $product->id));

        $response->assertRedirect(route('admin.dashboard'));

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}
