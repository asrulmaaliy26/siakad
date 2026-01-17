<?php

namespace App\Filament\Resources\ProgramKelas;

use App\Filament\Resources\ProgramKelas\Pages\CreateProgramKelas;
use App\Filament\Resources\ProgramKelas\Pages\EditProgramKelas;
use App\Filament\Resources\ProgramKelas\Pages\ListProgramKelas;
use App\Filament\Resources\ProgramKelas\Schemas\ProgramKelasForm;
use App\Filament\Resources\ProgramKelas\Tables\ProgramKelasTable;
use App\Models\ProgramKelas;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProgramKelasResource extends Resource
{
    protected static ?string $model = ProgramKelas::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Perkuliahan';

    public static function form(Schema $schema): Schema
    {
        return ProgramKelasForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProgramKelasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProgramKelas::route('/'),
            'create' => CreateProgramKelas::route('/create'),
            'edit' => EditProgramKelas::route('/{record}/edit'),
        ];
    }
}
