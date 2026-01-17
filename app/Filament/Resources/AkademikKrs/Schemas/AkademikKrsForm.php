<?php

namespace App\Filament\Resources\AkademikKrs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AkademikKrsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id_riwayat_pendidikan')
                    ->numeric(),
                TextInput::make('id_kelas')
                    ->numeric(),
                TextInput::make('semester')
                    ->numeric(),
                Select::make('status_bayar')
                    ->options(['Y' => 'Y', 'N' => 'N']),
                TextInput::make('jumlah_sks')
                    ->numeric(),
                Select::make('status_aktif')
                    ->options(['Y' => 'Y', 'N' => 'N']),
            ]);
    }
}
