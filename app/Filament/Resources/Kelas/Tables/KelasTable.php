<?php

namespace App\Filament\Resources\Kelas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KelasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_program_kelas')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('semester')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('id_jenjang_pendidikan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('id_tahun_akademik')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status_aktif'),
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
