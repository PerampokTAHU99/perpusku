<?php

namespace Database\Seeders;

use App\Models\Denda;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\LaporanPeminjaman;  

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        UserRole::factory()->create(['typeOfRole' => 'admin']);
        UserRole::factory()->create(['typeOfRole' => 'anggota']);
        User::factory()->count(10)->create();
        Buku::factory()->count(10)->create();
        Peminjaman::factory()->count(10)->create();
        Pengembalian::factory()->count(10)->create();
        Denda::factory()->count(10)->create();
        LaporanPeminjaman::factory()->count(10)->create();
    }
}
