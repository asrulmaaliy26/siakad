<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaData extends Model
{
    protected $table = 'siswa_data';
    protected $fillable = ['nama', 'nomor_induk'];

    public function riwayatPendidikan()
    {
        return $this->hasMany(RiwayatPendidikan::class, 'id_siswa_data');
    }
}
