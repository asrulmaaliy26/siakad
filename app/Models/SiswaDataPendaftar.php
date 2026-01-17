<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaDataPendaftar extends Model
{
    protected $table = 'siswa_data_pendaftar';
    protected $fillable = ['nama', 'id_siswa_data'];

    public function siswa()
    {
        return $this->belongsTo(SiswaData::class, 'id_siswa_data');
    }
}
