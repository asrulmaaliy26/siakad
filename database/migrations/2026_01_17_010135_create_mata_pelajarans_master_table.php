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
        Schema::create('mata_pelajaran_master', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->foreignId('id_jurusan')->nullable()
                ->constrained('jurusan', 'id');
            $table->integer('bobot')->nullable();
            $table->enum('jenis', ['wajib', 'peminatan'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_pelajaran_master');
    }
};
