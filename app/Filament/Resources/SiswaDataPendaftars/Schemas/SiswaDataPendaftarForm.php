<?php

namespace App\Filament\Resources\SiswaDataPendaftars\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class SiswaDataPendaftarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Data Pendaftar')
                    ->tabs([
                        // Tab 1: Data Dasar
                        Tabs\Tab::make('Data Dasar')
                            ->schema([
                                Section::make('Informasi Pendaftaran')
                                    ->schema([
                                        Select::make('id_siswa_data')
                                            ->label('Siswa')
                                            ->relationship('siswa', 'nama')
                                            ->searchable()
                                            ->preload()
                                            ->required(),

                                        TextInput::make('Nama_Lengkap')
                                            ->label('Nama Lengkap')
                                            ->maxLength(255),

                                        TextInput::make('No_Pendaftaran')
                                            ->label('No. Pendaftaran')
                                            ->maxLength(255),

                                        TextInput::make('Tahun_Masuk')
                                            ->label('Tahun Masuk')
                                            ->maxLength(4),

                                        DatePicker::make('Tgl_Daftar')
                                            ->label('Tanggal Daftar')
                                            ->default(now()),
                                    ])
                                    ->columns(2),

                                Section::make('Program Studi')
                                    ->schema([
                                        Select::make('program_sekolah')
                                            ->label('Program Sekolah')
                                            ->relationship('programSekolahRef', 'nilai', function ($query) {
                                                return $query->where('nama_grup', 'program_sekolah')
                                                    ->where('status', 1);
                                            })
                                            ->searchable()
                                            ->preload()
                                            ->required()
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                                // Ambil nilai dari reference option
                                                $refOption = \App\Models\ReferenceOption::find($state);
                                                if ($refOption) {
                                                    // Cari jenjang pendidikan berdasarkan nama
                                                    $jenjang = \App\Models\JenjangPendidikan::where('nama', $refOption->nilai)->first();
                                                    if ($jenjang) {
                                                        $set('id_jenjang_pendidikan', $jenjang->id);
                                                    }
                                                }
                                            }),

                                        Select::make('id_jenjang_pendidikan')
                                            ->label('Jenjang Pendidikan')
                                            ->relationship('jenjangPendidikan', 'nama')
                                            ->searchable()
                                            ->preload()
                                            ->disabled()
                                            ->dehydrated(),
                                        TextInput::make('Kelas_Program_Kuliah')
                                            ->label('Kelas Program'),

                                        TextInput::make('Prodi_Pilihan_1')
                                            ->label('Prodi Pilihan 1'),

                                        TextInput::make('Prodi_Pilihan_2')
                                            ->label('Prodi Pilihan 2'),

                                        Select::make('Jalur_PMB')
                                            ->label('Jalur PMB')
                                            ->relationship('jalurPmbRef', 'nilai', function ($query) {
                                                return $query->where('nama_grup', 'jalur_pmb')
                                                    ->where('status', 1);
                                            })
                                            ->searchable()
                                            ->preload(),

                                        Select::make('Jenis_Pembiayaan')
                                            ->label('Jenis Pembiayaan')
                                            ->options([
                                                'Mandiri' => 'Mandiri',
                                                'Beasiswa' => 'Beasiswa',
                                                'Lainnya' => 'Lainnya',
                                            ]),
                                    ])
                                    ->columns(2),
                            ]),

                        // Tab 2: Data Transfer
                        Tabs\Tab::make('Data Transfer')
                            ->schema([
                                Section::make('Data Kampus Asal')
                                    ->schema([
                                        TextInput::make('NIMKO_Asal')
                                            ->label('NIM Asal'),

                                        TextInput::make('PT_Asal')
                                            ->label('Perguruan Tinggi Asal'),

                                        TextInput::make('Prodi_Asal')
                                            ->label('Prodi Asal'),

                                        TextInput::make('Jml_SKS_Asal')
                                            ->label('Jumlah SKS Diakui')
                                            ->numeric(),

                                        TextInput::make('IPK_Asal')
                                            ->label('IPK Terakhir'),

                                        TextInput::make('Semester_Asal')
                                            ->label('Semester Asal'),
                                    ])
                                    ->columns(2),
                            ]),

                        // Tab 3: Dokumen
                        Tabs\Tab::make('Dokumen')
                            ->schema([
                                Section::make('Upload Dokumen')
                                    ->schema([
                                        FileUpload::make('Legalisir_Ijazah')
                                            ->label('Legalisir Ijazah')
                                            ->directory('dokumen/ijazah'),

                                        FileUpload::make('Legalisir_SKHU')
                                            ->label('Legalisir SKHU')
                                            ->directory('dokumen/skhu'),

                                        FileUpload::make('Copy_KTP')
                                            ->label('Copy KTP')
                                            ->directory('dokumen/ktp'),

                                        FileUpload::make('File_Foto_Berwarna')
                                            ->label('Pas Foto Berwarna')
                                            ->image()
                                            ->directory('foto'),
                                    ])
                                    ->columns(2),
                            ]),

                        // Tab 4: Status & Validasi
                        Tabs\Tab::make('Status & Validasi')
                            ->schema([
                                Section::make('Status Pendaftaran')
                                    ->schema([
                                        Select::make('status_valid')
                                            ->label('Status Validasi')
                                            ->options([
                                                '0' => 'Belum Divalidasi',
                                                '1' => 'Sudah Divalidasi',
                                            ])
                                            ->default('0')
                                            ->required(),

                                        Select::make('Status_Pendaftaran')
                                            ->label('Status Pendaftaran')
                                            ->options([
                                                'B' => '⏳ Pending/Proses',
                                                'Y' => '✅ Diterima',
                                                'N' => '❌ Ditolak',
                                            ])
                                            ->default('B')
                                            ->required(),

                                        Select::make('Status_Kelulusan')
                                            ->label('Status Kelulusan')
                                            ->options([
                                                'B' => '⏳ Proses',
                                                'Y' => '✅ Lulus',
                                                'N' => '❌ Tidak Lulus',
                                            ])
                                            ->default('B')
                                            ->required(),

                                        TextInput::make('Diterima_di_Prodi')
                                            ->label('Diterima di Prodi'),

                                        TextInput::make('verifikator')
                                            ->label('Verifikator'),
                                    ])
                                    ->columns(2),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
