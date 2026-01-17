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
        Schema::create('pertemuan_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mata_pelajaran_kelas')->nullable()
                ->constrained('mata_pelajaran_kelas', 'id');
            $table->integer('pertemuan_ke')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('materi', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertemuan_kelas');
    }
};
