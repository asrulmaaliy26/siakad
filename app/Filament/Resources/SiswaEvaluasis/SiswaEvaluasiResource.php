<?php

namespace App\Filament\Resources\SiswaEvaluasis;

use App\Filament\Resources\SiswaEvaluasis\Pages\CreateSiswaEvaluasi;
use App\Filament\Resources\SiswaEvaluasis\Pages\EditSiswaEvaluasi;
use App\Filament\Resources\SiswaEvaluasis\Pages\ListSiswaEvaluasis;
use App\Filament\Resources\SiswaEvaluasis\Schemas\SiswaEvaluasiForm;
use App\Filament\Resources\SiswaEvaluasis\Tables\SiswaEvaluasisTable;
use App\Models\SiswaEvaluasi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
class SiswaEvaluasiResource extends Resource
{
    protected static ?string $model = SiswaEvaluasi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Temp';

    public static function form(Schema $schema): Schema
    {
        return SiswaEvaluasiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SiswaEvaluasisTable::configure($table);
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
            'index' => ListSiswaEvaluasis::route('/'),
            'create' => CreateSiswaEvaluasi::route('/create'),
            'edit' => EditSiswaEvaluasi::route('/{record}/edit'),
        ];
    }
}
