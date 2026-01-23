<?php

namespace App\Filament\Resources\DosenData\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use App\Models\Jurusan;
use App\Models\RefOption\PangkatGolongan;
use App\Models\RefOption\JabatanFungsional;
use App\Models\RefOption\StatusDosen;
use App\Models\RefOption\Agama;
use Filament\Forms\Components\FileUpload;

class DosenDataForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2) // optional: atur jadi 2 kolom
            ->components([
                FileUpload::make('foto_profil')
                    ->label('Foto Profil')
                    ->image()
                    ->directory(fn ($get) => 'foto-dosen/' . str()->slug($get('nama') ?? 'tanpa-nama'))
                    ->deleteUploadedFileUsing(fn ($file) => true),
                // IDENTITAS
                TextInput::make('nama')
                    ->label('Nama Lengkap')
                    ->maxLength(255),

                TextInput::make('NIPDN')
                    ->label('NIPDN')
                    ->maxLength(50),

                TextInput::make('NIY')
                    ->label('NIY')
                    ->maxLength(50),

                TextInput::make('gelar_depan')
                    ->label('Gelar Depan')
                    ->maxLength(50),

                TextInput::make('gelar_belakang')
                    ->label('Gelar Belakang')
                    ->maxLength(50),

                DatePicker::make('tanggal_lahir')
                    ->label('Tanggal Lahir'),

                Select::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ]),

                TextInput::make('ibu_kandung')
                    ->label('Nama Ibu Kandung')
                    ->maxLength(255),

                TextInput::make('kewarganegaraan')
                    ->label('Kewarganegaraan')
                    ->maxLength(100),

                Textarea::make('Alamat')
                    ->label('Alamat')
                    ->rows(3),

                Select::make('status_kawin')
                    ->label('Status Kawin')
                    ->options([
                        'Y' => 'Sudah Kawin',
                        'N' => 'Belum Kawin',
                    ]),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->maxLength(255),

                // RELASI / SELECT
                Select::make('id_jurusan')
                    ->label('Jurusan')
                    ->options(Jurusan::pluck('nama', 'id'))
                    ->searchable(),

                Select::make('id_pangkat_gol')
                    ->label('Pangkat Golongan')
                    ->options(PangkatGolongan::pluck('nilai', 'id'))
                    ->searchable(),

                Select::make('id_jabatan')
                    ->label('Jabatan Fungsional')
                    ->options(JabatanFungsional::pluck('nilai', 'id'))
                    ->searchable(),

                Select::make('id_status_dosen')
                    ->label('Status Dosen')
                    ->options(StatusDosen::pluck('nilai', 'id'))
                    ->searchable(),

                Select::make('id_agama')
                    ->label('Agama')
                    ->options(Agama::pluck('nilai', 'id'))
                    ->searchable(),
            ]);
    }
}
