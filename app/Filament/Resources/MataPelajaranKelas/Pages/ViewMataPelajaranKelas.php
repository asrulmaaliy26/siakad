<?php

namespace App\Filament\Resources\MataPelajaranKelas\Pages;

use App\Filament\Resources\MataPelajaranKelas\MataPelajaranKelasResource;
use App\Models\AkademikKrs;
use App\Models\AbsensiSiswa;
use App\Models\SiswaDataLJK;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;

class ViewMataPelajaranKelas extends ViewRecord
{

    protected static string $resource = MataPelajaranKelasResource::class;

    protected string $view = 'filament.resources.mata-pelajaran-kelas.pages.view-mata-pelajaran-kelas';

    public $activeTab = 'mahasiswa';

    public function infolist(Schema $schema): Schema
    {
        return \App\Filament\Resources\MataPelajaranKelas\Schemas\MataPelajaranKelasForm::configure($schema)
            ->disabled();
    }

    public function getMahasiswaDataProperty()
    {
        return AkademikKrs::query()
            ->where('id_kelas', $this->record->id_kelas)
            ->with(['riwayatPendidikan.siswaData', 'riwayatPendidikan.jurusan', 'kelas.programKelas'])
            ->get()
            ->map(function ($krs) {
                $krs->hadir_count = AbsensiSiswa::where('id_krs', $krs->id)
                    ->where('id_mata_pelajaran_kelas', $this->record->id)
                    ->where('status', 'Hadir')
                    ->count();

                $krs->sakit_count = AbsensiSiswa::where('id_krs', $krs->id)
                    ->where('id_mata_pelajaran_kelas', $this->record->id)
                    ->where('status', 'Sakit')
                    ->count();

                $krs->izin_count = AbsensiSiswa::where('id_krs', $krs->id)
                    ->where('id_mata_pelajaran_kelas', $this->record->id)
                    ->where('status', 'Izin')
                    ->count();

                $krs->alpa_count = AbsensiSiswa::where('id_krs', $krs->id)
                    ->where('id_mata_pelajaran_kelas', $this->record->id)
                    ->where('status', 'Alpa')
                    ->count();

                return $krs;
            });
    }

    public function getPenilaianDataProperty()
    {
        return SiswaDataLJK::query()
            ->where('id_mata_pelajaran_kelas', $this->record->id)
            ->with(['akademikKrs.riwayatPendidikan.siswaData'])
            ->get();
    }

    public function loadTables()
    {
        // Method dipanggil oleh wire:init di blade
        // Data akan dimuat via computed properties
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
