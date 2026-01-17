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
        Schema::create('kurikulum', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->nullable();
            $table->foreignId('id_jurusan')->nullable()
                ->constrained('jurusan', 'id');
            $table->foreignId('id_tahun_akademik')->nullable()
                ->constrained('tahun_akadmeik', 'id');
            $table->foreignId('id_jenjang_pendidikan')->nullable()
                ->constrained('jenjang_pendidikan', 'id');
            $table->enum('status_aktif', ['Y', 'N'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurikulums');
    }
};
