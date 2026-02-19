<?php

namespace Tests\Feature;

use App\Helpers\SiakadRole;
use App\Http\Middleware\SetActiveJenjangMiddleware;
use App\Models\JenjangPendidikan;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class RoleJenjangTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Roles table & others handled by migrations now (including legacy/mock migration).

        // Allow mass assignment for testing purposes
        Role::unguard();
        JenjangPendidikan::unguard();
    }

    /** @test */
    public function super_admin_can_access_without_forced_jenjang()
    {
        $superAdminRole = Role::create(['name' => SiakadRole::SUPER_ADMIN, 'guard_name' => 'web']);
        $user = User::factory()->create();
        $user->assignRole($superAdminRole);

        $this->actingAs($user);

        // Pre-set a session value
        Session::put('active_jenjang_id', 999);

        $middleware = new SetActiveJenjangMiddleware();
        $request = Request::create('/admin', 'GET');

        $middleware->handle($request, function ($req) {
            return response(null, 200);
        });

        // Should receive no change
        $this->assertEquals(999, Session::get('active_jenjang_id'));
    }

    /** @test */
    public function user_with_specific_jenjang_role_is_forced_to_that_jenjang()
    {
        $jenjangSD = JenjangPendidikan::create(['nama' => 'SD', 'kode' => 'SD']);
        $jenjangSMP = JenjangPendidikan::create(['nama' => 'SMP', 'kode' => 'SMP']);

        // The JenjangObserver automatically creates the 'admin' role for these jenjangs.
        // We just need to retrieve it.
        $roleSD = Role::where('name', SiakadRole::ADMIN)
            ->where('jenjang_id', $jenjangSD->id)
            ->first();

        $user = User::factory()->create();
        $user->assignRole($roleSD);

        $this->actingAs($user);

        // User tries to switch to SMP (simulate session manipulation or leftovers)
        Session::put('active_jenjang_id', $jenjangSMP->id);

        // Clear Spatie cache to ensure roles are fresh
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $user->load('roles'); // Reload roles relation


        $middleware = new SetActiveJenjangMiddleware();
        $request = Request::create('/admin', 'GET');

        $middleware->handle($request, function ($req) {
            return response(null, 200);
        });

        // Middleware should force it back to SD
        $this->assertEquals($jenjangSD->id, Session::get('active_jenjang_id'));
    }

    /** @test */
    public function user_with_global_role_is_not_forced()
    {
        // Role without jenjang_id
        $roleGlobal = Role::create([
            'name' => 'staff_global',
            'guard_name' => 'web',
            'jenjang_id' => null
        ]);

        $user = User::factory()->create();
        $user->assignRole($roleGlobal);

        $this->actingAs($user);

        // Simulating user choosing a jenjang
        Session::put('active_jenjang_id', 123);

        $middleware = new SetActiveJenjangMiddleware();
        $request = Request::create('/admin', 'GET');

        $middleware->handle($request, function ($req) {
            return response(null, 200);
        });

        // specific jenjang should persist (not forced to null or anything)
        $this->assertEquals(123, Session::get('active_jenjang_id'));
    }
}
