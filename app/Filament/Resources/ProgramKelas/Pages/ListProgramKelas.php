<?php

namespace App\Filament\Resources\ProgramKelas\Pages;

use App\Filament\Resources\ProgramKelas\ProgramKelasResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProgramKelas extends ListRecords
{
    protected static string $resource = ProgramKelasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
