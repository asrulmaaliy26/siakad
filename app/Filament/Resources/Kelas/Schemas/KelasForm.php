<?php

namespace App\Filament\Resources\Kelas\Schemas;

use App\Models\JenjangPendidikan;
use App\Models\TahunAkademik;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KelasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('ro_program_kelas')
                    ->label('Program Kelas')
                    ->relationship('programKelas', 'nilai')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('semester'),
                Select::make('id_tahun_akademik')
                    ->label('Tahun Akademik')
                    ->relationship('tahunAkademik', 'nama')
                    ->searchable()
                    ->preload(),
                Select::make('id_jurusan')
                    ->label('Jurusan')
                    ->relationship('jurusan', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('status_aktif')
                    ->options(['Y' => 'Aktif', 'N' => 'Tidak Aktif']),
            ]);
    }
}
