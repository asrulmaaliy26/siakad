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
        Schema::create('siswa_data_orang_tua', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50)->nullable();
            $table->foreignId('id_siswa_data')->nullable()
                ->constrained('siswa_data', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_data_orang_tua');
    }
};
