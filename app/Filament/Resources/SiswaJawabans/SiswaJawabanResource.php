<?php

namespace App\Filament\Resources\SiswaJawabans;

use App\Filament\Resources\SiswaJawabans\Pages\CreateSiswaJawaban;
use App\Filament\Resources\SiswaJawabans\Pages\EditSiswaJawaban;
use App\Filament\Resources\SiswaJawabans\Pages\ListSiswaJawabans;
use App\Filament\Resources\SiswaJawabans\Schemas\SiswaJawabanForm;
use App\Filament\Resources\SiswaJawabans\Tables\SiswaJawabansTable;
use App\Models\SiswaJawaban;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SiswaJawabanResource extends Resource
{
    protected static ?string $model = SiswaJawaban::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Temp';

    public static function form(Schema $schema): Schema
    {
        return SiswaJawabanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SiswaJawabansTable::configure($table);
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
            'index' => ListSiswaJawabans::route('/'),
            'create' => CreateSiswaJawaban::route('/create'),
            'edit' => EditSiswaJawaban::route('/{record}/edit'),
        ];
    }
}
