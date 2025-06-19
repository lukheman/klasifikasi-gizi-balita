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
        Schema::create('data_latih', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('umur'); // umur dalam satuan bulan
            $table->decimal('berat', 5, 2);
            $table->decimal('tinggi', 5, 2);
            $table->enum('status', ['stunting', 'underweight', 'normal', 'wasting', 'overweight']);
            $table->timestamps();

            $table->index('nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_latih');
    }
};
