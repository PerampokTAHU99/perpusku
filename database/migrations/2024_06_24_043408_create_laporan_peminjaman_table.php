<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPeminjamanTable extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_peminjaman', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->unsignedBigInteger('id_peminjaman');
            $table->unsignedBigInteger('id_pengembalian');
            $table->unsignedBigInteger('id_buku');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_denda');
            $table->string('judul');
            $table->timestamps();

            // Define foreign keys with correct table and column references
            $table->foreign('id_peminjaman')->references('id_peminjaman')->on('peminjaman')->onDelete('cascade');
            $table->foreign('id_pengembalian')->references('id_pengembalian')->on('pengembalian')->onDelete('cascade');
            $table->foreign('id_buku')->references('id_buku')->on('buku')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_denda')->references('id_denda')->on('denda')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_peminjaman');
    }
};
