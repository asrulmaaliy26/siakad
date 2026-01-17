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
        Schema::create('siswa_evaluasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mata_pelajaran_kelas')->nullable()
                ->constrained('mata_pelajaran_kelas', 'id');
            $table->foreignId('id_siswa_jenis_evaluasi')->nullable()
                ->constrained('siswa_jenis_evaluasi', 'id');
            $table->date('tanggal')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_evaluasi');
    }
};
