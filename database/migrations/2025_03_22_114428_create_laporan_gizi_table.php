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
            $table->date('tanggal_pemeriksaan');
            $table->foreignId('id_balita')->constrained('balita')->cascadeOnDelete();
            $table->float('berat');
            $table->float('tinggi');
            $table->integer('umur');
            $table->enum('status_gizi',['stunting', 'underweight', 'normal', 'wasting', 'overweight']);
            $table->timestamps();
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
