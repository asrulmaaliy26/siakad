<?php

namespace App\Filament\Resources\SiswaJawabans\Pages;

use App\Filament\Resources\SiswaJawabans\SiswaJawabanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSiswaJawabans extends ListRecords
{
    protected static string $resource = SiswaJawabanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
