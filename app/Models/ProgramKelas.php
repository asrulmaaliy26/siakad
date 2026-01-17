<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramKelas extends Model
{
    protected $table = 'program_kelas';
    protected $fillable = ['nama'];

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_program_kelas');
    }
}
