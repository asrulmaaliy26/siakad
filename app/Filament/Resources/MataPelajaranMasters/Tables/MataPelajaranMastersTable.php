<?php

namespace App\Filament\Resources\MataPelajaranMasters\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TextInputFilter;
use App\Models\MataPelajaranMaster;

class MataPelajaranMastersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_feeder')
                    ->searchable(),
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('jurusan.nama')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('bobot')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jenis'),
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
                SelectFilter::make('jurusan_id')
                    ->label('Jurusan')
                    ->relationship('jurusan', 'nama')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('jenis')
                    ->label('Jenis Mapel')
                    ->options([
                        'Wajib' => 'Wajib',
                        'Pilihan' => 'Pilihan',
                        'Muatan Lokal' => 'Muatan Lokal',
                    ]),

                // SelectFilter::make('nama')
                //     ->label('Nama Mapel')
                //     ->options(
                //         MataPelajaranMaster::query()
                //             ->pluck('nama', 'nama')
                //             ->toArray()
                //     )
                //     ->searchable(),
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
