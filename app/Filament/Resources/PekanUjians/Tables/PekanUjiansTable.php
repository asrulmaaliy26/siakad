<?php

namespace App\Filament\Resources\PekanUjians\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PekanUjiansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tahunAkademik.nama')
                    ->label('Tahun Akademik')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('jenis_ujian')
                    ->label('Jenis Ujian')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->colors([
                        'primary' => 'UTS',
                        'warning' => 'UAS',
                        'danger' => 'Remedial',
                    ]),

                TextColumn::make('status_akses')
                    ->label('Status Akses')
                    ->badge()
                    ->colors([
                        'success' => 'Buka',
                        'danger' => 'Tutup',
                    ]),

                TextColumn::make('status_bayar')
                    ->label('Syarat Pembayaran')
                    ->badge()
                    ->colors([
                        'success' => 'Bebas',
                        'warning' => 'Wajib',
                    ]),

                TextColumn::make('status_ujian')
                    ->label('Status Aktif')
                    ->badge()
                    ->colors([
                        'success' => 'Aktif',
                        'gray' => 'Tidak Aktif',
                    ]),

                TextColumn::make('informasi')
                    ->label('Informasi')
                    ->limit(50)
                    ->wrap(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
