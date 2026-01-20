<?php

namespace App\Filament\Resources\DosenData\Pages;

use App\Filament\Resources\DosenData\DosenDataResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDosenData extends CreateRecord
{
    protected static string $resource = DosenDataResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // kembali ke list page
    }
}
