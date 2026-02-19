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
        // Check if tables exist before creating to avoid conflicts if they restore base migrations later

        if (!Schema::hasTable('jenjang_pendidikan')) {
            Schema::create('jenjang_pendidikan', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('kode')->nullable();
                $table->string('type')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('jurusan')) {
            Schema::create('jurusan', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->foreignId('id_jenjang_pendidikan')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('dosen_data')) {
            Schema::create('dosen_data', function (Blueprint $table) {
                $table->id();
                $table->string('nama')->nullable();
                $table->foreignId('id_jurusan')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('siswa_data')) {
            Schema::create('siswa_data', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable();
                $table->string('nama')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('siswa_data_pendaftar')) {
            Schema::create('siswa_data_pendaftar', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_siswa_data')->nullable();
                $table->foreignId('id_jurusan')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('riwayat_pendidikan')) {
            Schema::create('riwayat_pendidikan', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_siswa_data')->nullable();
                $table->foreignId('id_jurusan')->nullable();
                $table->string('status')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('kelas')) {
            Schema::create('kelas', function (Blueprint $table) {
                $table->id();
                $table->string('nama')->nullable();
                $table->foreignId('id_jurusan')->nullable();
                $table->foreignId('id_tahun_akademik')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('tahun_akademik')) {
            Schema::create('tahun_akademik', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('periode')->nullable();
                $table->string('status')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('mata_pelajaran_kelas')) {
            Schema::create('mata_pelajaran_kelas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_kelas')->nullable();
                $table->string('nama')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('siswa_data_ljk')) {
            Schema::create('siswa_data_ljk', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_mata_pelajaran_kelas')->nullable();
                $table->float('nilai')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We generally don't drop these in this rescue migration to avoid data loss if rolled back
        // Schema::dropIfExists('riwayat_pendidikan');
        // Schema::dropIfExists('siswa_data_pendaftars');
        // Schema::dropIfExists('siswa_data');
        // Schema::dropIfExists('dosen_data');
        // Schema::dropIfExists('jurusan');
        // Schema::dropIfExists('jenjang_pendidikan');
    }
};
