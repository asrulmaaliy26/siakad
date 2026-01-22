<?php

namespace App\Filament\Resources\SiswaJenisEvaluasis;

use App\Filament\Resources\SiswaJenisEvaluasis\Pages\CreateSiswaJenisEvaluasi;
use App\Filament\Resources\SiswaJenisEvaluasis\Pages\EditSiswaJenisEvaluasi;
use App\Filament\Resources\SiswaJenisEvaluasis\Pages\ListSiswaJenisEvaluasis;
use App\Filament\Resources\SiswaJenisEvaluasis\Schemas\SiswaJenisEvaluasiForm;
use App\Filament\Resources\SiswaJenisEvaluasis\Tables\SiswaJenisEvaluasisTable;
use App\Models\SiswaJenisEvaluasi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SiswaJenisEvaluasiResource extends Resource
{
    protected static ?string $model = SiswaJenisEvaluasi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Temp';

    public static function form(Schema $schema): Schema
    {
        return SiswaJenisEvaluasiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SiswaJenisEvaluasisTable::configure($table);
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
            'index' => ListSiswaJenisEvaluasis::route('/'),
            'create' => CreateSiswaJenisEvaluasi::route('/create'),
            'edit' => EditSiswaJenisEvaluasi::route('/{record}/edit'),
        ];
    }
}
