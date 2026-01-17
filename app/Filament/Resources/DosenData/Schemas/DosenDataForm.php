<?php

namespace App\Filament\Resources\DosenData\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DosenDataForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama'),
            ]);
    }
}
