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
use Filament\Actions\ViewAction;
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
                Tables\Columns\TextColumn::make('kelas.tahunAkademik.nama')
                    ->label('Tahun Akademik')
                    ->getStateUsing(function ($record) {
                        return $record->kelas?->tahunAkademik?->nama . ' - ' .
                            $record->kelas?->tahunAkademik?->periode ?? '-';
                    })
                    ->badge()
                    ->color('success')
                    ->sortable(query: function ($query, $direction) {
                        // Custom sorting melalui relasi
                        return $query->orderBy(
                            Kelas::select('id_tahun_akademik')
                                ->whereColumn('kelas.id', 'mata_pelajaran_kelas.id_kelas')
                                ->limit(1),
                            $direction
                        );
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
                // Tidak perlu bulk actions
            ]);
    }

    // Optional: Method untuk mengecek apakah user bisa mengakses relation manager
    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        // Hanya tampilkan jika owner record memiliki id_tahun_akademik
        return $ownerRecord->id_tahun_akademik !== null;
    }
}
