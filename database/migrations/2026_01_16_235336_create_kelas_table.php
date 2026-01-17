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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_program_kelas')->nullable()
                ->constrained('program_kelas', 'id');
            $table->integer('semester')->nullable();
            $table->foreignId('id_jenjang_pendidikan')->nullable()
                ->constrained('jenjang_pendidikan', 'id');
            $table->foreignId('id_tahun_akademik')->nullable()
                ->constrained('tahun_akadmeik', 'id');
            $table->enum('status_aktif', ['Y', 'N'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
