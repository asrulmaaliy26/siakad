<?php

namespace App\Filament\Resources\SiswaData\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\SelectColumn;

class SiswaDataTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('riwayatPendidikanAktif.angkatan')
                    ->label('Angkatan')
                    ->searchable(),
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('riwayatPendidikanAktif.nomor_induk')
                    ->label('Nomor Induk')
                    ->searchable(),
                TextColumn::make('riwayatPendidikanAktif.programSekolah.nilai')
                    ->searchable()
                    ->label('Program Sekolah'),
                TextColumn::make('riwayatPendidikanAktif.jurusan.nama')
                    ->searchable()
                    ->label('Jurusan'),
                TextColumn::make('riwayatPendidikanAktif.statusSiswa.nilai')
                    ->label('Status Pendidikan')
                    ->searchable(),
                SelectColumn::make('status_siswa')
                    ->label('Status Siswa')
                    ->options([
                        'aktif' => 'Aktif',
                        'tidak aktif' => 'Tidak Aktif',
                    ])
                    ->sortable()
                    ->searchable()
                    ->afterStateUpdated(function ($state, $record) {
                        if ($state === 'aktif') {
                            $pendaftar = $record->pendaftar;

                            if (!$pendaftar) {
                                \Filament\Notifications\Notification::make()
                                    ->title('Data Pendaftar Tidak Ditemukan')
                                    ->body('Siswa ini tidak memiliki data pendaftaran.')
                                    ->warning()
                                    ->send();
                                return;
                            }

                            if (
                                !$pendaftar->id_jurusan ||
                                !$pendaftar->ro_program_sekolah
                            ) {
                                \Filament\Notifications\Notification::make()
                                    ->title('Data Belum Lengkap')
                                    ->body('Jurusan atau Program Sekolah belum terisi di data pendaftar.')
                                    ->danger()
                                    ->send();
                            } else {
                                // Cek apakah sudah ada riwayat pendidikan yang sama agar tidak duplikat
                                $exists = \App\Models\RiwayatPendidikan::where('id_siswa_data', $record->id)
                                    // ->where('id_jenjang_pendidikan', $pendaftar->id_jenjang_pendidikan) // Removed
                                    ->where('id_jurusan', $pendaftar->id_jurusan)
                                    ->where('ro_program_sekolah', $pendaftar->ro_program_sekolah)
                                    ->exists();

                                if (!$exists) {
                                    \App\Models\RiwayatPendidikan::create([
                                        'id_siswa_data' => $record->id,
                                        // 'id_jenjang_pendidikan' => $pendaftar->id_jenjang_pendidikan, // Removed
                                        'id_jurusan' => $pendaftar->id_jurusan,
                                        'ro_program_sekolah' => $pendaftar->ro_program_sekolah,
                                        'th_masuk' => $pendaftar->Tahun_Masuk ?? date('Y'),
                                        'angkatan' => $pendaftar->Tahun_Masuk ?? date('Y'),
                                        'tanggal_mulai' => now(),
                                        'status' => 'Aktif', // Sesuaikan dengan tipe data kolom status di riwayat_pendidikan
                                    ]);

                                    \Filament\Notifications\Notification::make()
                                        ->title('Riwayat Pendidikan Dibuat')
                                        ->body('Riwayat pendidikan berhasil dibuat otomatis.')
                                        ->success()
                                        ->send();
                                } else {
                                    \Filament\Notifications\Notification::make()
                                        ->title('Info')
                                        ->body('Riwayat pendidikan sudah ada.')
                                        ->info()
                                        ->send();
                                }
                            }
                        }
                    }),
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
                SelectFilter::make('status_siswa')
                    ->label('Status Siswa')
                    ->options([
                        'aktif' => 'Aktif',
                        'tidak aktif' => 'Tidak Aktif',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    \pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ])
            ->toolbarActions([])
            ->headerActions([
                \pxlrbt\FilamentExcel\Actions\Tables\ExportAction::make()
            ]);
    }
}
