<?php

namespace App\Livewire\Filament\Resources\PekanUjians\Components;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use App\Models\SiswaDataLJK;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class InputLjkMinimal extends Component implements HasForms
{
    use InteractsWithForms;

    public ?Model $record = null; // MataPelajaranKelas
    public string $type = 'uts'; // 'uts' or 'uas'
    public ?string $selectedStudentId = null;
    public ?array $data = [];
    public ?string $debugInfo = null;
    public ?bool $hasLjkRecord = false;

    public function mount($record, $type)
    {
        $this->record = $record;
        $this->type = $type;

        // Ensure relations are loaded, bypass scopes if admin/super_admin
        $user = \Filament\Facades\Filament::auth()->user();
        $isAdmin = $user && $user->hasAnyRole([\App\Helpers\SiakadRole::SUPER_ADMIN, \App\Helpers\SiakadRole::ADMIN]);

        if ($isAdmin) {
            $this->record->load(['siswaDataLjk' => function ($q) {
                $q->withoutGlobalScopes()->with(['akademikKrs.riwayatPendidikan.siswaData']);
            }]);
        } else {
            $this->record->load(['siswaDataLjk.akademikKrs.riwayatPendidikan.siswaData']);
        }

        if ($user && $user->hasRole(\App\Helpers\SiakadRole::MAHASISWA)) {
            $siswa = \App\Models\SiswaData::where('user_id', $user->id)->first();
            if ($siswa) {
                $this->selectedStudentId = (string) $siswa->id;
                $this->updatedSelectedStudentId();
            }
        }
    }

    public function form(Schema $form): Schema
    {
        $selectedLjk = $this->getSelectedLjkRecord();

        return $form
            ->schema([
                FileUpload::make($this->type == 'uas' ? 'ljk_uas' : 'ljk_uts')
                    ->label('File LJK ' . strtoupper($this->type))
                    ->disk('public')
                    ->directory($selectedLjk ? \App\Helpers\UploadPathHelper::uploadUjianPath(null, $selectedLjk, $this->type == 'uas' ? 'ljk_uas' : 'ljk_uts') : 'temp')
                    ->visibility('public')
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->maxSize(10240)
                    ->downloadable()
                    ->openable()
                    ->columnSpanFull(),
                RichEditor::make($this->type == 'uas' ? 'ctt_uas' : 'ctt_uts')
                    ->label('Catatan / Jawaban Text')
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function getSelectedLjkRecord()
    {
        if (!$this->selectedStudentId) return null;

        // Find SiswaDataLJK for this student
        // Using string comparison to be safe with Livewire serialization
        return $this->record->siswaDataLjk->first(function ($ljk) {
            $studentId = $ljk->akademikKrs?->riwayatPendidikan?->siswaData?->id;
            return $studentId !== null && (string)$studentId === (string)$this->selectedStudentId;
        });
    }

    public function updatedSelectedStudentId()
    {
        // Force refresh the record's relation to ensure we see new records if any
        $this->record->refresh();
        $this->record->load(['siswaDataLjk.akademikKrs.riwayatPendidikan.siswaData']);

        $ljk = $this->getSelectedLjkRecord();
        $this->hasLjkRecord = (bool)$ljk;

        if ($ljk) {
            $this->data = $ljk->toArray();
            $this->debugInfo = "LJK Found ID: " . $ljk->id . " Note Found: " . ($ljk->ctt_uts ? 'YES' : 'NO');
            $this->form->fill($this->data);
        } else {
            $this->data = [];
            $this->debugInfo = "LJK NOT FOUND! Student ID " . $this->selectedStudentId . " is not linked to this Subject Class in 'siswa_data_ljk' table.";
            $this->form->fill([]);
        }
    }

    public function save()
    {
        $ljk = $this->getSelectedLjkRecord();
        if (!$ljk) return;

        $state = $this->form->getState();
        $ljk->update($state);

        Notification::make()
            ->title('Data LJK Berhasil Disimpan')
            ->success()
            ->send();
    }

    public function render()
    {
        return view('livewire.filament.resources.pekan-ujians.components.input-ljk-minimal');
    }
}
