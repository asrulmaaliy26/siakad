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
        Schema::create('siswa_jawaban', function (Blueprint $table) {
            $table->id();

            // Foreign Key ke siswa_soal_evaluasi
            $table->foreignId('id_soal_evaluasi')
                ->constrained('siswa_soal_evaluasi', 'id')
                ->cascadeOnDelete();

            // Foreign Key ke KRS
            $table->foreignId('id_akademik_krs')
                ->constrained('akademik_krs', 'id')
                ->cascadeOnDelete();

            // Jawaban mahasiswa
            $table->text('jawaban')->nullable();

            // Skor jawaban
            $table->integer('skor')->default(0);

            // Waktu submit
            $table->timestamp('waktu_submit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_jawaban');
    }
};
