<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Denda;
use App\Models\Buku;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LaporanPeminjaman>
 */
class LaporanPeminjamanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $peminjaman = Peminjaman::inRandomOrder()->first();
        $pengembalian = Pengembalian::where('id_peminjaman', $peminjaman->id_peminjaman)->inRandomOrder()->first();
        $denda = Denda::where('id_peminjaman', $peminjaman->id_peminjaman)->inRandomOrder()->first();

        return [
            'id_peminjaman' => Peminjaman::factory(),
            'id_pengembalian' => Pengembalian::factory(),
            'id_buku' => Buku::factory(),
            'id_user' => User::factory(),
            'id_denda' => Denda::factory(),
            'judul' => $this->faker->sentence(),
        ];
    }
}
