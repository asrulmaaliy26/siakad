<?php

namespace App\Observers;

use App\Models\JenjangPendidikan;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class JenjangObserver
{
    /**
     * Handle the JenjangPendidikan "created" event.
     */
    public function created(JenjangPendidikan $jenjang): void
    {
        $this->syncRole($jenjang);
    }

    /**
     * Handle the JenjangPendidikan "updated" event.
     */
    public function updated(JenjangPendidikan $jenjang): void
    {
        $this->syncRole($jenjang);
    }

    /**
     * Handle the JenjangPendidikan "deleted" event.
     */
    public function deleted(JenjangPendidikan $jenjang): void
    {
        Role::where('name', \App\Helpers\SiakadRole::ADMIN)
            ->where('jenjang_id', $jenjang->id)
            ->delete();
    }

    protected function syncRole(JenjangPendidikan $jenjang): void
    {
        $roleName = \App\Helpers\SiakadRole::ADMIN;

        Role::firstOrCreate([
            'name' => $roleName,
            'guard_name' => 'web',
            'jenjang_id' => $jenjang->id
        ]);
    }
}
