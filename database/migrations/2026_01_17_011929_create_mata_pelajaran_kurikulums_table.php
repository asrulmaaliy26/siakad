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
        Schema::create('mata_pelajaran_kurikulum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kurikulum')->nullable()
                ->constrained('kurikulum', 'id');
            $table->foreignId('id_mata_pelajaran_master')->nullable()
                ->constrained('mata_pelajaran_master', 'id');
            $table->integer('semester')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_pelajaran_kurikulum');
    }
};
