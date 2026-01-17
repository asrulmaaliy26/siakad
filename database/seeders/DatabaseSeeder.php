<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenjangPendidikan;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\TahunAkademik;
use App\Models\ProgramKelas;

// AKADEMIK
use App\Models\Kelas;
use App\Models\Kurikulum;
use App\Models\MataPelajaranMaster;
use App\Models\MataPelajaranKurikulum;

// SDM & FASILITAS
use App\Models\DosenData;
use App\Models\RuangKelas;

// MAHASISWA
use App\Models\SiswaData;
use App\Models\RiwayatPendidikan;
use App\Models\AkademikKrs;
use App\Models\SiswaDataPendaftar;
use App\Models\SiswaDataOrangTua;

// PROSES BELAJAR
use App\Models\MataPelajaranKelas;
use App\Models\PertemuanKelas;
use App\Models\AbsensiSiswa;

// EVALUASI
use App\Models\SiswaJenisEvaluasi;
use App\Models\SiswaEvaluasi;
use App\Models\SiswaSoalEvaluasi;
use App\Models\SiswaJawaban;
use App\Models\SiswaDataLjk;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        JenjangPendidikan::factory()->count(3)->create();
        Fakultas::factory()->count(3)->create();
        Jurusan::factory()->count(5)->create();
        TahunAkademik::factory()->count(2)->create();
        ProgramKelas::factory()->count(2)->create();

        $kelas = Kelas::factory()->count(3)->create();

        $siswa = SiswaData::factory()
            ->count(10)
            ->has(
                RiwayatPendidikan::factory()
                    ->has(
                        AkademikKrs::factory()
                            ->count(2)
                    )
            )
            ->create();

        MataPelajaranMaster::factory()->count(5)->create();
        Kurikulum::factory()->count(1)->create();
        MataPelajaranKurikulum::factory()->count(5)->create();
        RuangKelas::factory()->count(3)->create();
        DosenData::factory()->count(3)->create();

        MataPelajaranKelas::factory()->count(5)->create();
        SiswaJenisEvaluasi::factory()->count(4)->create();
        SiswaEvaluasi::factory()->count(10)->create();
        SiswaSoalEvaluasi::factory()->count(20)->create();
        SiswaJawaban::factory()->count(50)->create();
        PertemuanKelas::factory()->count(10)->create();
        AbsensiSiswa::factory()->count(30)->create();
        SiswaDataLjk::factory()->count(20)->create();
    }
}
