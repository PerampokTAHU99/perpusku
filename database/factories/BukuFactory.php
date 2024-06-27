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
            'judul' => $this->faker->sentence(4),
            'penulis' => $this->faker->name,
            'penerbit' => $this->faker->company,
            'stok' => $this->faker->numberBetween(0, 100),
            'sampul' => "",
            'kategori' => $this->faker->word,
            'keterangan' => $this->faker->paragraph,
            'harga' => $this->faker->numberBetween(10000, 100000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
