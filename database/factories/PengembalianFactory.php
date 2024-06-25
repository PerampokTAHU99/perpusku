<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengembalian>
 */
class PengembalianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_peminjaman' => Peminjaman::factory(),
            'id_buku' => Buku::factory(),
            'id_user' => User::factory(),
            'jumlah_pengembalian' => $this->faker->numberBetween(1, 5),
            'tgl_pengembalian' => $this->faker->date(),
        ];
    }
}
