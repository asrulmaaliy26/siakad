<?php

namespace App\Filament\Resources\SiswaData\Pages;

use App\Filament\Resources\SiswaData\SiswaDataResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSiswaData extends EditRecord
{
    protected static string $resource = SiswaDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    // protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('index'); // kembali ke list page
    // }
}
