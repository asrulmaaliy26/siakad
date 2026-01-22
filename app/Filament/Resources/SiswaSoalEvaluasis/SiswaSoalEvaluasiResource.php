<?php

namespace App\Filament\Resources\SiswaSoalEvaluasis;

use App\Filament\Resources\SiswaSoalEvaluasis\Pages\CreateSiswaSoalEvaluasi;
use App\Filament\Resources\SiswaSoalEvaluasis\Pages\EditSiswaSoalEvaluasi;
use App\Filament\Resources\SiswaSoalEvaluasis\Pages\ListSiswaSoalEvaluasis;
use App\Filament\Resources\SiswaSoalEvaluasis\Schemas\SiswaSoalEvaluasiForm;
use App\Filament\Resources\SiswaSoalEvaluasis\Tables\SiswaSoalEvaluasisTable;
use App\Models\SiswaSoalEvaluasi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SiswaSoalEvaluasiResource extends Resource
{
    protected static ?string $model = SiswaSoalEvaluasi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Temp';

    public static function form(Schema $schema): Schema
    {
        return SiswaSoalEvaluasiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SiswaSoalEvaluasisTable::configure($table);
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
            'index' => ListSiswaSoalEvaluasis::route('/'),
            'create' => CreateSiswaSoalEvaluasi::route('/create'),
            'edit' => EditSiswaSoalEvaluasi::route('/{record}/edit'),
        ];
    }
}
