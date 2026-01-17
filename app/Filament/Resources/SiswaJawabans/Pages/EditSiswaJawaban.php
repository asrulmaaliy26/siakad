<?php

namespace App\Filament\Resources\SiswaJawabans\Pages;

use App\Filament\Resources\SiswaJawabans\SiswaJawabanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSiswaJawaban extends EditRecord
{
    protected static string $resource = SiswaJawabanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
