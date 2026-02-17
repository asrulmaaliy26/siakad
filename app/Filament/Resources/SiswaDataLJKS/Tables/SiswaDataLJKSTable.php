<?php

namespace App\Filament\Resources\SiswaDataLJKS\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Models\MataPelajaranKelas;

class SiswaDataLJKSTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('akademikKrs.riwayatPendidikan.siswa.nama')
                    ->label('Nama Peserta')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('akademikKrs.riwayatPendidikan.nomor_induk')
                    ->label('NIM')
                    ->searchable(),

                TextColumn::make('mataPelajaranKelas.mataPelajaranKurikulum.mataPelajaranMaster.nama')
                    ->label('Mata Kuliah')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('mataPelajaranKelas.dosen.nama')
                    ->label('Dosen')
                    ->sortable(),

                TextColumn::make('nilai')
                    ->label('Nilai')
                    ->numeric(decimalPlaces: 2)
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Tanggal Input')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('id_mata_pelajaran_kelas')
                    ->label('Mata Pelajaran Kelas')
                    ->relationship('mataPelajaranKelas', 'id')
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        $matkul = optional($record->mataPelajaranKurikulum->mataPelajaranMaster)->nama ?? '-';
                        $kelas = optional($record->kelas->programKelas)->nilai ?? '-';
                        $dosen = optional($record->dosen)->nama ?? '-';
                        return "$matkul - $kelas ($dosen)";
                    })
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    \pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ])
            // ->toolbarActions([])
            ->headerActions([
                \pxlrbt\FilamentExcel\Actions\Tables\ExportAction::make()
            ])
            ->defaultSort('created_at', 'desc');
    }
}
