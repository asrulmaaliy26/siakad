<?php

namespace App\Filament\Resources\SiswaSoalEvaluasis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiswaSoalEvaluasisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('is_soal_evaluasi')
                    ->boolean(),
                TextColumn::make('id_siswa_data')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tipe')
                    ->searchable(),
                TextColumn::make('skor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('kunci_jawaban')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
