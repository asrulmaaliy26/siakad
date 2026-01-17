<?php

namespace App\Filament\Resources\SiswaData\Pages;

use App\Filament\Resources\SiswaData\SiswaDataResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSiswaData extends ListRecords
{
    protected static string $resource = SiswaDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
