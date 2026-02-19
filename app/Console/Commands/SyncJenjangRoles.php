<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JenjangPendidikan;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class SyncJenjangRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jenjang:sync-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Spatie roles for each Jenjang Pendidikan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Syncing roles for Jenjang Pendidikan...');

        foreach (JenjangPendidikan::all() as $jenjang) {
            $roleName = \App\Helpers\SiakadRole::ADMIN;

            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
                'jenjang_id' => $jenjang->id
            ]);

            $this->line('Role synced for ' . $jenjang->nama . ': ' . $roleName);
        }

        // Delete legacy roles
        $legacyRolesCount = Role::where('name', 'like', 'admin_jenjang_%')->delete();
        if ($legacyRolesCount > 0) {
            $this->warn("Deleted {$legacyRolesCount} legacy admin_jenjang_* roles.");
        }

        $this->info('Sync completed!');
    }
}
