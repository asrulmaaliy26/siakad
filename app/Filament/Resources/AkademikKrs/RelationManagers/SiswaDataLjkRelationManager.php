<?php

namespace App\Filament\Resources\AkademikKrs\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Models\MataPelajaranKelas;

class SiswaDataLjkRelationManager extends RelationManager
{
    protected static string $relationship = 'siswaDataLjk';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_mata_pelajaran_kelas')
                    ->label('Mata Pelajaran Kelas')
                    ->relationship('mataPelajaranKelas', 'id')
                    ->getOptionLabelFromRecordUsing(function (MataPelajaranKelas $record) {
                        $namaMatkul = $record->mataPelajaranKurikulum->mataPelajaranMaster->nama ?? '-';
                        $ruang = $record->ruangKelas->nama ?? '-';
                        return "{$namaMatkul} - {$record->hari}, {$record->jam} ({$ruang})";
                    })
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nilai')
            ->columns([
                TextColumn::make('mataPelajaranKelas.mataPelajaranKurikulum.mataPelajaranMaster.nama')
                    ->label('Mata Kuliah')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('mataPelajaranKelas.dosenData.nama')
                    ->label('Dosen Pengajar')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('mataPelajaranKelas.hari')
                    ->label('Hari')
                    ->sortable(),
                TextColumn::make('mataPelajaranKelas.jam')
                    ->label('Jam')
                    ->sortable(),
                TextColumn::make('mataPelajaranKelas.ruangKelas.nama')
                    ->label('Ruang')
                    ->placeholder('-'),
                TextColumn::make('Nilai_Huruf')
                    ->label('Nilai')
                    ->placeholder('-'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Mata Pelajaran'),
            ])
            ->actions([
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
