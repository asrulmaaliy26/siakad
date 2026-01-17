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
        Schema::create('mata_pelajaran_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mata_pelajaran_kurikulum')->nullable()
                ->constrained('mata_pelajaran_kurikulum', 'id');
            $table->foreignId('id_kelas')->nullable()
                ->constrained('kelas', 'id');
            $table->foreignId('id_dosen_data')->nullable()
                ->constrained('dosen_data', 'id');
            $table->date('uts')->nullable();
            $table->date('uas')->nullable();
            $table->foreignId('id_ruang_kelas')->nullable()
                ->constrained('ruang_kelas', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_pelajaran_kelas');
    }
};
