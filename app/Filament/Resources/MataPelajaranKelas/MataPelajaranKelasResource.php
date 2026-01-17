<?php

namespace App\Filament\Resources\MataPelajaranKelas;

use App\Filament\Resources\MataPelajaranKelas\Pages\CreateMataPelajaranKelas;
use App\Filament\Resources\MataPelajaranKelas\Pages\EditMataPelajaranKelas;
use App\Filament\Resources\MataPelajaranKelas\Pages\ListMataPelajaranKelas;
use App\Filament\Resources\MataPelajaranKelas\Schemas\MataPelajaranKelasForm;
use App\Filament\Resources\MataPelajaranKelas\Tables\MataPelajaranKelasTable;
use App\Models\MataPelajaranKelas;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Database\Eloquent\Builder;

class MataPelajaranKelasResource extends Resource
{
    protected static ?string $model = MataPelajaranKelas::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string | UnitEnum | null $navigationGroup = 'Master Data';

    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Schema $schema): Schema
    {
        return MataPelajaranKelasForm::configure($schema);
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
            'edit' => EditMataPelajaranKelas::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'mataPelajaranKurikulum.MataPelajaranMaster',
                'mataPelajaranKurikulum.kurikulum.jurusan',
                'dosen',
                'kelas.programKelas',
                'kelas.tahunAkademik',
            ]);
    }
}
