<?php

namespace App\Filament\Resources\RuangKelas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RuangKelasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama'),
                TextInput::make('deskripsi'),
            ]);
    }
}
