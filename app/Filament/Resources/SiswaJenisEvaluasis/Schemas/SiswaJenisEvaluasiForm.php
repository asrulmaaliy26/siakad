<?php

namespace App\Filament\Resources\SiswaJenisEvaluasis\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SiswaJenisEvaluasiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                Textarea::make('deskrispsi')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
