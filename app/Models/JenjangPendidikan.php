<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenjangPendidikan extends Model
{
    protected $table = 'jenjang_pendidikan';
    protected $fillable = ['nama', 'deskripsi'];

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_jenjang_pendidikan');
    }

    public function riwayatPendidikan()
    {
        return $this->hasMany(RiwayatPendidikan::class, 'id_jenjang_pendidikan');
    }
}
