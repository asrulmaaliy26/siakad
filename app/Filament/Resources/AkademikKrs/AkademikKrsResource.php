<?php

namespace App\Filament\Resources\AkademikKrs;

use App\Filament\Resources\AkademikKrs\Pages\CreateAkademikKrs;
use App\Filament\Resources\AkademikKrs\Pages\EditAkademikKrs;
use App\Filament\Resources\AkademikKrs\Pages\ListAkademikKrs;
use App\Filament\Resources\AkademikKrs\Schemas\AkademikKrsForm;
use App\Filament\Resources\AkademikKrs\Tables\AkademikKrsTable;
use App\Models\AkademikKrs;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AkademikKrsResource extends Resource
{
    protected static ?string $model = AkademikKrs::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Schema $schema): Schema
    {
        return AkademikKrsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AkademikKrsTable::configure($table);
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
            'index' => ListAkademikKrs::route('/'),
            'create' => CreateAkademikKrs::route('/create'),
            'edit' => EditAkademikKrs::route('/{record}/edit'),
        ];
    }
}
