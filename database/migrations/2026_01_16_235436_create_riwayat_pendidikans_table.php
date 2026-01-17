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
        Schema::create('riwayat_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa_data')->nullable()
                ->constrained('siswa_data', 'id');
            $table->foreignId('id_jenjang_pendidikan')->nullable()
                ->constrained('jenjang_pendidikan', 'id');
            $table->foreignId('id_jurusan')->nullable()
                ->constrained('jurusan', 'id');
            $table->enum('status_siswa', ['DO', 'Aktif'])->nullable();
            $table->year('angkatan')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pendidikan');
    }
};
