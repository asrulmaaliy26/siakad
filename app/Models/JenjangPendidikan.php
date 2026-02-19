<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenjangPendidikan extends Model
{
    use HasFactory;
    protected $table = 'jenjang_pendidikan';
    protected $fillable = ['nama', 'deskripsi', 'type'];

    public function jurusan()
    {
        return $this->hasMany(Jurusan::class, 'id_jenjang_pendidikan');
    }

    public function kelas()
    {
        return $this->hasManyThrough(Kelas::class, Jurusan::class, 'id_jenjang_pendidikan', 'id_jurusan');
    }

    public function riwayatPendidikan()
    {
        return $this->hasManyThrough(RiwayatPendidikan::class, Jurusan::class, 'id_jenjang_pendidikan', 'id_jurusan');
    }

    public function pendaftar()
    {
        return $this->hasManyThrough(SiswaDataPendaftar::class, Jurusan::class, 'id_jenjang_pendidikan', 'id_jurusan');
    }
}
