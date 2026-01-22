<?php

namespace App\Filament\Resources\AkademikKrs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AkademikKrsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                
                // Relasi / Foreign Key
                TextColumn::make('riwayatPendidikan.nama')
                    ->label('Mahasiswa'), // Asumsi relasi bernama riwayatPendidikan

                TextColumn::make('kelas.nama')
                    ->label('Kelas'), // Asumsi relasi bernama kelas

                // Data KRS
                TextColumn::make('semester')
                    ->label('Semester'),

                // TextColumn::make('tahun_akademik')
                //     ->label('Tahun Akademik'),

                TextColumn::make('jumlah_sks')
                    ->label('SKS'),

                // Tables\Columns\TextColumn::make('kode_ta')
                //     ->label('Kode TA'),

                BadgeColumn::make('status_bayar')
                    ->label('Status Bayar')
                    ->formatStateUsing(fn($state) => $state === 'Y' ? 'Lunas' : 'Belum Lunas')
                    ->colors([
                        'success' => fn($state) => $state === 'Y',
                        'danger' => fn($state) => $state === 'N',
                    ]),

                BadgeColumn::make('syarat_uts')
                    ->label('Syarat UTS')
                    ->formatStateUsing(fn($state) => $state === 'Y' ? 'Terpenuhi' : 'Belum')
                    ->colors([
                        'success' => fn($state) => $state === 'Y',
                        'danger' => fn($state) => $state === 'N',
                    ]),

                BadgeColumn::make('syarat_krs')
                    ->label('Syarat KRS')
                    ->formatStateUsing(fn($state) => $state === 'Y' ? 'Terpenuhi' : 'Belum')
                    ->colors([
                        'success' => fn($state) => $state === 'Y',
                        'danger' => fn($state) => $state === 'N',
                    ]),

                BadgeColumn::make('status_aktif')
                    ->label('Status Aktif')
                    ->formatStateUsing(fn($state) => $state === 'Y' ? 'Aktif' : 'Tidak Aktif')
                    ->colors([
                        'success' => fn($state) => $state === 'Y',
                        'danger' => fn($state) => $state === 'N',
                    ]),

            ])
            ->filters([
                // Bisa tambahkan filter semester, tahun akademik, atau status_bayar
                SelectFilter::make('semester'),
                SelectFilter::make('tahun_akademik'),
                SelectFilter::make('status_bayar')
                    ->options([
                        'Y' => 'Lunas',
                        'N' => 'Belum Lunas',
                    ]),
            ])->headerActions([
                // CreateAction::make(),
            ])
            ->actions([
                // dd(EditAction::class),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
