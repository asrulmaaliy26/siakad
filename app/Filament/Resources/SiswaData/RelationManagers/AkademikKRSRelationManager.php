<?php

namespace App\Filament\Resources\SiswaData\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class AkademikKRSRelationManager extends RelationManager
{
    protected static string $relationship = 'akademikKrs';
    protected static ?string $title = 'Akademik KRS';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('semester'),
            Forms\Components\TextInput::make('tahun_akademik'),
            Forms\Components\TextInput::make('status_bayar')
                ->label('Status Bayar'),
            Forms\Components\TextInput::make('jumlah_sks')
                ->label('Jumlah SKS'),
            Forms\Components\DatePicker::make('tgl_krs')
                ->label('Tanggal KRS'),
            Forms\Components\TextInput::make('kode_ta')
                ->label('Kode TA'),
            // Forms\Components\TextInput::make('syarat_uts')
            //     ->label('Syarat UTS'),
            Forms\Components\TextInput::make('syarat_krs')
                ->label('Syarat KRS'),
            Forms\Components\TextInput::make('kwitansi_krs')
                ->label('Kwitansi KRS'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('semester'),
                Tables\Columns\TextColumn::make('tahun_akademik'),
                Tables\Columns\TextColumn::make('status_bayar')->badge(),
                Tables\Columns\TextColumn::make('jumlah_sks')->label('SKS'),
                Tables\Columns\TextColumn::make('tgl_krs')->date(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                // dd(EditAction::class),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
