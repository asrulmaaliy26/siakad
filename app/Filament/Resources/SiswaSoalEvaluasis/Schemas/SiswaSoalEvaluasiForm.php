<?php

namespace App\Filament\Resources\SiswaSoalEvaluasis\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SiswaSoalEvaluasiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Toggle::make('is_soal_evaluasi')
                    ->required(),
                TextInput::make('id_siswa_data')
                    ->required()
                    ->numeric(),
                Textarea::make('pertanyaan')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('tipe')
                    ->required(),
                TextInput::make('skor')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('kunci_jawaban'),
            ]);
    }
}
