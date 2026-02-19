<?php

namespace Tests\Feature;

use App\Helpers\SiakadRole;
use App\Http\Middleware\SetActiveJenjangMiddleware;
use App\Models\DosenData;
use App\Models\JenjangPendidikan;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\MataPelajaranKelas;
use App\Models\TahunAkademik;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class LecturerAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Role::unguard();
        JenjangPendidikan::unguard();
        Jurusan::unguard();
        DosenData::unguard();
        Kelas::unguard();
        MataPelajaranKelas::unguard();
        TahunAkademik::unguard();

        Role::create(['name' => SiakadRole::DOSEN, 'guard_name' => 'web']);
    }

    /** @test */
    public function lecturer_is_forced_to_active_jenjang_based_on_dosen_data()
    {
        $jenjangS1 = JenjangPendidikan::create(['nama' => 'S1', 'kode' => 'S1']);
        $jurusanS1 = Jurusan::create(['nama' => 'Teknik Informatika', 'id_jenjang_pendidikan' => $jenjangS1->id]);

        $user = User::factory()->create();
        $user->assignRole(SiakadRole::DOSEN);

        DosenData::create([
            'user_id' => $user->id,
            'nama' => 'Dosen A',
            'id_jurusan' => $jurusanS1->id
        ]);

        $this->actingAs($user);

        $middleware = new SetActiveJenjangMiddleware();
        $request = Request::create('/admin', 'GET');

        $middleware->handle($request, function ($req) {
            return response(null, 200);
        });

        // This will fail if I haven't updated the middleware
        $this->assertEquals($jenjangS1->id, Session::get('active_jenjang_id'), 'Middleware failed to set active_jenjang_id for lecturer');
    }

    /** @test */
    public function lecturer_can_only_see_relevant_data()
    {
        $tapel = TahunAkademik::create(['nama' => '2023/2024', 'status' => 'Y']);

        $jenjangS1 = JenjangPendidikan::create(['nama' => 'S1', 'kode' => 'S1']);
        $jurusanS1 = Jurusan::create(['nama' => 'TI', 'id_jenjang_pendidikan' => $jenjangS1->id]);

        $jenjangMA = JenjangPendidikan::create(['nama' => 'MA', 'kode' => 'MA']);
        $jurusanMA = Jurusan::create(['nama' => 'Agama', 'id_jenjang_pendidikan' => $jenjangMA->id]);

        $user = User::factory()->create();
        $user->assignRole(SiakadRole::DOSEN);
        DosenData::create(['user_id' => $user->id, 'nama' => 'Dosen A', 'id_jurusan' => $jurusanS1->id]);

        // Content
        $kelasS1 = Kelas::create(['nama' => 'Kelas S1', 'id_jurusan' => $jurusanS1->id, 'id_tahun_akademik' => $tapel->id]);
        $mapelS1 = MataPelajaranKelas::create(['id_kelas' => $kelasS1->id]);

        $kelasMA = Kelas::create(['nama' => 'Kelas MA', 'id_jurusan' => $jurusanMA->id, 'id_tahun_akademik' => $tapel->id]);
        $mapelMA = MataPelajaranKelas::create(['id_kelas' => $kelasMA->id]);

        $this->actingAs($user);
        Session::put('active_jenjang_id', $jenjangS1->id);

        // Verify isolation
        $this->assertCount(1, MataPelajaranKelas::all());
        $this->assertEquals($mapelS1->id, MataPelajaranKelas::first()->id);

        $this->assertCount(1, Kelas::all());
        $this->assertEquals($kelasS1->id, Kelas::first()->id);
    }
}
