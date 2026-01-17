<?php

namespace App\Filament\Resources\SiswaDataPendaftars\Pages;

use App\Filament\Resources\SiswaDataPendaftars\SiswaDataPendaftarResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSiswaDataPendaftars extends ListRecords
{
    protected static string $resource = SiswaDataPendaftarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
