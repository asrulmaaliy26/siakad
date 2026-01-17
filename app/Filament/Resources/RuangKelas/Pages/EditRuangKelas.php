<?php

namespace App\Filament\Resources\RuangKelas\Pages;

use App\Filament\Resources\RuangKelas\RuangKelasResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRuangKelas extends EditRecord
{
    protected static string $resource = RuangKelasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
