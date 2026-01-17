<?php

namespace App\Filament\Resources\ProgramKelas\Pages;

use App\Filament\Resources\ProgramKelas\ProgramKelasResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProgramKelas extends EditRecord
{
    protected static string $resource = ProgramKelasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
