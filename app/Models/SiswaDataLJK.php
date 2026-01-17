<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaDataLJK extends Model
{
   protected $table = 'siswa_data_ljk';
    // protected $primaryKey = 'id_data_ljk';

    protected $fillable = [
        'id_krs',
        'id_mata_pelajaran_kelas',
        'nilai'
    ];

    protected $casts = [
        'nilai' => 'float'
    ];

    /* ================= RELATIONS ================= */

    public function krs()
    {
        return $this->belongsTo(AkademikKrs::class, 'id_akadmik_krs');
    }

    public function mataPelajaranKelas()
    {
        return $this->belongsTo(
            MataPelajaranKelas::class,
            'id_mata_pelajaran_kelas'
        );
    }
}
