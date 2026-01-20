<?php

namespace App\Filament\Resources\DosenData\Pages;

use App\Filament\Resources\DosenData\DosenDataResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDosenData extends EditRecord
{
    protected static string $resource = DosenDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // kembali ke list page
    }
}
