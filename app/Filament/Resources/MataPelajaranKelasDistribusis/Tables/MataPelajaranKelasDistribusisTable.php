<?php

namespace App\Filament\Resources\MataPelajaranKelasDistribusis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MataPelajaranKelasDistribusisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_mata_pelajaran_kurikulum')
                    ->numeric()
                    ->label('id')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('kelas.programKelas.nama')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('mataPelajaranKurikulum.mataPelajaranMaster.kode_feeder')
                    ->label('kode')
                    // ->sortable()
                    ->toggleable(),

                TextColumn::make('dosen.nama')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('uts')
                    ->date()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('uas')
                    ->date()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('ruangKelas.nama')
                    ->sortable()
                    ->toggleable(),
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
