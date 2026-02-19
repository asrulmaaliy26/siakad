<?php

namespace App\Filament\Resources\Kurikulums\Schemas;

use App\Models\JenjangPendidikan;
use App\Models\Jurusan;
use App\Models\TahunAkademik;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KurikulumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                Select::make('id_jurusan')
                    ->label('Jurusan')
                    ->relationship('jurusan', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('id_tahun_akademik')
                    ->label('Tahun Akademik')
                    ->relationship('tahunAkademik', 'nama')
                    ->searchable()
                    ->preload(),
                Select::make('status_aktif')
                    ->options(['Y' => 'Aktif', 'N' => 'Tidak Aktif']),
            ]);
    }
}
