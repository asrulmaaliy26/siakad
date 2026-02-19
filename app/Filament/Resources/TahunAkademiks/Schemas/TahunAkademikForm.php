<?php

namespace App\Filament\Resources\TahunAkademiks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TahunAkademikForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama'),
                Select::make('periode')
                    ->options(['Genap' => 'Genap', 'Ganjil' => 'Ganjil']),
                \Filament\Forms\Components\Toggle::make('status')
                    ->label('Status Aktif')
                    ->formatStateUsing(fn($state) => $state === 'Y')
                    ->dehydrateStateUsing(fn($state) => $state ? 'Y' : 'N'),
            ]);
    }
}
