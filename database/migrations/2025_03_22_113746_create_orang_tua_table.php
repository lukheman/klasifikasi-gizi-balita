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
        Schema::create('orang_tua', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->date('tanggal_lahir');
            $table->string('telepon');
            $table->timestamps();

            $table->index(['nama_orang_tua', 'nik']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orang_tua');
    }
};
