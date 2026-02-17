<?php

namespace App\Helpers;

use App\Models\TahunAkademik;
use App\Models\SiswaData;
use App\Models\DosenData;
use App\Models\DosenDokumen;
use App\Models\SiswaDataLJK;
use App\Models\RiwayatPendidikan;
use App\Models\AkademikKrs;
use App\Models\MataPelajaranKelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UploadPathHelper
{
    public static function uploadPath($record, string $column, string $fallbackType = 'umum', callable $get = null)
    {
        // 1. Tahun Akademik
        $tahun = self::getYear($record, $get);

        // 2. Jenjang Pendidikan
        $jenjang = self::getJenjang($record, $get);

        // 3. Tipe (Siswa / Dosen / Umum)
        $type = self::getType($record, $fallbackType);

        // 4. Column
        return "uploads/" . Str::slug($tahun) . "/" . Str::slug($jenjang) . "/" . Str::slug($type) . "/" . Str::slug($column);
    }

    protected static function getYear($record, $get = null)
    {
        if ($record instanceof SiswaDataLJK) {
            return $record->mataPelajaranKelas?->kelas?->tahunAkademik?->nama ?? self::fetchActiveYear();
        }

        if ($record instanceof AkademikKrs) {
            return $record->kelas?->tahunAkademik?->nama ?? self::fetchActiveYear();
        }

        if ($record instanceof MataPelajaranKelas) {
            return $record->kelas?->tahunAkademik?->nama ?? self::fetchActiveYear();
        }

        if ($get) {
            if ($mpkId = $get('id_mata_pelajaran_kelas')) {
                $mpk = \App\Models\MataPelajaranKelas::find($mpkId);
                return $mpk?->kelas?->tahunAkademik?->nama ?? self::fetchActiveYear();
            }
            if ($kelasId = $get('id_kelas')) {
                $kelas = \App\Models\Kelas::find($kelasId);
                return $kelas?->tahunAkademik?->nama ?? self::fetchActiveYear();
            }
        }

        return self::fetchActiveYear();
    }

    protected static function fetchActiveYear()
    {
        return TahunAkademik::where('status', 'Aktif')->value('nama') ?? date('Y');
    }

    protected static function getJenjang($record, $get = null)
    {
        if ($record instanceof SiswaDataLJK) {
            return $record->akademikKrs?->riwayatPendidikan?->jurusan?->jenjangPendidikan?->nama ?? 'umum';
        }

        if ($record instanceof MataPelajaranKelas) {
            return $record->kelas?->jurusan?->jenjangPendidikan?->nama ?? 'umum';
        }

        if ($record instanceof SiswaData) {
            return $record->riwayatPendidikanAktif?->jurusan?->jenjangPendidikan?->nama ?? 'umum';
        }

        if ($record instanceof AkademikKrs) {
            return $record->riwayatPendidikan?->jurusan?->jenjangPendidikan?->nama ?? 'umum';
        }

        if ($record instanceof \App\Models\RiwayatPendidikan) {
            return $record->jurusan?->jenjangPendidikan?->nama ?? 'umum';
        }

        if ($record instanceof \App\Models\SiswaDataPendaftar) {
            return $record->jurusan?->jenjangPendidikan?->nama ?? 'umum';
        }

        // Try using $get if record is null
        if ($get) {
            if ($riwayatId = $get('id_riwayat_pendidikan')) {
                $riwayat = RiwayatPendidikan::find($riwayatId);
                return $riwayat?->jurusan?->jenjangPendidikan?->nama ?? 'umum';
            }
            if ($jurusanId = $get('id_jurusan')) {
                $jurusan = \App\Models\Jurusan::find($jurusanId);
                return $jurusan?->jenjangPendidikan?->nama ?? 'umum';
            }
            if ($mpkId = $get('id_mata_pelajaran_kelas')) {
                $mpk = MataPelajaranKelas::find($mpkId);
                return $mpk?->kelas?->jurusan?->jenjangPendidikan?->nama ?? 'umum';
            }
            if ($siswaId = $get('id_siswa_data')) {
                $siswa = SiswaData::find($siswaId);
                return $siswa?->riwayatPendidikanAktif?->jurusan?->jenjangPendidikan?->nama ?? 'umum';
            }
            if ($krsId = $get('id_akademik_krs')) {
                $krs = AkademikKrs::find($krsId);
                // krs -> riwayat -> jurusan -> jenjang
                return $krs?->riwayatPendidikan?->jurusan?->jenjangPendidikan?->nama ?? 'umum';
            }
            if ($kelasId = $get('id_kelas')) {
                $kelas = \App\Models\Kelas::find($kelasId);
                return $kelas?->jurusan?->jenjangPendidikan?->nama ?? 'umum';
            }
        }

        return 'umum';
    }

    protected static function getType($record, $fallback)
    {
        if ($record instanceof SiswaData || $record instanceof SiswaDataLJK || $record instanceof RiwayatPendidikan || $record instanceof AkademikKrs) {
            return 'siswa';
        }

        if ($record instanceof DosenData || $record instanceof DosenDokumen || $record instanceof MataPelajaranKelas) {
            return 'dosen';
        }

        return $fallback;
    }
}
