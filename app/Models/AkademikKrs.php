<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AkademikKrs extends Model
{
    use HasFactory;
    protected $table = 'akademik_krs';
    protected $fillable = [
        'id_riwayat_pendidikan',
        'id_kelas',
        'semester',
        'jumlah_sks',
        'tgl_krs',
        'kode_ta',
        'status_bayar',
        'syarat_uts',
        'syarat_krs',
        'kwitansi_krs',
        'status_aktif',
    ];


    public function riwayatPendidikan()
    {
        return $this->belongsTo(RiwayatPendidikan::class, 'id_riwayat_pendidikan');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function siswaDataLjk()
    {
        return $this->hasMany(SiswaDataLJK::class, 'id_akademik_krs');
    }

    public function absensiSiswa()
    {
        return $this->hasMany(AbsensiSiswa::class, 'id_krs');
    }
}
