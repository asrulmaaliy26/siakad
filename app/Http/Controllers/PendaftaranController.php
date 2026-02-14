<?php

namespace App\Http\Controllers;

use App\Models\SiswaData;
use App\Models\SiswaDataOrangTua;
use App\Models\SiswaDataPendaftar;
use App\Models\User;
use App\Models\JenjangPendidikan;
use App\Models\RiwayatPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class PendaftaranController extends Controller
{
    /**
     * Display the registration form.
     */
    public function index()
    {
        $jenjangs = JenjangPendidikan::all();
        return view('pendaftaran.index', compact('jenjangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            // User Data
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],

            // Siswa Data (Basic required fields based on model)
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'nama_panggilan' => ['nullable', 'string', 'max:255'], // mapped to 'nama'
            'jenis_kelamin' => ['required', 'in:L,P'],
            'tempat_lahir' => ['required', 'string', 'max:255'], // mapped to 'kota_lahir'
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required', 'string'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'agama' => ['required', 'string'], // ro

            // Parent Data (Ayah)
            'Nama_Ayah' => ['nullable', 'string', 'max:255'],
            'Tempat_Lhr_Ayah' => ['nullable', 'string', 'max:255'],
            'Tgl_Lhr_Ayah' => ['nullable', 'string', 'max:2'],
            'Bln_Lhr_Ayah' => ['nullable', 'string', 'max:2'],
            'Thn_Lhr_ayah' => ['nullable', 'string', 'max:4'],
            'Agama_Ayah' => ['nullable', 'string', 'max:50'],
            'Gol_Darah_Ayah' => ['nullable', 'string', 'max:5'],
            'Pendidikan_Terakhir_Ayah' => ['nullable', 'string', 'max:50'],
            'Pekerjaan_Ayah' => ['nullable', 'string', 'max:100'],
            'Penghasilan_Ayah' => ['nullable', 'string', 'max:100'],
            'Kebutuhan_Khusus_Ayah' => ['nullable', 'string', 'max:100'],
            'Nomor_KTP_Ayah' => ['nullable', 'string', 'max:20'],
            'Alamat_Ayah' => ['nullable', 'string'],
            'No_HP_ayah' => ['nullable', 'string', 'max:16'],

            // Parent Data (Ibu)
            'Nama_Ibu' => ['nullable', 'string', 'max:255'],
            'Tempat_Lhr_Ibu' => ['nullable', 'string', 'max:255'],
            'Tgl_Lhr_Ibu' => ['nullable', 'string', 'max:2'],
            'Bln_Lhr_Ibu' => ['nullable', 'string', 'max:2'],
            'Thn_Lhr_Ibu' => ['nullable', 'string', 'max:4'],
            'Agama_Ibu' => ['nullable', 'string', 'max:50'],
            'Gol_Darah_Ibu' => ['nullable', 'string', 'max:5'],
            'Pendidikan_Terakhir_Ibu' => ['nullable', 'string', 'max:50'],
            'Pekerjaan_Ibu' => ['nullable', 'string', 'max:100'],
            'Penghasilan_Ibu' => ['nullable', 'string', 'max:100'],
            'Kebutuhan_Khusus_Ibu' => ['nullable', 'string', 'max:100'],
            'Nomor_KTP_Ibu' => ['nullable', 'string', 'max:20'],
            'Alamat_Ibu' => ['nullable', 'string'],
            'No_HP_ibu' => ['nullable', 'string', 'max:16'],

            // Pendaftar Data (Extended)
            'nama_pendaftar' => ['required', 'string', 'max:255'],
            'Kelas_Program_Kuliah' => ['nullable', 'string', 'max:255'],
            'Prodi_Pilihan_1' => ['nullable', 'string', 'max:255'],
            'Prodi_Pilihan_2' => ['nullable', 'string', 'max:255'],
            'Jalur_PMB' => ['nullable', 'string', 'max:255'],
            'Jenis_Pembiayaan' => ['nullable', 'string', 'max:255'],
            // Transfer Data
            'NIMKO_Asal' => ['nullable', 'string', 'max:255'],
            'PT_Asal' => ['nullable', 'string', 'max:255'],
            'Prodi_Asal' => ['nullable', 'string', 'max:255'],
            'Jml_SKS_Asal' => ['nullable', 'integer'],
            'IPK_Asal' => ['nullable', 'string', 'max:255'],
            'Semester_Asal' => ['nullable', 'string', 'max:10'],
            'Pengantar_Mutasi' => ['nullable', 'string'],
            'Transkip_Asal' => ['nullable', 'string'],
            // Documents
            'Legalisir_Ijazah' => ['nullable', 'string'],
            'Legalisir_SKHU' => ['nullable', 'string'],
            'Copy_KTP' => ['nullable', 'string'],
            // Photos
            'File_Foto_Berwarna' => ['nullable', 'string'],
            'Foto_BW_3x3' => ['nullable', 'string'],
            'Foto_BW_3x4' => ['nullable', 'string'],
            'Foto_Warna_5x6' => ['nullable', 'string'],
            'Nama_File_Foto' => ['nullable', 'string', 'max:255'],

            // Additional Siswa Fields
            'golongan_darah' => ['nullable', 'string', 'max:5'],
            'nomor_rumah' => ['nullable', 'string', 'max:20'],
            'dusun' => ['nullable', 'string', 'max:100'],
            'rt' => ['nullable', 'string', 'max:10'],
            'rw' => ['nullable', 'string', 'max:10'],
            'desa' => ['nullable', 'string', 'max:100'],
            'kecamatan' => ['nullable', 'string', 'max:100'],
            'kabupaten' => ['nullable', 'string', 'max:100'],
            'provinsi' => ['nullable', 'string', 'max:100'],
            'kode_pos' => ['nullable', 'string', 'max:10'],
            'tempat_domisili' => ['nullable', 'string', 'max:255'],
            'jenis_domisili' => ['nullable', 'string', 'max:50'],
            'no_ktp' => ['nullable', 'string', 'max:20'], // Assuming this is NIK/No KTP
            'no_kk' => ['nullable', 'string', 'max:20'],
            'kewarganegaraan' => ['nullable', 'string', 'max:50'],
            'anak_ke' => ['nullable', 'integer'],
            'jumlah_saudara' => ['nullable', 'integer'],
            'asal_slta' => ['nullable', 'string', 'max:100'],
            'status_asal_sekolah' => ['nullable', 'in:Negeri,Swasta'],
            'jenis_slta' => ['nullable', 'string', 'max:50'],
            'kejuruan_slta' => ['nullable', 'string', 'max:100'],
            'tahun_lulus_slta' => ['nullable', 'integer'],
            'nisn' => ['nullable', 'string', 'max:20'],
            'nomor_seri_ijazah_slta' => ['nullable', 'string', 'max:50'],

            // Jenjang Selection
            'id_jenjang_pendidikan' => ['nullable', 'exists:jenjang_pendidikan,id'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            // 1. Create User
            $user = User::create([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // 2. Create Siswa Data
            $siswaData = SiswaData::create([
                'nama' => $request->input('nama_panggilan', $request->nama_lengkap), // fallback if needed
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email, // link via email
                'jenis_kelamin' => $request->jenis_kelamin,
                'kota_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                'agama' => $request->agama,

                // Extended Fields
                'golongan_darah' => $request->golongan_darah,
                'kewarganegaraan' => $request->input('kewarganegaraan', 'WNI'),
                'no_ktp' => $request->no_ktp,
                'no_kk' => $request->no_kk,
                'anak_ke' => $request->anak_ke,
                'jumlah_saudara' => $request->jumlah_saudara,

                // Address Details
                'nomor_rumah' => $request->nomor_rumah,
                'dusun' => $request->dusun,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'desa' => $request->desa,
                'kecamatan' => $request->kecamatan,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
                'kode_pos' => $request->kode_pos,
                'tempat_domisili' => $request->tempat_domisili,
                'jenis_domisili' => $request->jenis_domisili,

                // School History Fields (Directly on SiswaData model based on schema)
                'asal_slta' => $request->asal_slta,
                'status_asal_sekolah' => $request->status_asal_sekolah,
                'jenis_slta' => $request->jenis_slta,
                'kejuruan_slta' => $request->kejuruan_slta,
                'tahun_lulus_slta' => $request->tahun_lulus_slta,
                'nisn' => $request->nisn,
                'nomor_seri_ijazah_slta' => $request->nomor_seri_ijazah_slta,
            ]);

            // 3. Create Siswa Data Orang Tua
            SiswaDataOrangTua::create([
                'id_siswa_data' => $siswaData->id,
                'nama' => $request->Nama_Ayah ?? $request->Nama_Ibu ?? 'Orang Tua', // Fallback for 'nama' column if exists

                // Ayah
                'Nama_Ayah' => $request->Nama_Ayah,
                'Tempat_Lhr_Ayah' => $request->Tempat_Lhr_Ayah,
                'Tgl_Lhr_Ayah' => $request->Tgl_Lhr_Ayah,
                'Bln_Lhr_Ayah' => $request->Bln_Lhr_Ayah,
                'Thn_Lhr_ayah' => $request->Thn_Lhr_ayah,
                'Agama_Ayah' => $request->Agama_Ayah,
                'Gol_Darah_Ayah' => $request->Gol_Darah_Ayah,
                'Pendidikan_Terakhir_Ayah' => $request->Pendidikan_Terakhir_Ayah,
                'Pekerjaan_Ayah' => $request->Pekerjaan_Ayah,
                'Penghasilan_Ayah' => $request->Penghasilan_Ayah,
                'Kebutuhan_Khusus_Ayah' => $request->Kebutuhan_Khusus_Ayah,
                'Nomor_KTP_Ayah' => $request->Nomor_KTP_Ayah,
                'Alamat_Ayah' => $request->Alamat_Ayah,
                'No_HP_ayah' => $request->No_HP_ayah,
                'Kewarganegaraan_Ayah' => 'WNI',

                // Ibu
                'Nama_Ibu' => $request->Nama_Ibu,
                'Tempat_Lhr_Ibu' => $request->Tempat_Lhr_Ibu,
                'Tgl_Lhr_Ibu' => $request->Tgl_Lhr_Ibu,
                'Bln_Lhr_Ibu' => $request->Bln_Lhr_Ibu,
                'Thn_Lhr_Ibu' => $request->Thn_Lhr_Ibu,
                'Agama_Ibu' => $request->Agama_Ibu,
                'Gol_Darah_Ibu' => $request->Gol_Darah_Ibu,
                'Pendidikan_Terakhir_Ibu' => $request->Pendidikan_Terakhir_Ibu,
                'Pekerjaan_Ibu' => $request->Pekerjaan_Ibu,
                'Penghasilan_Ibu' => $request->Penghasilan_Ibu,
                'Kebutuhan_Khusus_Ibu' => $request->Kebutuhan_Khusus_Ibu,
                'Nomor_KTP_Ibu' => $request->Nomor_KTP_Ibu,
                'Alamat_Ibu' => $request->Alamat_Ibu,
                'No_HP_ibu' => $request->No_HP_ibu,
                'Kewarganegaraan_Ibu' => 'WNI',
            ]);

            // 4. Create Siswa Data Pendaftar
            $pendaftar = SiswaDataPendaftar::create([
                'id_siswa_data' => $siswaData->id,
                'nama' => $request->nama_pendaftar,

                // Registration Details
                'Nama_Lengkap' => $request->nama_lengkap, // From Siswa Data
                'Tgl_Daftar' => now()->toDateString(),
                'program_sekolah' => 'S1', // Default per request/schema
                'Kelas_Program_Kuliah' => $request->Kelas_Program_Kuliah,
                'Prodi_Pilihan_1' => $request->Prodi_Pilihan_1,
                'Prodi_Pilihan_2' => $request->Prodi_Pilihan_2,
                'Jalur_PMB' => $request->Jalur_PMB,
                'Jenis_Pembiayaan' => $request->Jenis_Pembiayaan,

                // Transfer Data
                'NIMKO_Asal' => $request->NIMKO_Asal,
                'Prodi_Asal' => $request->Prodi_Asal,
                'PT_Asal' => $request->PT_Asal,
                'Jml_SKS_Asal' => $request->Jml_SKS_Asal,
                'IPK_Asal' => $request->IPK_Asal,
                'Semester_Asal' => $request->Semester_Asal,

                // Documents & Photos (Assuming paths/strings for now)
                'Legalisir_Ijazah' => $request->Legalisir_Ijazah,
                'Legalisir_SKHU' => $request->Legalisir_SKHU,
                'Copy_KTP' => $request->Copy_KTP,
                'File_Foto_Berwarna' => $request->File_Foto_Berwarna,

                'status_valid' => '0',
            ]);

            // Update Pendaftaran ID in SiswaData if needed (based on model fillable 'id_pendaftaran')
            $siswaData->update([
                'id_pendaftaran' => $pendaftar->id,
            ]);

            // 5. Create Riwayat Pendidikan (if Jenjang Selected)
            if ($request->filled('id_jenjang_pendidikan')) {
                RiwayatPendidikan::create([
                    'id_siswa_data' => $siswaData->id,
                    'id_jenjang_pendidikan' => $request->id_jenjang_pendidikan,
                    'ro_jns_daftar' => 1, // Default 'Peserta Didik Baru' (Verify ID if enum/ref exists)
                ]);
            }

            DB::commit();

            return redirect()->route('pendaftaran.index')
                ->with('success', 'Pendaftaran berhasil! Silakan login dengan akun yang telah dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }
}
