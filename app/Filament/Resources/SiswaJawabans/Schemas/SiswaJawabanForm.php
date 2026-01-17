<?php

namespace App\Filament\Resources\SiswaJawabans\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SiswaJawabanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id_soal_evaluasi')
                    ->required()
                    ->numeric(),
                TextInput::make('id_akademik_krs')
                    ->required()
                    ->numeric(),
                Textarea::make('jawaban')
                    ->columnSpanFull(),
                TextInput::make('skor')
                    ->required()
                    ->numeric()
                    ->default(0),
                DateTimePicker::make('waktu_submit'),
            ]);
    }
}
