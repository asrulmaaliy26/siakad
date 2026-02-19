<?php

namespace App\Filament\Resources\MataPelajaranKurikulums\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MataPelajaranKurikulumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('id_kurikulum')
                    ->label('Kurikulum')
                    ->options(\App\Models\Kurikulum::pluck('nama', 'id'))
                    ->searchable()
                    ->required(),
                \Filament\Forms\Components\Select::make('id_mata_pelajaran_master')
                    ->label('Mata Pelajaran Master')
                    ->options(\App\Models\MataPelajaranMaster::pluck('nama', 'id'))
                    ->searchable()
                    ->required(),
                TextInput::make('semester')
                    ->numeric()
                    ->required(),
            ]);
    }
}
