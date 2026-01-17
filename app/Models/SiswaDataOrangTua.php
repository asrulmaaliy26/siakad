<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiswaDataOrangTua extends Model
{
    use HasFactory;
    protected $table = 'siswa_data_orang_tua';
    protected $fillable = ['nama', 'id_siswa_data'];

    public function siswa()
    {
        return $this->belongsTo(SiswaData::class, 'id_siswa_data');
    }
}
