<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_buku'=>fake()->numberBetween(1,5),
            'judul'=>fake()->sentence(),
            'penulis'=>fake()->name(),
            'penerbit'=>fake()->name(),
            'stok'=>fake()->numberBetween(1,5),
            'sampul'=>fake()->imageUrl(), 
        ];
    }
}
