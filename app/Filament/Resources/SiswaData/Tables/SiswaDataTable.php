<?php

namespace App\Filament\Resources\SiswaData\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiswaDataTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('riwayatPendidikan.angkatan')
                    ->label('Angkatan')
                    ->searchable(),
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('riwayatPendidikan.nomor_induk')
                    ->label('Nomor Induk')
                    ->searchable(),
                TextColumn::make('riwayatPendidikan.programSekolah.nilai')
                    ->searchable(),
                TextColumn::make('riwayatPendidikan.jurusan.nama')
                    ->searchable(),
                TextColumn::make('riwayatPendidikan.statusSiswa.nilai')
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
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
