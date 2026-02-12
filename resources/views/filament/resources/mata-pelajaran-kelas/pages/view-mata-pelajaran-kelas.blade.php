<div>
    <x-filament-panels::page>
        {{ $this->infolist }}

        <div class="mt-6" wire:init="loadTables">
            @if($activeTab === 'mahasiswa')
                <x-filament::section>
                    <x-slot name="heading">
                        Daftar Mahasiswa & Absensi
                    </x-slot>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Nama</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">NIM</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Prodi</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Kelas</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Tahun Angkatan</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">H</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">S</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">I</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">A</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                                @forelse($mahasiswaData ?? [] as $index => $krs)
                                    <tr>
                                        <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $krs->riwayatPendidikan->siswaData->nama ?? '-' }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $krs->riwayatPendidikan->nomor_induk ?? '-' }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $krs->riwayatPendidikan->jurusan->nama ?? '-' }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $krs->kelas->programKelas->nilai ?? '-' }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            @if($krs->riwayatPendidikan->angkatan)
                                                {{ $krs->riwayatPendidikan->angkatan }}/{{ $krs->riwayatPendidikan->angkatan + 1 }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm text-center">{{ $krs->hadir_count ?? 0 }}</td>
                                        <td class="px-4 py-3 text-sm text-center">{{ $krs->sakit_count ?? 0 }}</td>
                                        <td class="px-4 py-3 text-sm text-center">{{ $krs->izin_count ?? 0 }}</td>
                                        <td class="px-4 py-3 text-sm text-center">{{ $krs->alpa_count ?? 0 }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="px-4 py-8 text-sm text-center text-gray-500">
                                            Tidak ada data mahasiswa
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </x-filament::section>
                
            @elseif($activeTab === 'penilaian')
                <x-filament::section>
                    <x-slot name="heading">
                        Penilaian Mahasiswa
                    </x-slot>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Nama Mahasiswa</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">NIM</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Nilai</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Tanggal Input</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                                @forelse($penilaianData ?? [] as $index => $ljk)
                                    <tr>
                                        <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $ljk->akademikKrs->riwayatPendidikan->siswaData->nama ?? '-' }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $ljk->akademikKrs->riwayatPendidikan->nomor_induk ?? '-' }}</td>
                                        <td class="px-4 py-3 text-sm">{{ number_format($ljk->nilai ?? 0, 2) }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $ljk->created_at ? $ljk->created_at->format('d/m/Y') : '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-8 text-sm text-center text-gray-500">
                                            Belum ada data nilai
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </x-filament::section>
                
            @elseif($activeTab === 'jurnal')
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
                    <p class="text-gray-500">Jurnal Pengajaran - Coming Soon</p>
                </div>
            @elseif($activeTab === 'dokumen')
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
                    <p class="text-gray-500">Dokumen Perkuliahan - Coming Soon</p>
                </div>
            @elseif($activeTab === 'ujian')
                <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
                    <p class="text-gray-500">Ujian - Coming Soon</p>
                </div>
            @endif
        </div>
    </x-filament-panels::page>
</div>
