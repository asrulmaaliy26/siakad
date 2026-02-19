<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetActiveJenjangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user) {
            // Priority 1: Super Admin (Global Access)
            if ($user->hasRole(\App\Helpers\SiakadRole::SUPER_ADMIN)) {
                // Do nothing, let the switcher or existing session handle it
            }
            // Priority 2: Mahasiswa (Force based on educational history)
            elseif ($user->hasRole(\App\Helpers\SiakadRole::MAHASISWA)) {
                $siswa = \App\Models\SiswaData::where('user_id', $user->id)->first();
                if ($siswa) {
                    $riwayat = $siswa->riwayatPendidikanAktif;
                    $jenjangId = null;

                    if ($riwayat && $riwayat->id_jurusan) {
                        $jenjangId = \App\Models\Jurusan::find($riwayat->id_jurusan)?->id_jenjang_pendidikan;
                    } elseif ($siswa->pendaftar && $siswa->pendaftar->id_jurusan) {
                        $jenjangId = \App\Models\Jurusan::find($siswa->pendaftar->id_jurusan)?->id_jenjang_pendidikan;
                    }

                    if ($jenjangId) {
                        session(['active_jenjang_id' => $jenjangId]);
                    }
                }
            }
            // Priority 3: Role-based Access (Jenjang Admin / Staff)
            // Use the jenjang_id directly from the assigned role(s)
            else {
                // Get roles with jenjang relationship, ignoring the current active jenjang scope
                $rolesWithJenjang = $user->roles()->withoutGlobalScope(\App\Models\Scopes\JenjangScope::class)->whereNotNull('jenjang_id')->with('jenjang')->get();

                if ($rolesWithJenjang->isNotEmpty()) {
                    // Force the first specific jenjang found
                    $jenjangId = $rolesWithJenjang->first()->jenjang_id;

                    if (session('active_jenjang_id') != $jenjangId) {
                        session(['active_jenjang_id' => $jenjangId]);
                        // Clear permission cache because roles (and thus permissions) may have changed visibility based on scope
                        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
                    }
                }
            }
        }

        return $next($request);
    }
}
