<?php

namespace App\Filament\Resources\SiswaEvaluasis\Pages;

use App\Filament\Resources\SiswaEvaluasis\SiswaEvaluasiResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSiswaEvaluasi extends EditRecord
{
    protected static string $resource = SiswaEvaluasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
