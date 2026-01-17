<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiswaSoalEvaluasi extends Model
{
    use HasFactory;
    protected $table = 'siswa_soal_evaluasi';
    protected $fillable = [
        'id_siswa_data',
        'is_soal_evaluasi',
        'pertanyaan',
        'tipe',
        'skor',
        'kunci_jawaban'
    ];

    protected $casts = [
        'is_soal_evaluasi' => 'boolean'
    ];

    public function siswa()
    {
        return $this->belongsTo(SiswaData::class, 'id_siswa_data');
    }

    public function jawaban()
    {
        return $this->hasMany(SiswaJawaban::class, 'id_soal_evaluasi');
    }
}
