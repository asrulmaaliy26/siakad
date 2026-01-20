<?php

namespace App\Filament\Resources\SiswaData\Pages;

use App\Filament\Resources\SiswaData\SiswaDataResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSiswaData extends CreateRecord
{
    protected static string $resource = SiswaDataResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // kembali ke list page
    }
}
