<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaJenisEvaluasi extends Model
{
    protected $table = 'siswa_jenis_evaluasi';
    protected $fillable = ['nama', 'deskrispsi'];

    public function evaluasi()
    {
        return $this->hasMany(SiswaEvaluasi::class, 'id_siswa_jenis_evaluasi');
    }
}
