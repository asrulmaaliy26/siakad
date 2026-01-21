<?php
namespace App\Filament\Resources\SiswaData\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class RiwayatPendidikanRelationManager extends RelationManager
{
    protected static string $relationship = 'riwayatPendidikan';
    protected static ?string $title = 'Riwayat Pendidikan';

    public function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\Select::make('id_jenjang_pendidikan')
                ->label('Jenjang Pendidikan')
                ->required(),

            Forms\Components\TextInput::make('angkatan'),
            Forms\Components\TextInput::make('nomor_induk'),
            Forms\Components\TextInput::make('status'),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('angkatan'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
