<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenjangPendidikan extends Model
{
    protected $table = 'jenjang_pendidikan';

    // Karena tidak ada created_at & updated_at
    public $timestamps = false;

    // Karena tidak ada primary key
    protected $primaryKey = null;
    public $incrementing = false;

    // Proteksi mass assignment
    protected $fillable = [
        'id_jenjang_pendidikan',
        'nama',
        'deskripsi',
    ];
}
