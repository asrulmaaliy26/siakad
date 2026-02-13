<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PekanUjian extends Model
{
    use HasFactory;

    protected $table = 'pekan_ujian';

    protected $guarded = [];

    // Jika ingin explicit fillable, uncomment. Tapi guarded=[] lebih fleksibel.
    protected $fillable = [
        'id_tahun_akademik',
        'jenis_ujian',
        'status_akses',
        'status_bayar',
        'status_ujian',
        'informasi',
    ];

    public function tahunAkademik(): BelongsTo
    {
        return $this->belongsTo(TahunAkademik::class, 'id_tahun_akademik');
    }
}
