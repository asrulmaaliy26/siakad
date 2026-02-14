<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiswaDataPendaftar extends Model
{
    use HasFactory;
    protected $table = 'siswa_data_pendaftar';
    protected $fillable = [
        'nama',
        'id_siswa_data',
        // Data Dasar Pendaftaran
        'Nama_Lengkap',
        'No_Pendaftaran',
        'Tahun_Masuk',
        'Tgl_Daftar',
        'program_sekolah',
        'Kelas_Program_Kuliah',
        'Prodi_Pilihan_1',
        'Prodi_Pilihan_2',
        'Jalur_PMB',
        'Bukti_Jalur_PMB',
        'Jenis_Pembiayaan',
        'Bukti_Jenis_Pembiayaan',
        'Status_Pendaftaran',

        // Data Mutasi/Transfer
        'NIMKO_Asal',
        'Prodi_Asal',
        'PT_Asal',
        'Jml_SKS_Asal',
        'IPK_Asal',
        'Semester_Asal',
        'Pengantar_Mutasi',
        'Transkip_Asal',

        // Dokumen
        'Legalisir_Ijazah',
        'Legalisir_SKHU',
        'Copy_KTP',

        // Foto
        'Foto_BW_3x3',
        'Foto_BW_3x4',
        'Foto_Warna_5x6',
        'File_Foto_Berwarna',
        'Nama_File_Foto',

        // Tes Tulis
        'Tgl_Tes_Tulis',
        'N_Agama',
        'N_Umum',
        'N_Psiko',
        'N_Jumlah_Tes_Tulis',
        'N_Rerata_Tes_Tulis',

        // Tes Lisan
        'Tgl_Tes_Lisan',
        'N_Potensi_Akademik',
        'N_Baca_al_Quran',
        'N_Baca_Kitab_Kuning',
        'N_Jumlah_Tes_Lisan',
        'N_Rearata_Tes_Lisan',

        // Kelulusan
        'Jumlah_Nilai',
        'Rata_Rata',
        'Status_Kelulusan',
        'Rekomendasi_1',
        'Rekomendasi_2',
        'No_SK_Kelulusan',
        'Tgl_SK_Kelulusan',
        'Diterima_di_Prodi',

        // Pembayaran & Verifikasi
        'Biaya_Pendaftaran',
        'Bukti_Biaya_Daftar',
        'status_valid',
        'verifikator',
        'reff'
    ];

    public function siswa()
    {
        return $this->belongsTo(SiswaData::class, 'id_siswa_data');
    }
}
