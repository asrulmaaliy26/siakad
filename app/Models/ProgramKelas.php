<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramKelas extends Model
{
    use HasFactory;
    protected $table = 'program_kelas';
    protected $fillable = ['nama'];

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_program_kelas');
    }
}
