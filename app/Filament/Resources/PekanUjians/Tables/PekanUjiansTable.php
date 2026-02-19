<?php

namespace App\Filament\Resources\PekanUjians\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\ToggleColumn;
use App\Helpers\SiakadRole;

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

                SelectColumn::make('jenis_ujian')
                    ->label('Jenis Ujian')
                    ->options([
                        'UTS' => 'UTS',
                        'UAS' => 'UAS',
                    ])
                    ->selectablePlaceholder(false)
                    ->sortable()
                    ->searchable()
                    ->disabled(fn() => auth()->user()->hasRole(SiakadRole::MAHASISWA) && !auth()->user()->hasAnyRole([SiakadRole::SUPER_ADMIN, SiakadRole::ADMIN])),

                ToggleColumn::make('status_akses')
                    ->label('Status Akses')
                    ->onColor('success')
                    ->offColor('danger')
                    ->disabled(fn() => \Filament\Facades\Filament::auth()->user()?->hasRole(SiakadRole::MAHASISWA) && !\Filament\Facades\Filament::auth()->user()?->hasAnyRole([SiakadRole::SUPER_ADMIN, SiakadRole::ADMIN])),

                ToggleColumn::make('status_bayar')
                    ->label('Syarat Pembayaran')
                    ->onColor('success')
                    ->offColor('warning')
                    ->disabled(fn() => \Filament\Facades\Filament::auth()->user()?->hasRole(SiakadRole::MAHASISWA) && !\Filament\Facades\Filament::auth()->user()?->hasAnyRole([SiakadRole::SUPER_ADMIN, SiakadRole::ADMIN])),

                ToggleColumn::make('status_ujian')
                    ->label('Status Aktif')
                    ->onColor('success')
                    ->offColor('gray')
                    ->disabled(fn() => \Filament\Facades\Filament::auth()->user()?->hasRole(SiakadRole::MAHASISWA) && !\Filament\Facades\Filament::auth()->user()?->hasAnyRole([SiakadRole::SUPER_ADMIN, SiakadRole::ADMIN])),

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
                    \pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                \pxlrbt\FilamentExcel\Actions\Tables\ExportAction::make()
            ]);
    }
}
