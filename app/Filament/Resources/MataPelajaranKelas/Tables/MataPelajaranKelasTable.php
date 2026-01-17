<?php

namespace App\Filament\Resources\MataPelajaranKelas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\ColumnsToggle;

class MataPelajaranKelasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_mata_pelajaran_kurikulum')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('id_kelas')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('id_dosen_data')
                    ->numeric()
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

                TextColumn::make('id_ruang_kelas')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('mataPelajaranKurikulum.mataPelajaranMaster.id')
                    ->label('Kode Mata Pelajaran')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('mataPelajaranKurikulum.mataPelajaranMaster.name')
                    ->label('Nama Mata Pelajaran')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('mataPelajaranKurikulum.mataPelajaranMaster.bobot')
                    ->label('Bobot')
                    ->toggleable(),

                TextColumn::make('mataPelajaranKurikulum.mataPelajaranMaster.jenis')
                    ->label('Jenis')
                    ->toggleable(),

                TextColumn::make('mataPelajaranKurikulum.kurikulum.name')
                    ->label('Kurikulum')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('mataPelajaranKurikulum.kurikulum.jurusan.nama')
                    ->label('Jurusan')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('dosen.nama')
                    ->label('Dosen')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('kelas.id')
                    ->label('ID Kelas')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('kelas.programKelas.nama')
                    ->label('Program Kelas')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('kelas.semester')
                    ->label('Semester Kelas')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('kelas.tahunAkademik.nama')
                    ->label('Tahun Akademik')
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('kelas.semester')
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
