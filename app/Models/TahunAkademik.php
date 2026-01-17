<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    protected $table = 'tahun_akadmeik';
    protected $fillable = ['nama', 'periode', 'status'];
}
