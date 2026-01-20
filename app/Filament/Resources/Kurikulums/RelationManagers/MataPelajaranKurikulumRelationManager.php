<?php

namespace App\Filament\Resources\Kurikulums\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Log;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class MataPelajaranKurikulumRelationManager extends RelationManager
{
    protected static string $relationship = 'mataPelajaranKurikulum';

    protected static ?string $title = 'Mata Pelajaran Kurikulum';

    public function form(Schema $form): Schema
    {
        return $form->schema([
            MultiSelect::make('mata_pelajaran_master_ids')
                ->label('Mata Pelajaran')
                // ->relationship('mataPelajaranMaster', 'nama')
                ->options(
                    \App\Models\MataPelajaranMaster::pluck('nama', 'id')
                )
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
                    ->label('Tambah Mata Pelajaran')

                    ->using(function (array $data, RelationManager $livewire) {

                        Log::info('CreateAction raw data', $data);

                        $mapelIds = $data['mata_pelajaran_master_ids'] ?? [];

                        if (empty($mapelIds)) {
                            Log::warning('Tidak ada mata pelajaran dipilih', $data);
                            return null;
                        }

                        $kurikulum = $livewire->getOwnerRecord();

                        foreach ($mapelIds as $idMapel) {
                            $kurikulum->mataPelajaranKurikulum()->create([
                                'id_mata_pelajaran_master' => $idMapel,
                                'semester' => $data['semester'],
                            ]);
                        }

                        return null; // hentikan default create
                    }),
            ])
            ->actions([
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
        ;
    }
}
