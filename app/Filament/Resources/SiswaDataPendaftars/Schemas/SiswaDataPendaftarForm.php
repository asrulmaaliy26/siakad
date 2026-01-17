<?php

namespace App\Filament\Resources\SiswaDataPendaftars\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiswaDataPendaftarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama'),
                TextInput::make('id_siswa_data')
                    ->numeric(),
            ]);
    }
}
