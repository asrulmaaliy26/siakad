<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiswaJawaban extends Model
{
    use HasFactory;
    protected $table = 'siswa_jawaban';
    protected $fillable = [
        'id_soal_evaluasi',
        'id_akademik_krs',
        'jawaban',
        'skor',
        'waktu_submit'
    ];

    protected $dates = ['waktu_submit'];

    public function soal()
    {
        return $this->belongsTo(SiswaSoalEvaluasi::class, 'id_soal_evaluasi');
    }

    public function krs()
    {
        return $this->belongsTo(AkademikKrs::class, 'id_akademik_krs');
    }
}
