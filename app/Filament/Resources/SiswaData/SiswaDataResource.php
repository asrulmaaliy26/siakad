<?php

namespace App\Filament\Resources\SiswaData;

use App\Filament\Resources\SiswaData\Pages\CreateSiswaData;
use App\Filament\Resources\SiswaData\Pages\EditSiswaData;
use App\Filament\Resources\SiswaData\Pages\ListSiswaData;
use App\Filament\Resources\SiswaData\Schemas\SiswaDataForm;
use App\Filament\Resources\SiswaData\Tables\SiswaDataTable;
use App\Models\SiswaData;
use App\Filament\Resources\SiswaData\RelationManagers\RiwayatPendidikanRelationManager;
use App\Filament\Resources\SiswaData\RelationManagers\AkademikKRSRelationManager;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SiswaDataResource extends Resource
{
    protected static ?string $model = SiswaData::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    // protected static string | UnitEnum | null $navigationGroup = 'Master Data Siswa';
    protected static string | UnitEnum | null $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Siswa/Mahasiswa';

    protected static ?int $navigationSort = 16;

    public static function form(Schema $schema): Schema
    {
        return SiswaDataForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SiswaDataTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
            RiwayatPendidikanRelationManager::class,
            AkademikKRSRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSiswaData::route('/'),
            'create' => CreateSiswaData::route('/create'),
            'edit' => EditSiswaData::route('/{record}/edit'),
        ];
    }
}
