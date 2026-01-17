<?php

namespace App\Filament\Resources\RiwayatPendidikans\Schemas;

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
                TextInput::make('id_siswa_data')
                    ->numeric(),
                TextInput::make('id_jenjang_pendidikan')
                    ->numeric(),
                TextInput::make('id_jurusan')
                    ->numeric(),
                Select::make('status_siswa')
                    ->options(['DO' => 'D o', 'Aktif' => 'Aktif']),
                TextInput::make('angkatan'),
                DatePicker::make('tanggal_mulai'),
                DatePicker::make('tanggal_selesai'),
            ]);
    }
}
