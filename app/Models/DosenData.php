<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DosenData extends Model
{
    use HasFactory;
    protected $table = 'dosen_data';
    protected $fillable = ['nama'];

    public function mataPelajaranKelas()
    {
        return $this->hasMany(MataPelajaranKelas::class, 'id_dosen_data');
    }
}
