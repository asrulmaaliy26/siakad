<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role extends SpatieRole
{
    use \App\Traits\HasJenjangScope;
    public function jenjang(): BelongsTo
    {
        return $this->belongsTo(JenjangPendidikan::class, 'jenjang_id');
    }

    /**
     * Override default JenjangScope behavior because column name is 'jenjang_id', not 'id_jenjang_pendidikan'.
     */
    /**
     * Override default JenjangScope behavior.
     * Roles are visible if they:
     * 1. Belong to the active jenjang
     * 2. Are "Global" roles (jenjang_id is NULL)
     * 3. Belong to the "UMUM" (General) jenjang
     */
    public function scopeByJenjang($query, $jenjangId)
    {
        return $query->where(function ($q) use ($jenjangId) {
            $q->where($this->getTable() . '.jenjang_id', $jenjangId)
                ->orWhereNull($this->getTable() . '.jenjang_id')
                ->orWhereHas('jenjang', function ($sub) {
                    $sub->where('nama', 'UMUM')->orWhere('type', 'UMUM');
                });
        });
    }

    public function getDisplayNameAttribute()
    {
        if ($this->jenjang) {
            return "{$this->name} ({$this->jenjang->nama})";
        }
        return $this->name;
    }
}
