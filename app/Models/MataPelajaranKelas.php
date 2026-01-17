<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'id_ruang_kelas'
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
        return $this->belongsTo(RuangKelas::class, 'id_ruang_kelas');
    }
}
