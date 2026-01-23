<?php

namespace App\Filament\Resources\MataPelajaranKelas\Schemas;

use App\Models\DosenData;
use App\Models\Kelas;
use App\Models\RefOption\RuangKelas;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MataPelajaranKelasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id_mata_pelajaran_kurikulum')
                    ->numeric(),
                Select::make('id_kelas')
                    ->label('Kelas')
                    ->options(Kelas::pluck('nama', 'id'))
                    ->searchable(),
                Select::make('id_dosen_data')
                    ->label('Dosen')
                    ->options(DosenData::pluck('nama', 'id'))
                    ->searchable(),
                DatePicker::make('uts'),
                DatePicker::make('uas'),
                
                Select::make('ro_ruang_kelas')
                    ->label('Ruang Kelas')
                    ->options(RuangKelas::pluck('nilai', 'id'))
                    ->searchable(),
            ]);
    }
}
