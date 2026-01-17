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
        'id_jenjang_pendidikan',
        'status_aktif'
    ];
}
