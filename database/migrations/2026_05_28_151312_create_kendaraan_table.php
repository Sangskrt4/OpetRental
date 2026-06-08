<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama kendaraan (e.g. Honda Beat)
            $table->string('no_plat')->unique(); // No. Plat kendaraan
            $table->year('tahun'); // Tahun kendaraan
            $table->string('warna'); // Warna
            $table->string('cc'); // Kapasitas mesin (e.g. 125cc)
            $table->string('transmisi'); // Manual / Matic
            $table->decimal('harga_sewa', 10, 2); // Harga sewa per hari
            $table->string('gambar')->nullable(); // Path gambar kendaraan
            $table->enum('status', ['Tersedia', 'Disewa'])->default('Tersedia'); // Status kendaraan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};