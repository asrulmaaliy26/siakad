<?php

namespace App\Filament\Resources\MataPelajaranKelas\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;

class JurnalPengajaranRelationManager extends RelationManager
{
    protected static string $relationship = 'jurnalPengajaran';

    protected static ?string $title = 'Jurnal Pengajaran';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('judul')
                    ->label('Judul Jurnal')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->maxLength(65535)
                    ->columnSpanFull(),

                Forms\Components\DatePicker::make('deadline')
                    ->label('Deadline'),

                Forms\Components\Select::make('status_akses')
                    ->options([
                        'Y' => 'Publik',
                        'N' => 'Private',
                    ])
                    ->required()
                    ->default('N'),

                Forms\Components\Select::make('dokumen')
                    ->multiple()
                    ->relationship('dokumen', 'judul_dokumen', function (Builder $query) {
                        // Filter documents: only show those belonging to the Dosen of this Class
                        return $query->where('id_dosen', $this->getOwnerRecord()->id_dosen_data);
                    })
                    ->preload()
                    ->label('Dokumen Terkait (Materi/Tugas Dosen)'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('judul')
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('dokumen')
                    ->label('Dokumen')
                    ->formatStateUsing(function ($record) {
                        return $record->dokumen->map(
                            fn($doc) =>
                            '<a href="' . asset('storage/' . $doc->file_path) . '" target="_blank" class="text-primary-600 underline hover:text-primary-500" title="' . e($doc->judul_dokumen) . '">' . \Illuminate\Support\Str::limit(e($doc->judul_dokumen), 20) . '</a>'
                        )->implode('<br>');
                    })
                    ->html(),

                Tables\Columns\TextColumn::make('mataPelajaranKelas.dosenData.nama')
                    ->label('Dosen')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('deadline')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status_akses')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Y' => 'success',
                        'N' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
                ViewAction::make(),
                Action::make('unduh_dokumen')
                    ->label('View Dokumen')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->modalHeading('Unduh Dokumen')
                    ->modalContent(fn($record) => new \Illuminate\Support\HtmlString(
                        '<ul class="space-y-2">' .
                            $record->dokumen->map(
                                fn($doc) =>
                                '<li><a href="' . asset('storage/' . $doc->file_path) . '" target="_blank" class="text-primary-600 hover:underline flex items-center gap-2">' .
                                    '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>' .
                                    e($doc->judul_dokumen) . '</a></li>'
                            )->implode('') .
                            '</ul>'
                    ))
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
