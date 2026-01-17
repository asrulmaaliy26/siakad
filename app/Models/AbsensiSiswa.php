<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AbsensiSiswa extends Model
{
    use HasFactory;
    protected $table = 'absensi_siswa';
    protected $fillable = [
        'id_pertemuan',
        'id_krs',
        'status',
        'waktu_absen'
    ];

    protected $dates = ['waktu_absen'];

    public function pertemuan()
    {
        return $this->belongsTo(PertemuanKelas::class, 'id_pertemuan');
    }

    public function krs()
    {
        return $this->belongsTo(AkademikKrs::class, 'id_krs');
    }
}
