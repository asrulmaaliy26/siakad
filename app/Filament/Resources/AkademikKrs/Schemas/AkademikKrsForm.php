<?php

namespace App\Filament\Resources\AkademikKrs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AkademikKrsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            TextInput::make('id_riwayat_pendidikan')
                ->label('Riwayat Pendidikan')
                ->numeric()
                ->required(),

            TextInput::make('id_kelas')
                ->label('Kelas')
                ->numeric(),

            // Data KRS
            TextInput::make('semester')
                ->label('Semester')
                ->required(),

            // TextInput::make('tahun_akademik')
            //     ->label('Tahun Akademik')
            //     ->required(),

            TextInput::make('jumlah_sks')
                ->label('Jumlah SKS')
                ->numeric(),

            DatePicker::make('tgl_krs')
                ->label('Tanggal KRS'),

            TextInput::make('kode_ta')
                ->label('Kode TA'),

            TextInput::make('kwitansi_krs')
                ->label('Kwitansi KRS'),

            // ENUM fields
            Select::make('status_bayar')
                ->label('Status Bayar')
                ->options([
                    'Y' => 'Ya',
                    'N' => 'Tidak',
                ])
                ->default('N'),

            Select::make('syarat_uts')
                ->label('Syarat UTS')
                ->options([
                    'Y' => 'Ya',
                    'N' => 'Tidak',
                ])
                ->default('N'),

            Select::make('syarat_krs')
                ->label('Syarat KRS')
                ->options([
                    'Y' => 'Ya',
                    'N' => 'Tidak',
                ])
                ->default('N'),

            Select::make('status_aktif')
                ->label('Status Aktif')
                ->options([
                    'Y' => 'Aktif',
                    'N' => 'Tidak Aktif',
                ])
                ->default('Y'),

            // Timestamps
            DatePicker::make('created_at')
                ->label('Dibuat')
                ->disabled(),

            DatePicker::make('updated_at')
                ->label('Diperbarui')
                ->disabled(),
            ]);
    }
}
