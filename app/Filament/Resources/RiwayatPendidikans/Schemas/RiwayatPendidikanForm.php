<?php

namespace App\Filament\Resources\RiwayatPendidikans\Schemas;

use App\Models\JenjangPendidikan;
use App\Models\Jurusan;
use App\Models\RefOption\StatusSiswa;
use App\Models\SiswaData;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RiwayatPendidikanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_siswa_data')
                    ->label('Data Siswa')
                    ->relationship('siswa', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('id_jurusan')
                    ->label('Jurusan')
                    ->relationship('jurusan', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('ro_status_siswa')
                    ->label('Status Siswa')
                    ->relationship('statusSiswa', 'nilai')
                    ->searchable()
                    ->preload(),
                TextInput::make('angkatan'),
                TextInput::make('nomor_induk'),
                DatePicker::make('tanggal_mulai'),
                DatePicker::make('tanggal_selesai'),
                Select::make('status')
                    ->options(['Aktif' => 'Aktif', 'Lulus' => 'Lulus', 'Keluar' => 'Keluar', 'Cuti' => 'Cuti']),
            ]);
    }
}
