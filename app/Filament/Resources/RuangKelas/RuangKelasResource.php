<?php

namespace App\Filament\Resources\RuangKelas;

use App\Filament\Resources\RuangKelas\Pages\CreateRuangKelas;
use App\Filament\Resources\RuangKelas\Pages\EditRuangKelas;
use App\Filament\Resources\RuangKelas\Pages\ListRuangKelas;
use App\Filament\Resources\RuangKelas\Schemas\RuangKelasForm;
use App\Filament\Resources\RuangKelas\Tables\RuangKelasTable;
use App\Models\RuangKelas;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RuangKelasResource extends Resource
{
    protected static ?string $model = RuangKelas::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return RuangKelasForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RuangKelasTable::configure($table);
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
            'index' => ListRuangKelas::route('/'),
            'create' => CreateRuangKelas::route('/create'),
            'edit' => EditRuangKelas::route('/{record}/edit'),
        ];
    }
}
