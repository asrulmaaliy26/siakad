<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, \App\Traits\HasJenjangScope;

    public function scopeByJenjang($query, $jenjangId)
    {
        return $query->where(function ($q) use ($jenjangId) {
            // Case 1: User has SiswaData -> check jenjang in SiswaData
            $q->whereHas('siswaData', function ($sub) use ($jenjangId) {
                $sub->withoutGlobalScopes()->where(function ($ss) use ($jenjangId) {
                    $ss->whereHas('pendaftar.jurusan', function ($j) use ($jenjangId) {
                        $j->where('id_jenjang_pendidikan', $jenjangId);
                    })
                        ->orWhereHas('riwayatPendidikan.jurusan', function ($j) use ($jenjangId) {
                            $j->where('id_jenjang_pendidikan', $jenjangId);
                        });
                });
            })
                // Case 2: User has DosenData -> check jenjang in DosenData
                ->orWhereHas('dosenData', function ($sub) use ($jenjangId) {
                    $sub->withoutGlobalScopes()->whereHas('jurusan', function ($subJurusan) use ($jenjangId) {
                        $subJurusan->where('id_jenjang_pendidikan', $jenjangId);
                    });
                })
                // Case 3: Role-based filtering (Admin/Staf/Lainnya)
                ->orWhere(function ($sub) use ($jenjangId) {
                    // Hanya filter jika user BUKAN Siswa/Dosen
                    $sub->whereDoesntHave('siswaData', function ($sq) {
                        $sq->withoutGlobalScopes();
                    })
                        ->whereDoesntHave('dosenData', function ($dq) {
                            $dq->withoutGlobalScopes();
                        })
                        ->where(function ($adminCheck) use ($jenjangId) {
                            // User TAMPIL jika:
                            // A. Tidak punya role sama sekali 
                            // B. Punya role Global (jenjang_id IS NULL)
                            // C. Punya role yang jenjang_id-nya cocok dengan jenjang aktif
                            // D. Punya role yang terhubung ke Jenjang "UMUM"
                            $adminCheck->whereDoesntHave('roles')
                                ->orWhereHas('roles', function ($rq) use ($jenjangId) {
                                    $rq->whereNull('jenjang_id')
                                        ->orWhere('jenjang_id', $jenjangId)
                                        ->orWhereHas('jenjang', function ($jq) {
                                            $jq->where('nama', 'UMUM')->orWhere('type', 'UMUM');
                                        });
                                });
                        });
                });
        });
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Logic akses panel, biasanya true untuk development 
        // atau cek role tertentu
        return true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function siswaData()
    {
        return $this->hasOne(SiswaData::class, 'user_id');
    }

    public function dosenData()
    {
        return $this->hasOne(DosenData::class, 'user_id');
    }
}
