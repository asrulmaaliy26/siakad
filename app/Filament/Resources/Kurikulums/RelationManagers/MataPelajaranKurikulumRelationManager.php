<?php

namespace App\Filament\Resources\Kurikulums\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
// use Filament\Tables\Actions\CreateAction;
use Filament\Forms\Components\MultiSelect;
use Filament\Schemas\Schema;
// use Filament\Tables\Actions\DeleteAction;

class MataPelajaranKurikulumRelationManager extends RelationManager
{
    protected static string $relationship = 'mataPelajaranKurikulum';

    protected static ?string $title = 'Mata Pelajaran Kurikulum';

    public function form(Schema $form): Schema
    {
        return $form->schema([
            Select::make('mata_pelajaran_ids')
                ->label('Mata Pelajaran')
                ->relationship('mataPelajaranMaster', 'nama')
                ->searchable()
                ->preload()
                ->required(),

            TextInput::make('semester')
                ->numeric()
                ->minValue(1)
                ->required(),
        ]);
    }


    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('mataPelajaranMaster.nama')
                    ->label('Mata Pelajaran'),

                TextColumn::make('semester'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Mata Pelajaran'),
                // AttachAction::make(),
            ])
            // ->recordActions([
            //     ViewAction::make(),
            //     EditAction::make(),
            //     DetachAction::make(),
            //     DeleteAction::make(),
            // ])

            ->actions([
                DeleteAction::make(),
            ]);
    }
}
