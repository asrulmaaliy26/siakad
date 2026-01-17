<?php

namespace App\Filament\Resources\SiswaEvaluasis\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiswaEvaluasiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id_mata_pelajaran_kelas')
                    ->numeric(),
                TextInput::make('id_siswa_jenis_evaluasi')
                    ->numeric(),
                DatePicker::make('tanggal'),
                TextInput::make('keterangan'),
            ]);
    }
}
