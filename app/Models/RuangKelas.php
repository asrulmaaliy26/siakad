<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RuangKelas extends Model
{
    use HasFactory;
    protected $table = 'ruang_kelas';
    protected $fillable = ['nama', 'deskripsi'];

    public function mataPelajaranKelas()
    {
        return $this->hasMany(MataPelajaranKelas::class, 'id_ruang_kelas');
    }
}
