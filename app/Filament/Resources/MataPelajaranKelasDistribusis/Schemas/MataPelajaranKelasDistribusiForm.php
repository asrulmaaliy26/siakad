<?php

namespace App\Filament\Resources\MataPelajaranKelasDistribusis\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MataPelajaranKelasDistribusiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('id_mata_pelajaran_kurikulum')
                    ->numeric(),
                TextInput::make('id_kelas')
                    ->numeric(),
                TextInput::make('id_dosen_data')
                    ->numeric(),
                DatePicker::make('uts'),
                DatePicker::make('uas'),
                TextInput::make('id_ruang_kelas')
                    ->numeric(),
            ]);
    }
}
