<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Buku;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peminjaman>
 */
class PeminjamanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_buku' => Buku::factory(),
            'id_user' => User::factory(),
            'jumlah_pinjaman' => $this->faker->numberBetween(1, 5),
            'tgl_pinjaman' => $this->faker->date(),
            'tgl_pengembalian' => $this->faker->date(),
        ];
    }
}
