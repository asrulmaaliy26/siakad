<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiswaSoalEvaluasi extends Model
{
    use HasFactory;
    protected $table = 'siswa_soal_evaluasi';
    protected $fillable = [
        'is_siswa_evaluasi',
        'pertanyaan',
        'tipe',
        'skor',
        'kunci_jawaban'
    ];

    protected $casts = [
        'is_soal_evaluasi' => 'boolean'
    ];

    public function siswaEvaluasi()
    {
        return $this->belongsTo(SiswaEvaluasi::class, 'id_siswa_evaluasi');
    }

    public function jawaban()
    {
        return $this->hasMany(SiswaJawaban::class, 'id_soal_evaluasi');
    }
}
