<?php

namespace App\Filament\Resources\MataPelajaranMasters\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;

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
                    // ->numeric()
                    ->searchable()
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
                    ExportBulkAction::make()
                        ->label('Export Excel')
                        ->exports([
                            ExcelExport::make()
                                ->withColumns([
                                    Column::make('kode_feeder')->heading('Kode Feeder'),
                                    Column::make('nama')->heading('Nama Mata Pelajaran'),
                                    Column::make('jurusan.nama')->heading('Jurusan'),
                                    Column::make('bobot')->heading('Bobot'),
                                    Column::make('jenis')->heading('Jenis'),
                                ])
                                ->withFilename(
                                    fn() =>
                                    'mata-pelajaran-terpilih-' . now()->format('Y-m-d')
                                ),
                        ]),

                    DeleteBulkAction::make(),
                ]),
            ]);
            // ->headerActions([
            //     ExportAction::make()
            //         ->exports([
            //             ExcelExport::make()
            //                 ->fromTable()
            //                 ->withFilename('mata-pelajaran')
            //                 ->withColumns([
            //                     Column::make('kode_feeder')->heading('Kode Feeder'),
            //                     Column::make('nama')->heading('Nama'),
            //                     Column::make('jurusan.nama')->heading('Jurusan'),
            //                     Column::make('bobot')->heading('Bobot'),
            //                     Column::make('jenis')->heading('Jenis'),
            //                 ]),
            //         ]),
            // ]);
    }
}
