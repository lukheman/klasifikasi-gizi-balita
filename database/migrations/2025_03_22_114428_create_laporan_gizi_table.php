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
        Schema::create('laporan_gizi', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('kode_balita')->constrained('balita')->restrictOnDelete();
            $table->foreignId('id_detail_laporan')->constrained('detail_laporan');
            $table->timestamps();

            $table->index('kode_balita');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_gizi');
    }
};
