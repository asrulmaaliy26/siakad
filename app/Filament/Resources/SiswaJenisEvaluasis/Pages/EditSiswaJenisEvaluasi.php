<?php

namespace App\Filament\Resources\SiswaJenisEvaluasis\Pages;

use App\Filament\Resources\SiswaJenisEvaluasis\SiswaJenisEvaluasiResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSiswaJenisEvaluasi extends EditRecord
{
    protected static string $resource = SiswaJenisEvaluasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
