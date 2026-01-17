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
        Schema::create('data_ljk', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_akademik_krs')
                ->constrained('akademik_krs', 'id')
                ->cascadeOnDelete();

            $table->foreignId('id_mata_pelajaran_kelas')
                ->constrained('mata_pelajaran_kelas', 'id')
                ->cascadeOnDelete();

            $table->decimal('nilai', 5, 2)->nullable();
            // contoh: 85.50

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_data_ljk');
    }
};
