<?php

namespace Tests\Feature;

use App\Helpers\SiakadRole;
use App\Http\Middleware\SetActiveJenjangMiddleware;
use App\Models\JenjangPendidikan;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\MataPelajaranKelas;
use App\Models\RiwayatPendidikan;
use App\Models\SiswaData;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class StudentAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Allow mass assignment for testing
        Role::unguard();
        JenjangPendidikan::unguard();
        Jurusan::unguard();
        \App\Models\SiswaData::unguard();
        \App\Models\RiwayatPendidikan::unguard();
        \App\Models\Kelas::unguard();
        \App\Models\MataPelajaranKelas::unguard();
        \App\Models\TahunAkademik::unguard();
        \App\Models\SiswaDataLJK::unguard();

        // Setup base roles
        Role::create(['name' => SiakadRole::MAHASISWA, 'guard_name' => 'web']);
    }

    /** @test */
    public function student_is_forced_to_active_jenjang_based_on_education_history()
    {
        // 1. Setup Data
        $jenjangSD = JenjangPendidikan::create(['nama' => 'SD', 'kode' => 'SD']);
        $jurusanSD = Jurusan::create(['nama' => 'Umum SD', 'id_jenjang_pendidikan' => $jenjangSD->id]);

        $jenjangSMP = JenjangPendidikan::create(['nama' => 'SMP', 'kode' => 'SMP']);
        $jurusanSMP = Jurusan::create(['nama' => 'Umum SMP', 'id_jenjang_pendidikan' => $jenjangSMP->id]);

        $user = User::factory()->create();
        $user->assignRole(SiakadRole::MAHASISWA);

        $siswa = SiswaData::create([
            'user_id' => $user->id,
            'nama' => 'Budi',
        ]);

        // Student is currently in SD
        RiwayatPendidikan::create([
            'id_siswa_data' => $siswa->id,
            'id_jurusan' => $jurusanSD->id,
            'status' => 'Aktif',
        ]);

        $this->actingAs($user);

        // 2. Run Middleware
        $middleware = new SetActiveJenjangMiddleware();
        $request = Request::create('/admin', 'GET');

        $middleware->handle($request, function ($req) {
            return response(null, 200);
        });

        // 3. Verify Session
        $this->assertEquals($jenjangSD->id, Session::get('active_jenjang_id'), 'Middleware failed to set active_jenjang_id for student');
    }

    /** @test */
    public function student_can_only_see_data_from_their_own_jenjang()
    {
        // 0. Setup Academic Year (Required by HasActiveAcademicYear trait)
        $tapel = \App\Models\TahunAkademik::create([
            'nama' => '2023/2024 Ganjil',
            'periode' => '20231',
            'status' => 'Y'
        ]);

        // 1. Setup Jenjang & Jurusan
        $jenjangSD = JenjangPendidikan::create(['nama' => 'SD', 'kode' => 'SD']);
        $jurusanSD = Jurusan::create(['nama' => 'Umum SD', 'id_jenjang_pendidikan' => $jenjangSD->id]);

        $jenjangSMP = JenjangPendidikan::create(['nama' => 'SMP', 'kode' => 'SMP']);
        $jurusanSMP = Jurusan::create(['nama' => 'Umum SMP', 'id_jenjang_pendidikan' => $jenjangSMP->id]);

        // 2. Setup Student in SD
        $user = User::factory()->create();
        $user->assignRole(SiakadRole::MAHASISWA);
        $siswa = SiswaData::create(['user_id' => $user->id, 'nama' => 'Budi']);
        RiwayatPendidikan::create([
            'id_siswa_data' => $siswa->id,
            'id_jurusan' => $jurusanSD->id,
            'status' => 'Aktif',
        ]);

        // 3. Setup Content
        $kelasSD = Kelas::create(['nama' => 'Kelas 1 SD', 'id_jurusan' => $jurusanSD->id, 'id_tahun_akademik' => $tapel->id]);
        $mapelSD = MataPelajaranKelas::create(['id_kelas' => $kelasSD->id]);

        $kelasSMP = Kelas::create(['nama' => 'Kelas 7 SMP', 'id_jurusan' => $jurusanSMP->id, 'id_tahun_akademik' => $tapel->id]);
        $mapelSMP = MataPelajaranKelas::create(['id_kelas' => $kelasSMP->id]);

        // 4. Test Access
        $this->actingAs($user);

        // Force session as if middleware ran
        Session::put('active_jenjang_id', $jenjangSD->id);

        // Verify mapel filtering
        $visibleMapels = MataPelajaranKelas::all();

        $this->assertCount(1, $visibleMapels, 'Student should only see 1 mapel');
        $this->assertEquals($mapelSD->id, $visibleMapels->first()->id, 'Student should see SD mapel');
        $this->assertFalse($visibleMapels->contains('id', $mapelSMP->id), 'Student should NOT see SMP mapel');

        // Verify user filtering (student should be able to see themselves)
        $visibleUsers = User::all();
        $this->assertTrue($visibleUsers->contains('id', $user->id), 'Student should see themselves in the filtered user list');

        // Verify student cannot see someone from SMP
        $userSMP = User::factory()->create();
        $userSMP->assignRole(SiakadRole::MAHASISWA);
        $siswaSMP = SiswaData::create(['user_id' => $userSMP->id, 'nama' => 'Andi']);
        RiwayatPendidikan::create(['id_siswa_data' => $siswaSMP->id, 'id_jurusan' => $jurusanSMP->id, 'status' => 'Aktif']);

        $this->assertFalse(User::all()->contains('id', $userSMP->id), 'Student in SD should NOT see student in SMP');

        // 5. Verify LJK filtering
        $ljkSD = \App\Models\SiswaDataLJK::create(['id_mata_pelajaran_kelas' => $mapelSD->id, 'nilai' => 90]);
        $ljkSMP = \App\Models\SiswaDataLJK::create(['id_mata_pelajaran_kelas' => $mapelSMP->id, 'nilai' => 80]);

        $visibleLjk = \App\Models\SiswaDataLJK::all();
        $this->assertCount(1, $visibleLjk, 'Student should only see 1 LJK');
        $this->assertEquals($ljkSD->id, $visibleLjk->first()->id, 'Student should see SD LJK');

        // 6. Verify SiswaData filtering
        $visibleSiswa = SiswaData::all();
        $this->assertTrue($visibleSiswa->contains('id', $siswa->id), 'Student should see their own SiswaData');
        $this->assertFalse($visibleSiswa->contains('id', $siswaSMP->id), 'Student in SD should NOT see SiswaData of student in SMP');
    }
}
