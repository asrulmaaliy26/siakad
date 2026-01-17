<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiswaJenisEvaluasi extends Model
{
    use HasFactory;
    protected $table = 'siswa_jenis_evaluasi';
    protected $fillable = ['nama', 'deskrispsi'];

    public function evaluasi()
    {
        return $this->hasMany(SiswaEvaluasi::class, 'id_siswa_jenis_evaluasi');
    }
}
