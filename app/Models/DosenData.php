<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenData extends Model
{
    protected $table = 'dosen_data';
    protected $fillable = ['nama'];

    public function mataPelajaranKelas()
    {
        return $this->hasMany(MataPelajaranKelas::class, 'id_dosen_data');
    }
}
