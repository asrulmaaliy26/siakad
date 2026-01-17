<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    protected $table = 'kurikulum';
    protected $fillable = [
        'name',
        'id_jurusan',
        'id_tahun_akademik',
        'id_jenjang_pendidikan',
        'status_aktif'
    ];
}
