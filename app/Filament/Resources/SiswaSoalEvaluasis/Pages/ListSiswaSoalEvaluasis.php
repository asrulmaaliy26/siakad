<?php

namespace App\Filament\Resources\SiswaSoalEvaluasis\Pages;

use App\Filament\Resources\SiswaSoalEvaluasis\SiswaSoalEvaluasiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSiswaSoalEvaluasis extends ListRecords
{
    protected static string $resource = SiswaSoalEvaluasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
