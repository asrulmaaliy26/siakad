<?php

namespace App\Filament\Resources\Kelas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KelasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_program_kelas')
                    ->label('Program Kelas')
                    ->options(\App\Models\RefOption\ProgramKelas::pluck('nilai', 'id'))
                    ->searchable()
                    ->required(),
                TextInput::make('semester')
                    ->numeric(),
                TextInput::make('id_jenjang_pendidikan')
                    ->numeric(),
                TextInput::make('id_tahun_akademik')
                    ->numeric(),
                Select::make('status_aktif')
                    ->options(['Y' => 'Y', 'N' => 'N']),
            ]);
    }
}
