<?php

namespace App\Filament\Resources\PekanUjians\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Collection;
use Filament\Notifications\Notification;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkAction;
use App\Models\Kelas;
use App\Models\MataPelajaranKelas;

class MataPelajaranKelasRelationManager extends RelationManager
{
    protected static string $relationship = 'mataPelajaranKelas'; // Sesuaikan dengan nama relasi di model PekanUjian

    protected static ?string $title = 'Mata Pelajaran Kelas';

    protected static ?string $recordTitleAttribute = 'id_mata_pelajaran_kelas';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                MataPelajaranKelas::query()
                    ->whereHas('kelas', function (Builder $query) {
                        // Filter: Hanya tampilkan mata pelajaran kelas yang berada di tahun akademik yang sama dengan Pekan Ujian
                        $query->where('id_tahun_akademik', $this->getOwnerRecord()->id_tahun_akademik);
                    })
            )
            ->recordTitleAttribute('id_mata_pelajaran_kelas')
            ->columns([
                Tables\Columns\TextColumn::make('mataPelajaranKurikulum.mataPelajaranMaster.nama')
                    ->label('Mata Pelajaran')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kelas.semester')
                    ->label('Semester')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kelas.programKelas.nilai')
                    ->label('Nama Kelas')
                    ->sortable(),
                Tables\Columns\TextColumn::make('dosenData.nama')
                    ->label('Guru Pengampu')
                    ->searchable(),
                // Perbaikan: Ambil tahun akademik dari kelas -> tahunAkademik
                // Tables\Columns\TextColumn::make('kelas.tahunAkademik.nama')
                //     ->label('Tahun Akademik')
                //     ->getStateUsing(function ($record) {
                //         return $record->kelas?->tahunAkademik?->nama . ' - ' .
                //             $record->kelas?->tahunAkademik?->periode ?? '-';
                //     })
                //     ->badge()
                //     ->color('success')
                //     ->sortable(query: function ($query, $direction) {
                //         // Custom sorting melalui relasi
                //         return $query->orderBy(
                //             Kelas::select('id_tahun_akademik')
                //                 ->whereColumn('kelas.id', 'mata_pelajaran_kelas.id_kelas')
                //                 ->limit(1),
                //             $direction
                //         );
                //     }),
                Tables\Columns\TextColumn::make('status_ujian_display')
                    ->label('Status Ujian')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        $pekanUjian = $this->getOwnerRecord();
                        $jenisUjian = strtolower($pekanUjian->jenis_ujian ?? '');

                        $status = 0;
                        if (str_contains($jenisUjian, 'uts')) {
                            $status = $record->status_uts;
                        } elseif (str_contains($jenisUjian, 'uas')) {
                            $status = $record->status_uas;
                        }

                        return $status == 'Y' ? 'Aktif' : 'Tidak Aktif';
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'Aktif' => 'success',
                        'Tidak Aktif' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('soal_check')
                    ->label('Soal')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        $pekanUjian = $this->getOwnerRecord();
                        $jenisUjian = strtolower($pekanUjian->jenis_ujian ?? '');

                        $file = null;
                        $note = null;

                        if (str_contains($jenisUjian, 'uts')) {
                            $file = $record->soal_uts;
                            $note = $record->ctt_soal_uts;
                        } elseif (str_contains($jenisUjian, 'uas')) {
                            $file = $record->soal_uas;
                            $note = $record->ctt_soal_uas;
                        }

                        return \App\Helpers\UjianHelper::hasSubmission($file, $note) ? 'Lihat Soal' : '-';
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'Lihat Soal' => 'info',
                        '-' => 'gray',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('program_kelas_id')
                    ->label('Kelas')
                    ->options(function () {
                        return \App\Models\RefOption\ProgramKelas::where('nama_grup', 'program_kelas')
                            ->pluck('nilai', 'id');
                    })
                    ->query(function (Builder $query, array $data) {
                        return $query->when($data['value'], function (Builder $query, $value) {
                            $query->whereHas('kelas', function (Builder $query) use ($value) {
                                $query->where('ro_program_kelas', $value);
                            });
                        });
                    }),
                Tables\Filters\SelectFilter::make('id_dosen_data')
                    ->label('Guru')
                    ->relationship('dosenData', 'nama')
                    ->searchable()
                    ->preload()
            ])
            ->headerActions([
                // Tidak perlu tambah data karena ini hanya menampilkan
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->bulkActions([
                BulkAction::make('update_status')
                    ->label('Set Status Ujian')
                    ->icon('heroicon-o-check-circle')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'Y' => 'Aktif',
                                'N' => 'Tidak Aktif',
                            ])
                            ->required(),
                    ])
                    ->action(function (Collection $records, array $data, $livewire) {
                        $pekanUjian = $livewire->getOwnerRecord();
                        // Asumsi jenis_ujian mengandung string 'UTS' atau 'UAS' (case-insensitive)
                        $jenisUjian = strtolower($pekanUjian->jenis_ujian ?? '');

                        $column = null;
                        if (str_contains($jenisUjian, 'uts')) {
                            $column = 'status_uts';
                        } elseif (str_contains($jenisUjian, 'uas')) {
                            $column = 'status_uas';
                        }

                        if ($column) {
                            $records->each(function ($record) use ($column, $data) {
                                $record->update([
                                    $column => $data['status'],
                                ]);
                            });

                            Notification::make()
                                ->title('Status updated successfully')
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('Gagal Update Status')
                                ->body('Jenis ujian pada Pekan Ujian tidak terdeteksi sebagai UTS atau UAS. Jenis: ' . $pekanUjian->jenis_ujian)
                                ->danger()
                                ->send();
                        }
                    })
                    ->deselectRecordsAfterCompletion(),
            ]);
    }

    // Optional: Method untuk mengecek apakah user bisa mengakses relation manager
    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        // Hanya tampilkan jika owner record memiliki id_tahun_akademik
        return $ownerRecord->id_tahun_akademik !== null;
    }
}
