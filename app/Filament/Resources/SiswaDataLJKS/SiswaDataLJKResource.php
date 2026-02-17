<?php

namespace App\Filament\Resources\SiswaDataLJKS;

use App\Filament\Resources\SiswaDataLJKS\Pages\CreateSiswaDataLJK;
use App\Filament\Resources\SiswaDataLJKS\Pages\EditSiswaDataLJK;
use App\Filament\Resources\SiswaDataLJKS\Pages\ListSiswaDataLJKS;
use App\Filament\Resources\SiswaDataLJKS\Schemas\SiswaDataLJKForm;
use App\Filament\Resources\SiswaDataLJKS\Tables\SiswaDataLJKSTable;
use App\Models\SiswaDataLJK;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SiswaDataLJKResource extends Resource
{
    protected static ?string $model = SiswaDataLJK::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string | UnitEnum | null $navigationGroup = 'Perkuliahan';
    protected static ?int $navigationSort = 15;
    protected static ?string $navigationLabel = 'Nilai';

    public static function form(Schema $schema): Schema
    {
        return SiswaDataLJKForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SiswaDataLJKSTable::configure($table);
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
            'index' => ListSiswaDataLJKS::route('/'),
            'create' => CreateSiswaDataLJK::route('/create'),
            'edit' => EditSiswaDataLJK::route('/{record}/edit'),
        ];
    }
}
