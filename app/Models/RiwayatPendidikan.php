<?php

namespace App\Models;

use App\Models\RefOption\StatusSiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\SiswaData;
use App\Models\Jurusan;
use App\Models\JenjangPendidikan;
use App\Models\AkademikKrs;

class RiwayatPendidikan extends Model
{
    use HasFactory;
    protected $table = 'riwayat_pendidikan';
    protected $fillable = [
        'id_siswa_data',
        'id_jenjang_pendidikan',
        'id_jurusan',
        'nomor_induk',
        'id_status_siswa',
        'angkatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'foto_profil',
        'mulai_smt',
        'smt_aktif',
        'th_masuk',
        'dosen_wali',
        'no_seri_ijazah',
        'sks_diakui',
        'jalur_skripsi',
        'judul_skripsi',
        'bln_awal_bimbingan',
        'bln_akhir_bimbingan',
        'sk_yudisium',
        'tgl_sk_yudisium',
        'ipk',
        'nm_pt_asal',
        'nm_prodi_asal',
        'jns_daftar',
        'jns_keluar',
        'keluar_smt',
        'status_keluar',
        'keterangan',
        'jalur_masuk',
        'pembiayaan',
        'status',
    ];

    public function siswa()
    {
        return $this->belongsTo(SiswaData::class, 'id_siswa_data');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
    public function jenjangPendidikan()
    {
        return $this->belongsTo(JenjangPendidikan::class, 'id_jenjang_pendidikan');
    }
    public function akademikKrs()
    {
        return $this->hasMany(AkademikKrs::class, 'id_riwayat_pendidikan');
    }

    // public function akademikKrs()
    // {
    //     return $this->hasMany(
    //         AkademikKrs::class,
    //         'id_riwayat_pendidikan',
    //         'id'
    //     );
    // }

    // ref option

    public function statusSiswa()
    {
        return $this->belongsTo(StatusSiswa::class, 'id_status_siswa');
    }

}
