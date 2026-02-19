<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fakultas extends Model
{
    use HasFactory, \App\Traits\HasJenjangScope;
    protected $table = 'fakultas';
    protected $fillable = ['nama'];

    /**
     * Scope query to only include faculties that have jurusans in the given jenjang.
     */
    public function scopeByJenjang($query, $jenjangId)
    {
        return $query->whereHas('jurusan', function ($q) use ($jenjangId) {
            $q->where('id_jenjang_pendidikan', $jenjangId);
        });
    }

    public function jurusan()
    {
        return $this->hasMany(Jurusan::class, 'id_fakultas');
    }
}
