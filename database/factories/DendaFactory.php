<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Buku;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Denda>
 */
class DendaFactory extends Factory
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
            'id_pengembalian' => Pengembalian::factory(),
            'id_buku' => Buku::factory(),
            'id_user' => User::factory(),
            'keterangan' => $this->faker->sentence(),
            'lama_denda' => $this->faker->numberBetween(1, 10),
            'nominal' => $this->faker->numberBetween(1000, 10000),
            'tgl_denda' => $this->faker->date(),
            'is_lunas' => $this->faker->boolean(50),
        ];
    }
}
