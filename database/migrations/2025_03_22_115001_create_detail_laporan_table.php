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
        Schema::create('detail_laporan', function (Blueprint $table) {
            $table->id();
            $table->integer('umur'); // bulan
            $table->integer('berat'); // kg
            $table->integer('tinggi'); // cm
            $table->enum('status_gizi',['Stunting', 'Underweight', 'Normal', 'Wasting', 'Overweight']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_laporan');
    }
};
