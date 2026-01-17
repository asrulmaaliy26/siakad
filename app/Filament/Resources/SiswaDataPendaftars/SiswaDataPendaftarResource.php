<?php

namespace App\Filament\Resources\SiswaDataPendaftars;

use App\Filament\Resources\SiswaDataPendaftars\Pages\CreateSiswaDataPendaftar;
use App\Filament\Resources\SiswaDataPendaftars\Pages\EditSiswaDataPendaftar;
use App\Filament\Resources\SiswaDataPendaftars\Pages\ListSiswaDataPendaftars;
use App\Filament\Resources\SiswaDataPendaftars\Schemas\SiswaDataPendaftarForm;
use App\Filament\Resources\SiswaDataPendaftars\Tables\SiswaDataPendaftarsTable;
use App\Models\SiswaDataPendaftar;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SiswaDataPendaftarResource extends Resource
{
    protected static ?string $model = SiswaDataPendaftar::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Master Data Siswa';

    public static function form(Schema $schema): Schema
    {
        return SiswaDataPendaftarForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SiswaDataPendaftarsTable::configure($table);
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
            'index' => ListSiswaDataPendaftars::route('/'),
            'create' => CreateSiswaDataPendaftar::route('/create'),
            'edit' => EditSiswaDataPendaftar::route('/{record}/edit'),
        ];
    }
}
