<?php

namespace App\Filament\Resources\SiswaData\Pages;

use App\Filament\Resources\SiswaData\SiswaDataResource;
use Filament\Actions\CreateAction;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;

class ListSiswaData extends ListRecords
{
    protected static string $resource = SiswaDataResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua Siswa'),
            'aktif' => Tab::make('Siswa Aktif')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status_siswa', 'aktif')),
            'tidak aktif' => Tab::make('Siswa Tidak Aktif')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status_siswa', 'tidak aktif')->orWhereNull('status_siswa')),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
