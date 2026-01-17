<?php

namespace App\Filament\Resources\MataPelajaranMasters\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MataPelajaranMasterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('id_jurusan')
                    ->numeric(),
                TextInput::make('bobot')
                    ->numeric(),
                Select::make('jenis')
                    ->options(['wajib' => 'Wajib', 'peminatan' => 'Peminatan']),
            ]);
    }
}
