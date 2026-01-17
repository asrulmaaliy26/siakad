<?php

namespace App\Filament\Resources\Kurikulums\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KurikulumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name'),
                TextInput::make('id_jurusan')
                    ->numeric(),
                TextInput::make('id_tahun_akademik')
                    ->numeric(),
                TextInput::make('id_jenjang_pendidikan')
                    ->numeric(),
                Select::make('status_aktif')
                    ->options(['Y' => 'Y', 'N' => 'N']),
            ]);
    }
}
