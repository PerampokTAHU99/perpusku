<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDendaTable extends Migration
{
    public function up(): void
    {
        Schema::create('denda', function (Blueprint $table) {
            $table->id('id_denda');
            $table->unsignedBigInteger('id_peminjaman');
            $table->unsignedBigInteger('id_pengembalian');
            $table->unsignedBigInteger('id_buku');
            $table->unsignedBigInteger('id_user');
            $table->string('keterangan')->nullable();
            $table->integer('lama_denda')->nullable();
            $table->integer('nominal')->nullable();
            $table->date('tgl_denda')->nullable();
            $table->boolean('is_lunas')->default(0);
            $table->timestamps();

            // Define foreign keys with correct table and column references
            $table->foreign('id_peminjaman')->references('id_peminjaman')->on('peminjaman')->onDelete('cascade');
            $table->foreign('id_pengembalian')->references('id_pengembalian')->on('pengembalian')->onDelete('cascade');
            $table->foreign('id_buku')->references('id_buku')->on('buku')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('denda');
    }
}
