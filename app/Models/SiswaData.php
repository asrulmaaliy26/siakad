<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiswaData extends Model
{
    use HasFactory;
    protected $table = 'siswa_data';
    protected $fillable = ['nama', 'nomor_induk'];

    public function riwayatPendidikan()
    {
        return $this->hasMany(RiwayatPendidikan::class, 'id_siswa_data');
    }
}
