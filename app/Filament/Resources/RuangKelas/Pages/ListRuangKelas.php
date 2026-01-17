<?php

namespace App\Filament\Resources\RuangKelas\Pages;

use App\Filament\Resources\RuangKelas\RuangKelasResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRuangKelas extends ListRecords
{
    protected static string $resource = RuangKelasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
