<?php

namespace App\Filament\Resources\AkademikKrs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AkademikKrsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id_riwayat_pendidikan')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('riwayatPendidikan.siswa.nama')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('riwayat_pendidikan_siswa')
                    ->label('Riwayat Pendidikan / Siswa')
                    ->color('info')
                    ->getStateUsing(function ($record) {
                        return optional($record->riwayatPendidikan)->id
                            . ' - ' .
                            optional($record->riwayatPendidikan?->siswa)->nama;
                    }),
                TextColumn::make('kelas.programKelas.nama')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('semester')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status_bayar'),
                TextColumn::make('jumlah_sks')
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
