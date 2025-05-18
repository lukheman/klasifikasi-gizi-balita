<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\StatusGizi;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayat_pemeriksaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_balita')->constrained('balita')->cascadeOnDelete();
            $table->float('berat');
            $table->float('tinggi');
            $table->integer('umur');
            $table->enum('status_gizi', StatusGizi::values());
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
