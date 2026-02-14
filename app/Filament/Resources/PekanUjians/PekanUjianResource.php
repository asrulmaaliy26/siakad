<?php

namespace App\Filament\Resources\PekanUjians;

use App\Filament\Resources\PekanUjians\Pages\CreatePekanUjian;
use App\Filament\Resources\PekanUjians\Pages\EditPekanUjian;
use App\Filament\Resources\PekanUjians\Pages\ListPekanUjians;
use App\Filament\Resources\PekanUjians\Pages\ViewPekanUjian;
use App\Filament\Resources\PekanUjians\Schemas\PekanUjianForm;
use App\Filament\Resources\PekanUjians\Schemas\PekanUjianInfolist;
use App\Filament\Resources\PekanUjians\Tables\PekanUjiansTable;
use App\Filament\Resources\PekanUjians\RelationManagers\MataPelajaranKelasRelationManager;
use App\Models\PekanUjian;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PekanUjianResource extends Resource
{
    protected static ?string $model = PekanUjian::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama';
    protected static string | UnitEnum | null $navigationGroup = 'Perkuliahan';
    protected static ?int $navigationSort = 14;
    protected static ?string $navigationLabel = 'Ujian';

    public static function form(Schema $schema): Schema
    {
        return PekanUjianForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PekanUjianInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PekanUjiansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
            RelationManagers\MataPelajaranKelasRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPekanUjians::route('/'),
            'create' => CreatePekanUjian::route('/create'),
            'view' => ViewPekanUjian::route('/{record}'),
            'edit' => EditPekanUjian::route('/{record}/edit'),
        ];
    }
}
