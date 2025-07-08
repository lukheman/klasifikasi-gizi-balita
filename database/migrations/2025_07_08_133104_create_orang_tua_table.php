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
            $table->string('name');
            $table->foreignId('id_desa')
                ->nullable()
                ->constrained('desa')
                ->nullOnDelete();
            $table->string('nik')->nullable()->unique();
            $table->text('alamat')->nullable();
            $table->string('email')->unique();
            $table->string('password')->default(bcrypt('password123'));
            $table->timestamps();
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
