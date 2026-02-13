<?php

namespace App\Filament\Resources\AkademikKrs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Support\Colors\Color;

class AkademikKrsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                // Relasi / Foreign Key
                TextColumn::make('riwayatPendidikan.siswaData.nama')
                    ->label('Mahasiswa')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold'),

                TextColumn::make('riwayatPendidikan.siswaData.nomor_induk')
                    ->label('NIM')
                    ->searchable()
                    ->sortable()
                    ->color('gray')
                    ->copyable()
                    ->copyMessage('NIM berhasil disalin'),

                // Data KRS
                TextColumn::make('semester')
                    ->label('Semester')
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn($state) => "Semester {$state}"),

                TextColumn::make('jumlah_sks')
                    ->label('SKS')
                    ->sortable()
                    ->badge()
                    ->color(fn($state) => $state >= 20 ? 'success' : ($state >= 15 ? 'warning' : 'danger'))
                    ->formatStateUsing(fn($state) => "{$state} SKS"),

                // Status Bayar dengan Badge
                SelectColumn::make('status_bayar')
                    ->label('Status Bayar')
                    ->options([
                        'Y' => 'Lunas',
                        'N' => 'Belum Lunas',
                    ])
                    ->selectablePlaceholder(false)
                    ->sortable()
                    ->extraAttributes(function ($state) {
                        $colors = [
                            'Y' => 'bg-emerald-100 text-emerald-800 border-emerald-200 font-medium px-3 py-1.5 rounded-lg text-center',
                            'N' => 'bg-rose-100 text-rose-800 border-rose-200 font-medium px-3 py-1.5 rounded-lg text-center',
                        ];
                        return ['class' => $colors[$state] ?? 'bg-gray-100 text-gray-800'];
                    }),

                // Syarat UTS dengan Badge
                SelectColumn::make('syarat_uts')
                    ->label('Syarat UTS')
                    ->options([
                        'Y' => '✅ Terpenuhi',
                        'N' => '❌ Belum',
                    ])
                    ->selectablePlaceholder(false)
                    ->extraAttributes(function ($state) {
                        $colors = [
                            'Y' => 'bg-emerald-100 text-emerald-800 border-emerald-200 font-medium px-3 py-1.5 rounded-lg text-center',
                            'N' => 'bg-amber-100 text-amber-800 border-amber-200 font-medium px-3 py-1.5 rounded-lg text-center',
                        ];
                        return ['class' => $colors[$state] ?? 'bg-gray-100 text-gray-800'];
                    }),

                // Syarat UAS dengan Badge
                SelectColumn::make('syarat_uas')
                    ->label('Syarat UAS')
                    ->options([
                        'Y' => '✅ Terpenuhi',
                        'N' => '❌ Belum',
                    ])
                    ->selectablePlaceholder(false)
                    ->extraAttributes(function ($state) {
                        $colors = [
                            'Y' => 'bg-emerald-100 text-emerald-800 border-emerald-200 font-medium px-3 py-1.5 rounded-lg text-center',
                            'N' => 'bg-amber-100 text-amber-800 border-amber-200 font-medium px-3 py-1.5 rounded-lg text-center',
                        ];
                        return ['class' => $colors[$state] ?? 'bg-gray-100 text-gray-800'];
                    }),

                // Syarat KRS dengan Badge
                SelectColumn::make('syarat_krs')
                    ->label('Syarat KRS')
                    ->options([
                        'Y' => '✅ Terpenuhi',
                        'N' => '❌ Belum',
                    ])
                    ->selectablePlaceholder(false)
                    ->extraAttributes(function ($state) {
                        $colors = [
                            'Y' => 'bg-emerald-100 text-emerald-800 border-emerald-200 font-medium px-3 py-1.5 rounded-lg text-center',
                            'N' => 'bg-amber-100 text-amber-800 border-amber-200 font-medium px-3 py-1.5 rounded-lg text-center',
                        ];
                        return ['class' => $colors[$state] ?? 'bg-gray-100 text-gray-800'];
                    }),

                // Status Aktif dengan Badge
                SelectColumn::make('status_aktif')
                    ->label('Status Aktif')
                    ->options([
                        'Y' => '🟢 Aktif',
                        'N' => '🔴 Tidak Aktif',
                    ])
                    ->selectablePlaceholder(false)
                    ->extraAttributes(function ($state) {
                        $colors = [
                            'Y' => 'bg-emerald-100 text-emerald-800 border-emerald-200 font-medium px-3 py-1.5 rounded-lg text-center',
                            'N' => 'bg-slate-100 text-slate-800 border-slate-200 font-medium px-3 py-1.5 rounded-lg text-center',
                        ];
                        return ['class' => $colors[$state] ?? 'bg-gray-100 text-gray-800'];
                    }),

            ])
            ->filters([
                SelectFilter::make('semester')
                    ->options([
                        '1' => 'Semester 1',
                        '2' => 'Semester 2',
                        '3' => 'Semester 3',
                        '4' => 'Semester 4',
                        '5' => 'Semester 5',
                        '6' => 'Semester 6',
                        '7' => 'Semester 7',
                        '8' => 'Semester 8',
                    ])
                    ->searchable()
                    ->preload(),

                SelectFilter::make('tahun_akademik')
                    ->label('Tahun Akademik')
                    ->options([
                        '2023/2024' => '2023/2024',
                        '2024/2025' => '2024/2025',
                    ])
                    ->searchable(),

                SelectFilter::make('status_bayar')
                    ->label('Status Bayar')
                    ->options([
                        'Y' => '✅ Lunas',
                        'N' => '❌ Belum Lunas',
                    ]),
            ])
            ->headerActions([])
            ->actions([
                ViewAction::make(),
                Action::make('view_subjects')
                    ->label('Mata Pelajaran')
                    ->icon('heroicon-o-book-open')
                    ->color('info')
                    ->modalHeading('Daftar Mata Pelajaran')
                    ->modalContent(fn($record) => view('filament.resources.akademik-krs.actions.view-subjects', ['record' => $record]))
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false)
                    ->closeModalByClickingAway(false),

                EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-o-pencil')
                    ->color('primary'),

                DeleteAction::make()
                    ->label('Hapus')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                DeleteBulkAction::make()
                    ->label('Hapus Terpilih')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation(),
            ]);
    }
}
