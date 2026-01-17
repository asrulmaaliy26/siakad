<?php

namespace App\Filament\Resources\SiswaSoalEvaluasis\Pages;

use App\Filament\Resources\SiswaSoalEvaluasis\SiswaSoalEvaluasiResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSiswaSoalEvaluasi extends EditRecord
{
    protected static string $resource = SiswaSoalEvaluasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
