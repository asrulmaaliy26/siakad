<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\RefOption\RuangKelas;

class MataPelajaranKelas extends Model
{
    use HasFactory;
    protected $table = 'mata_pelajaran_kelas';
    protected $fillable = [
        'id_mata_pelajaran_kurikulum',
        'id_kelas',
        'id_dosen_data',
        'uts',
        'uas',
        'ro_ruang_kelas'
    ];

    public function mataPelajaranKurikulum()
    {
        return $this->belongsTo(
            MataPelajaranKurikulum::class,
            'id_mata_pelajaran_kurikulum'
        );
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function dosen()
    {
        return $this->belongsTo(DosenData::class, 'id_dosen_data');
    }

    public function ruangKelas()
    {
        return $this->belongsTo(RuangKelas::class, 'ro_ruang_kelas');
    }

    public function pertemuanKelas()
    {
        return $this->hasMany(
            PertemuanKelas::class,
            'id_mata_pelajaran_kelas',
            'id'
        );
    }

    public function siswaDataLjk()
    {
        return $this->hasMany(SiswaDataLJK::class, 'id_mata_pelajaran_kelas');
    }

    public function absensiSiswa()
    {
        return $this->hasMany(AbsensiSiswa::class, 'id_mata_pelajaran_kelas');
    }
}
