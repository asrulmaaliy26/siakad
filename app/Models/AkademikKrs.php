<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AkademikKrs extends Model
{
    protected $table = 'akademik_krs';
    protected $fillable = [
        'id_riwayat_pendidikan',
        'id_kelas',
        'semester',
        'status_bayar',
        'jumlah_sks',
        'status_aktif'
    ];

    public function riwayatPendidikan()
    {
        return $this->belongsTo(RiwayatPendidikan::class, 'id_riwayat_pendidikan');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
