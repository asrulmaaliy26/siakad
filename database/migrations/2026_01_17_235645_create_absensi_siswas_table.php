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
        Schema::create('absensi_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pertemuan')->nullable()
                ->constrained('pertemuan_kelas', 'id');
            $table->foreignId('id_krs')->nullable()
                ->constrained('akademik_krs', 'id');
            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alpa'])->nullable();
            $table->dateTime('waktu_absen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_siswa');
    }
};
