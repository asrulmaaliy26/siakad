<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuangKelas extends Model
{
    protected $table = 'ruang_kelas';
    protected $fillable = ['nama', 'deskripsi'];

    public function mataPelajaranKelas()
    {
        return $this->hasMany(MataPelajaranKelas::class, 'id_ruang_kelas');
    }
}
