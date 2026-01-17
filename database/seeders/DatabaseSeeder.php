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
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $jenjang = ['SMA', 'D3', 'S1', 'S2'];

        // // Membuat 4 record unik
        // foreach ($jenjang as $nama) {
        //     JenjangPendidikan::factory()->create([
        //         'nama' => $nama,
        //     ]);
        // }

        // JenjangPendidikan::factory()->create();
        // Fakultas::factory()->count(3)->create();
        // Jurusan::factory()->count(5)->create();
        // DB::table('jurusan')->insert([
        //     ['nama' => 'Informatika', 'id_fakultas' => 1, 'created_at' => now(), 'updated_at' => now()],
        //     ['nama' => 'Sistem Informasi', 'id_fakultas' => 1, 'created_at' => now(), 'updated_at' => now()],
        //     ['nama' => 'Teknik Komputer', 'id_fakultas' => 1, 'created_at' => now(), 'updated_at' => now()],
        // ]);

        // TahunAkademik::factory()->count(2)->create();

        // DB::table('tahun_akadmeik')->insert([
        //     ['nama' => '2025/2026', 'periode' => 'Ganjil', 'status' => 'Y', 'created_at' => now(), 'updated_at' => now()],
        //     ['nama' => '2025/2026', 'periode' => 'Genap', 'status' => 'N', 'created_at' => now(), 'updated_at' => now()],
        // ]);

        // ProgramKelas::factory()->count(2)->create();

        // DB::table('program_kelas')->insert([
        //     ['nama' => 'Reguler', 'created_at' => now(), 'updated_at' => now()],
        //     ['nama' => 'Karyawan', 'created_at' => now(), 'updated_at' => now()],
        // ]);

        // $kelas = Kelas::factory()->create();

        // $siswa = SiswaData::factory()
        //     ->count(10)
        //     ->has(
        //         RiwayatPendidikan::factory()
        //             ->has(
        //                 AkademikKrs::factory()
        //                     ->count(1)
        //             )
        //     )
        //     ->create();

        // $kelas1 = Kelas::find(1); // ambil kelas dengan ID 1
        // $kelas2 = Kelas::find(2); // ambil kelas dengan ID 2

        // $kelasList = [$kelas1, $kelas2];

        // foreach ($kelasList as $kelas) {
        //     // pastikan kelas ada
        //     if (!$kelas) continue;

        //     for ($i = 1; $i <= 10; $i++) {
        //         $siswa = SiswaData::create([
        //             'nama' => "Siswa {$kelas->nama} {$i}",
        //             'nomor_induk' => 'NIS' . rand(1000, 9999),
        //         ]);

        //         $riwayat = RiwayatPendidikan::create([
        //             'id_siswa_data' => $siswa->id,
        //             'id_jenjang_pendidikan' => 1, // sesuaikan
        //             'id_jurusan' => 1, // sesuaikan
        //             'status_siswa' => 'Aktif',
        //             'angkatan' => 2026,
        //             'tanggal_mulai' => now()->subYears(3),
        //             'tanggal_selesai' => null,
        //         ]);

        //         AkademikKrs::create([
        //             'id_riwayat_pendidikan' => $riwayat->id,
        //             'id_kelas' => $kelas->id,
        //             'semester' => 1,
        //             'status_bayar' => 'Y',
        //             'jumlah_sks' => 20,
        //             'status_aktif' => 'Y',
        //         ]);
        //     }
        // }

        // MataPelajaranMaster::factory()->count(5)->create();

        // $mataPelajaran = [
        //     ['name' => 'Matematika', 'id_jurusan' => 1, 'bobot' => 3, 'jenis' => 'wajib'],
        //     ['name' => 'Fisika', 'id_jurusan' => 1, 'bobot' => 3, 'jenis' => 'wajib'],
        //     ['name' => 'Kimia', 'id_jurusan' => 1, 'bobot' => 3, 'jenis' => 'wajib'],
        //     ['name' => 'Bahasa Inggris', 'id_jurusan' => 1, 'bobot' => 2, 'jenis' => 'wajib'],
        //     ['name' => 'Pemrograman', 'id_jurusan' => 1, 'bobot' => 3, 'jenis' => 'peminatan'],
        // ];

        // foreach ($mataPelajaran as $mp) {
        //     MataPelajaranMaster::create($mp);
        // }

        // Kurikulum::factory()->count(1)->create();

        // $kurikulumList = [
        //     [
        //         'name' => 'Kurikulum 1',
        //         'id_jurusan' => 1,
        //         'id_tahun_akademik' => 1,
        //         'id_jenjang_pendidikan' => 1,
        //         'status_aktif' => 'Y',
        //     ],
        //     [
        //         'name' => 'Kurikulum 2',
        //         'id_jurusan' => 1,
        //         'id_tahun_akademik' => 1,
        //         'id_jenjang_pendidikan' => 1,
        //         'status_aktif' => 'Y',
        //     ],
        // ];

        // foreach ($kurikulumList as $kurikulum) {
        //     Kurikulum::create($kurikulum);
        // }

        // MataPelajaranKurikulum::factory()->count(5)->create();

        // $kurikulum1Mapel = [1, 2, 3];

        // foreach ($kurikulum1Mapel as $mapelId) {
        //     MataPelajaranKurikulum::create([
        //         'id_kurikulum' => 1,
        //         'id_mata_pelajaran_master' => $mapelId,
        //         'semester' => 1,
        //     ]);
        // }

        // /**
        //  * Kurikulum 2 → 5 Mata Pelajaran
        //  */
        // $kurikulum2Mapel = [1, 2, 3, 4, 5];

        // foreach ($kurikulum2Mapel as $mapelId) {
        //     MataPelajaranKurikulum::create([
        //         'id_kurikulum' => 2,
        //         'id_mata_pelajaran_master' => $mapelId,
        //         'semester' => 1,
        //     ]);
        // }


        // RuangKelas::factory()->count(3)->create();

        // DosenData::factory()->count(4)->create();

        // MataPelajaranKelas::factory()->count(5)->create();
        // $mapelKurikulumIds = range(1, 8); // total 8 mapel

        // $dosenIds = [1, 2, 3, 4]; // 4 dosen
        // $ruangKelasIds = [1, 2, 3];

        // foreach ($mapelKurikulumIds as $index => $mapelKurikulumId) {

        //     // 5 mapel pertama → kelas 1, sisanya → kelas 2
        //     $kelasId = $index < 5 ? 1 : 2;

        //     // pembagian dosen: 4 mapel - 4 mapel
        //     $dosenIndex = intdiv($index, 4); // 0 atau 1
        //     $dosenId = $dosenIds[$dosenIndex];

        //     MataPelajaranKelas::create([
        //         'id_mata_pelajaran_kurikulum' => $mapelKurikulumId,
        //         'id_kelas' => $kelasId,
        //         'id_dosen_data' => $dosenId,
        //         'uts' => Carbon::now()->addWeeks(8),
        //         'uas' => Carbon::now()->addWeeks(16),
        //         'id_ruang_kelas' => $ruangKelasIds[array_rand($ruangKelasIds)],
        //     ]);
        // }
        // SiswaJenisEvaluasi::factory()->count(4)->create();
        // $data = [
        //     [
        //         'nama' => 'Tugas 1',
        //         'deskrispsi' => 'Evaluasi berupa tugas pertama',
        //     ],
        //     [
        //         'nama' => 'Tugas 2',
        //         'deskrispsi' => 'Evaluasi berupa tugas kedua',
        //     ],
        //     [
        //         'nama' => 'UTS',
        //         'deskrispsi' => 'Ujian Tengah Semester',
        //     ],
        //     [
        //         'nama' => 'UAS',
        //         'deskrispsi' => 'Ujian Akhir Semester',
        //     ],
        // ];

        // foreach ($data as $item) {
        //     SiswaJenisEvaluasi::create($item);
        // }

        // SiswaEvaluasi::factory()->count(10)->create();
        // $mapelKelas = MataPelajaranKelas::orderBy('id')
        //     ->limit(3)
        //     ->pluck('id')
        //     ->toArray();

        // foreach ($mapelKelas as $mapelKelasId) {

        //     // UTS
        //     SiswaEvaluasi::create([
        //         'id_mata_pelajaran_kelas' => $mapelKelasId,
        //         'id_siswa_jenis_evaluasi' => 3, // UTS
        //         'tanggal' => Carbon::now()->addWeeks(8),
        //         'keterangan' => 'Ujian Tengah Semester',
        //     ]);

        //     // UAS
        //     SiswaEvaluasi::create([
        //         'id_mata_pelajaran_kelas' => $mapelKelasId,
        //         'id_siswa_jenis_evaluasi' => 4, // UAS
        //         'tanggal' => Carbon::now()->addWeeks(16),
        //         'keterangan' => 'Ujian Akhir Semester',
        //     ]);
        // }

        // SiswaSoalEvaluasi::factory()->count(20)->create();

        // $siswaEvaluasiId = SiswaEvaluasi::first()?->id;

        // if (!$siswaEvaluasiId) {
        //     return; // stop jika belum ada evaluasi
        // }

        // $soal = [
        //     // PILIHAN GANDA
        //     [
        //         'pertanyaan' => 'Hasil dari 5 + 3 adalah?',
        //         'tipe' => 'pilihan_ganda',
        //         'skor' => 10,
        //         'kunci_jawaban' => '8',
        //     ],
        //     [
        //         'pertanyaan' => 'Bahasa pemrograman untuk web backend adalah?',
        //         'tipe' => 'pilihan_ganda',
        //         'skor' => 10,
        //         'kunci_jawaban' => 'PHP',
        //     ],

        //     // ESSAY
        //     [
        //         'pertanyaan' => 'Jelaskan pengertian algoritma!',
        //         'tipe' => 'essay',
        //         'skor' => 20,
        //         'kunci_jawaban' => null,
        //     ],
        //     [
        //         'pertanyaan' => 'Sebutkan fungsi database!',
        //         'tipe' => 'essay',
        //         'skor' => 20,
        //         'kunci_jawaban' => null,
        //     ],

        //     // TRUE / FALSE
        //     [
        //         'pertanyaan' => 'Laravel adalah framework PHP.',
        //         'tipe' => 'true_false',
        //         'skor' => 10,
        //         'kunci_jawaban' => 'true',
        //     ],
        //     [
        //         'pertanyaan' => 'CSS digunakan untuk membuat database.',
        //         'tipe' => 'true_false',
        //         'skor' => 10,
        //         'kunci_jawaban' => 'false',
        //     ],
        // ];

        // foreach ($soal as $item) {
        //     SiswaSoalEvaluasi::create([
        //         'id_siswa_evaluasi' => $siswaEvaluasiId,
        //         'pertanyaan' => $item['pertanyaan'],
        //         'tipe' => $item['tipe'],
        //         'skor' => $item['skor'],
        //         'kunci_jawaban' => $item['kunci_jawaban'],
        //     ]);
        // }
        
        // SiswaJawaban::factory()->count(50)->create();

        // $krsId = AkademikKrs::first()?->id;

        // if (!$krsId) {
        //     return; // stop jika belum ada KRS
        // }

        // // Ambil semua soal evaluasi
        // $soalList = SiswaSoalEvaluasi::all();

        // foreach ($soalList as $soal) {

        //     $jawaban = null;
        //     $skor = 0;

        //     switch ($soal->tipe) {
        //         case 'pilihan_ganda':
        //         case 'true_false':
        //             // jawaban benar
        //             $jawaban = $soal->kunci_jawaban;
        //             $skor = $soal->skor;
        //             break;

        //         case 'essay':
        //             $jawaban = 'Jawaban essay mahasiswa';
        //             // skor essay biasanya manual
        //             $skor = intval($soal->skor / 2);
        //             break;
        //     }

        //     SiswaJawaban::create([
        //         'id_soal_evaluasi' => $soal->id,
        //         'id_akademik_krs' => $krsId,
        //         'jawaban' => $jawaban,
        //         'skor' => $skor,
        //         'waktu_submit' => Carbon::now(),
        //     ]);
        // }

        // PertemuanKelas::factory()->count(10)->create();

        // $mapelKelasList = MataPelajaranKelas::pluck('id');

        // foreach ($mapelKelasList as $mapelKelasId) {
        //     for ($i = 1; $i <= 4; $i++) {
        //         PertemuanKelas::create([
        //             'id_mata_pelajaran_kelas' => $mapelKelasId,
        //             'pertemuan_ke' => $i,
        //             'tanggal' => Carbon::now()->addWeeks($i),
        //             'materi' => "Materi Pertemuan Ke-{$i}",
        //         ]);
        //     }
        // }

        // AbsensiSiswa::factory()->count(30)->create();

        // $krsId = AkademikKrs::first()?->id;

        // if (!$krsId) {
        //     return;
        // }

        // $statusList = ['Hadir', 'Izin', 'Sakit', 'Alpa'];

        // $pertemuanList = PertemuanKelas::pluck('id');

        // foreach ($pertemuanList as $pertemuanId) {
        //     AbsensiSiswa::create([
        //         'id_pertemuan' => $pertemuanId,
        //         'id_krs' => $krsId,
        //         'status' => $statusList[array_rand($statusList)],
        //         'waktu_absen' => Carbon::now(),
        //     ]);
        // }
        // $krsId = AkademikKrs::first()?->id;

        // if (!$krsId) {
        //     return;
        // }

        // // Ambil semua mata pelajaran kelas
        // $mapelKelasList = MataPelajaranKelas::pluck('id');

        // foreach ($mapelKelasList as $mapelKelasId) {
        //     SiswaDataLjk::create([
        //         'id_akademik_krs' => $krsId,
        //         'id_mata_pelajaran_kelas' => $mapelKelasId,
        //         'nilai' => rand(70, 95) + (rand(0, 99) / 100), // contoh 70.00 – 95.99
        //     ]);
        // }
        // SiswaDataLjk::factory()->count(20)->create();
    }
}
