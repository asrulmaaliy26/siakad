<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPendidikan extends Model
{
    protected $table = 'riwayat_pendidikan';
    protected $fillable = [
        'id_siswa_data',
        'id_jenjang_pendidikan',
        'id_jurusan',
        'status_siswa',
        'angkatan',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    public function siswa()
    {
        return $this->belongsTo(SiswaData::class, 'id_siswa_data');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
}
