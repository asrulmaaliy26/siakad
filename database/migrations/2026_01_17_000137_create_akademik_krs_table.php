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
        Schema::create('akademik_krs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_riwayat_pendidikan')->nullable()
                ->constrained('riwayat_pendidikan', 'id');
            $table->foreignId('id_kelas')->nullable()
                ->constrained('kelas', 'id');
            $table->integer('semester')->nullable();
            $table->enum('status_bayar', ['Y', 'N'])->nullable();
            $table->integer('jumlah_sks')->nullable();
            $table->enum('status_aktif', ['Y', 'N'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akademik_krs');
    }
};
