<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PertemuanKelas extends Model
{
    use HasFactory, \App\Traits\HasActiveAcademicYear, \App\Traits\HasJenjangScope;

    public function scopeByJenjang($query, $jenjangId)
    {
        // Path: pertemuan_kelas -> mata_pelajaran_kelas -> kelas -> jurusan -> id_jenjang_pendidikan
        return $query->whereHas('mataPelajaranKelas.kelas.jurusan', function ($q) use ($jenjangId) {
            $q->where('id_jenjang_pendidikan', $jenjangId);
        });
    }

    protected $table = 'pertemuan_kelas';
    protected $fillable = [
        'id_mata_pelajaran_kelas',
        'pertemuan_ke',
        'tanggal',
        'materi'
    ];

    public function mataPelajaranKelas()
    {
        return $this->belongsTo(
            MataPelajaranKelas::class,
            'id_mata_pelajaran_kelas'
        );
    }
}
