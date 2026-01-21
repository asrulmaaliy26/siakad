<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiswaData extends Model
{
    use HasFactory;
    protected $table = 'siswa_data';
    protected $fillable = [
        'nama',
        'nama_lengkap',
        'id_pendaftaran',
        'jenis_kelamin',
        'gol_darah',
        'kota_lhr',
        'tgl_lhr',
        'alamat',
        'nomor_rumah',
        'dusun',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kabupaten',
        'kode_pos',
        'provinsi',
        'tempat_domisili',
        'jenis_domisili',
        'no_telepon_wa',
        'no_ktp',
        'no_kk',
        'agama',
        'kewarganegaraan',
        'kode_negara',
        'status_perkawinan',
        'pekerjaan',
        'biaya_ditanggung',
        'transportasi',
        'status_asal_sekolah',
        'asal_slta',
        'jenis_slta',
        'kejuruan_slta',
        'alamat_lengkap_sekolah_asal',
        'tahun_lulus_slta',
        'nomor_seri_ijazah_slta',
        'nisn',
        'anak_ke',
        'jumlah_saudara',
        'email',
        'penerima_kps',
        'no_kps',
        'kebutuhan_khusus',
        'foto_profil',
    ];


    public function riwayatPendidikan()
    {
        return $this->hasMany(RiwayatPendidikan::class, 'id_siswa_data');
    }
}
