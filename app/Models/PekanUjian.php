<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PekanUjian extends Model
{
    use HasFactory, \App\Traits\HasActiveAcademicYear, \App\Traits\HasJenjangScope;

    protected $table = 'pekan_ujian';

    protected $guarded = [];

    // Jika ingin explicit fillable, uncomment. Tapi guarded=[] lebih fleksibel.
    protected $fillable = [
        'id_tahun_akademik',
        'id_jenjang_pendidikan',
        'jenis_ujian',
        'status_akses',
        'status_bayar',
        'status_ujian',
        'informasi',
    ];

    public function scopeByJenjang($query, $jenjangId)
    {
        return $query->where('id_jenjang_pendidikan', $jenjangId);
    }

    public function tahunAkademik(): BelongsTo
    {
        return $this->belongsTo(TahunAkademik::class, 'id_tahun_akademik');
    }

    public function jenjangPendidikan(): BelongsTo
    {
        return $this->belongsTo(JenjangPendidikan::class, 'id_jenjang_pendidikan');
    }

    // Relasi ke Mata Pelajaran Kelas
    // Note: Relasi ini kompleks (PekanUjian -> TahunAkademik <- Kelas <- MataPelajaranKelas).
    // Tidak bisa menggunakan hasManyThrough standar karena arah relasi yang tidak linear.
    // Logic query akan di-handle di MataPelajaranKelasRelationManager::getRelationship().
    public function mataPelajaranKelas(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(
            MataPelajaranKelas::class,
            Kelas::class,
            'id_tahun_akademik', // Foreign key on Kelas
            'id_kelas',          // Foreign key on MataPelajaranKelas
            'id_tahun_akademik', // Local key on PekanUjian
            'id'                 // Local key on Kelas
        );
    }

    // Alternatif: Jika relasi lebih sederhana (langsung)
    public function mataPelajaranKelasLangsung()
    {
        return $this->belongsToMany(
            MataPelajaranKelas::class,
            'pekan_ujian_mata_pelajaran', // Nama tabel pivot (jika ada)
            'id_pekan_ujian',
            'id_mata_pelajaran_kelas'
        )->withTimestamps();
    }
    protected function statusAkses(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn($value) => $value === 'Y',
            set: fn($value) => $value ? 'Y' : 'N',
        );
    }

    protected function statusBayar(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn($value) => $value === 'Y',
            set: fn($value) => $value ? 'Y' : 'N',
        );
    }

    protected function statusUjian(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn($value) => $value === 'Y', // Assuming 'Y' is meant to be Active/True
            set: fn($value) => $value ? 'Y' : 'N', // If true, set 'Y', else 'N'
        );
    }
}
