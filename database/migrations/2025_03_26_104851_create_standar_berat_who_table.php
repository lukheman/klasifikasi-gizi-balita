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
        Schema::create('standar_berat_who', function (Blueprint $table) {
            $table->id();
            $table->string('bulan')->unique();
            $table->float('SD3neg');
            $table->float('SD2neg');
            $table->float('SD1neg');
            $table->float('SD0');
            $table->float('SD1');
            $table->float('SD2');
            $table->float('SD3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standar_berat_who');
    }
};
