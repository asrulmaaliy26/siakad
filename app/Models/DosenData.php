<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\RefOption\JabatanFungsional;
use App\Models\RefOption\PangkatGolongan;
use App\Models\RefOption\Agama;
use App\Models\RefOption\StatusDosen;

class DosenData extends Model
{
    use HasFactory;
    protected $table = 'dosen_data';
    protected $fillable = [
        'nama',
        'NIPDN',
        'NIY',
        'gelar_depan',
        'gelar_belakang',
        'id_pangkat_gol',
        'id_jabatan',
        'id_jurusan',
        'email',
        'tanggal_lahir',
        'jenis_kelamin',
        'ibu_kandung',
        'kewarganegaraan',
        'Alamat',
        'status_kawin',
        'id_status_dosen',
        'id_agama',
    ];

    public function mataPelajaranKelas()
    {
        return $this->hasMany(MataPelajaranKelas::class, 'id_dosen_data');
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    // Relasi ke ProgramKelas
    public function jabaanFungsional()
    {
        return $this->belongsTo(JabatanFungsional::class, 'id_program_kelas');
    }

    public function pangkat()
    {
        return $this->belongsTo(PangkatGolongan::class, 'id_pangkat_gol');
    }

    public function statusDosen()
    {
        return $this->belongsTo(StatusDosen::class, 'id_status_dosen');
    }
    public function agama()
    {
        return $this->belongsTo(Agama::class, 'id_agama');
    }

}
