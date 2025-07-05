<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductReadTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_see_product_list()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        Product::factory()->count(2)->create([
            'is_active' => true,
        ]);

        $this->actingAs($admin);

        $response = $this->get(route('admin.products.index'));

        $response->assertStatus(200);
        $response->assertSee(Product::first()->nama_product);
    }
}
