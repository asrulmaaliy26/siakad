<?php

namespace App\Filament\Resources\ProgramKelas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProgramKelasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama'),
            ]);
    }
}
