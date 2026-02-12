<?php

namespace App\Filament\Resources\MataPelajaranKelas\RelationManagers;

use App\Filament\Resources\MataPelajaranKelas\MataPelajaranKelasResource;
use App\Models\AkademikKRS;
use App\Models\AbsensiSiswa;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AbsensiSiswaRelationManager extends RelationManager
{
    protected static string $relationship = 'absensiSiswa';

    protected static ?string $title = 'Absensi';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('waktu_absen')
                    ->label('Tanggal / Waktu')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                TextColumn::make('krs.riwayatPendidikan.siswaData.nama')
                    ->label('Nama Mahasiswa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Hadir' => 'success',
                        'Izin' => 'warning',
                        'Sakit' => 'danger',
                        'Alpa' => 'gray',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('create_session')
                    ->label('Buat Sesi Absensi')
                    ->form([
                        DateTimePicker::make('waktu_absen')
                            ->required()
                            ->default(now()),
                    ])
                    ->action(function (array $data) {
                        $record = $this->getOwnerRecord();
                        $krsList = AkademikKRS::where('id_kelas', $record->id_kelas)->get();

                        foreach ($krsList as $krs) {
                            AbsensiSiswa::create([
                                'id_mata_pelajaran_kelas' => $record->id,
                                'id_krs' => $krs->id,
                                'waktu_absen' => $data['waktu_absen'],
                                'status' => 'alpa', // Default status
                            ]);
                        }

                        Notification::make()
                            ->title('Sesi absensi berhasil dibuat')
                            ->success()
                            ->send();
                    }),
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
