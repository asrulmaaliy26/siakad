<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaranMaster extends Model
{
    protected $table = 'mata_pelajaran_master';
    protected $fillable = ['name', 'id_jurusan', 'bobot', 'jenis'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
}
