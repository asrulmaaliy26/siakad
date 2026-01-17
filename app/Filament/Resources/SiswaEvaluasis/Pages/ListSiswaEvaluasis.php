<?php

namespace App\Filament\Resources\SiswaEvaluasis\Pages;

use App\Filament\Resources\SiswaEvaluasis\SiswaEvaluasiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSiswaEvaluasis extends ListRecords
{
    protected static string $resource = SiswaEvaluasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
