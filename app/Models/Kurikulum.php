<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kurikulum extends Model
{
    use HasFactory;
    protected $table = 'kurikulum';
    protected $fillable = [
        'name',
        'id_jurusan',
        'id_tahun_akademik',
        // 'id_jenjang_pendidikan', // Derived from Jurusan
        'status_aktif'
    ];
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'id_tahun_akademik');
    }
    // public function jenjangPendidikan()
    // {
    //     return $this->belongsTo(JenjangPendidikan::class, 'id_jenjang_pendidikan');
    // }

    public function mataPelajaranKurikulum()
    {
        return $this->hasMany(MataPelajaranKurikulum::class, 'id_kurikulum');
    }
}
