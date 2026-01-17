<?php

namespace App\Filament\Resources\SiswaJenisEvaluasis\Pages;

use App\Filament\Resources\SiswaJenisEvaluasis\SiswaJenisEvaluasiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSiswaJenisEvaluasis extends ListRecords
{
    protected static string $resource = SiswaJenisEvaluasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
