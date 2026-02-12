<?php

namespace App\Filament\Resources\MataPelajaranKelas;

use App\Filament\Resources\MataPelajaranKelas\Pages\CreateMataPelajaranKelas;
use App\Filament\Resources\MataPelajaranKelas\Pages\EditMataPelajaranKelas;
use App\Filament\Resources\MataPelajaranKelas\Pages\ListMataPelajaranKelas;
use App\Filament\Resources\MataPelajaranKelas\Pages\ViewMataPelajaranKelas;
use App\Filament\Resources\MataPelajaranKelas\Schemas\MataPelajaranKelasForm;
use App\Filament\Resources\MataPelajaranKelas\Schemas\MataPelajaranKelasInfolist;
use App\Filament\Resources\MataPelajaranKelas\Tables\MataPelajaranKelasTable;
use App\Models\MataPelajaranKelas;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MataPelajaranKelasResource extends Resource
{
    protected static ?string $model = MataPelajaranKelas::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Schema $schema): Schema
    {
        return MataPelajaranKelasForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MataPelajaranKelasInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MataPelajaranKelasTable::configure($table);
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
            'index' => ListMataPelajaranKelas::route('/'),
            'create' => CreateMataPelajaranKelas::route('/create'),
            'view' => ViewMataPelajaranKelas::route('/{record}'),
            'edit' => EditMataPelajaranKelas::route('/{record}/edit'),
        ];
    }
}
