<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaEvaluasi extends Model
{
    use HasFactory;
    protected $table = 'siswa_evaluasi';
    protected $fillable = [
        'id_mata_pelajaran_kelas',
        'id_siswa_jenis_evaluasi',
        'tanggal',
        'keterangan'
    ];

    public function mataPelajaranKelas()
    {
        return $this->belongsTo(
            MataPelajaranKelas::class,
            'id_mata_pelajaran_kelas'
        );
    }

    public function siswaJenisEvaluasi()
    {
        return $this->belongsTo(
            SiswaJenisEvaluasi::class,
            'id_siswa_jenis_evaluasi'
        );
    }
}
