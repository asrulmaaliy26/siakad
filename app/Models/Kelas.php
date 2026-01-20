<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $fillable = [
        'id_program_kelas',
        'semester',
        'id_jenjang_pendidikan',
        'id_tahun_akademik',
        'id_jurusan',
        'status_aktif'
    ];

    public function programKelas()
    {
        return $this->belongsTo(ProgramKelas::class, 'id_program_kelas');
    }

    public function jenjangPendidikan()
    {
        return $this->belongsTo(JenjangPendidikan::class, 'id_jenjang_pendidikan');
    }

    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'id_tahun_akademik');
    }
    public function jurusan()
    {
        return $this->belongsTo(TahunAkademik::class, 'id_jurusan');
    }
}
