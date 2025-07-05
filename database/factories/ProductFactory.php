<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'sku' => 'SKU-' . uniqid(),
            'nama_product' => $this->faker->word,
            'kategori' => 'Umum',
            'type' => 'Standard',
            'harga' => $this->faker->numberBetween(1000, 100000),
            'deskripsi' => $this->faker->sentence,
            'stok' => 0,
            'foto1' => 'dummy.jpg', // diasumsikan dummy
            'is_active' => true,
        ];
    }
}
