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
        Schema::create('siswa_soal_evaluasi', function (Blueprint $table) {
            $table->id();
            // $table->boolean('is_soal_evaluasi')->default(true);

            $table->foreignId('id_siswa_evaluasi')
                ->constrained('siswa_evaluasi', 'id')
                ->cascadeOnDelete();

            $table->text('pertanyaan');

            $table->string('tipe', 50);
            // contoh: pilihan_ganda, essay, true_false

            $table->integer('skor')->default(0);

            $table->string('kunci_jawaban')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_soal_evaluasi');
    }
};
