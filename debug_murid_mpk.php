<?php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\MataPelajaranKelas;
use Illuminate\Support\Facades\Auth;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$email = 'nurul@email.com';
$user = User::where('email', $email)->first();
if (!$user) {
    die("User not found\n");
}
Auth::login($user);

echo "Testing Query...\n";
$query = MataPelajaranKelas::query();
// Filter logic
if ($user && $user->hasRole('murid') && !$user->hasAnyRole(['super_admin', 'admin'])) {
    // New query logic
    $query->whereHas('kelas.akademikKrs.riwayatPendidikan.siswa', function ($q) use ($user) {
        $q->where('user_id', $user->id);
    });
}

try {
    echo "Count: " . $query->count() . "\n";
    $first = $query->first();

    if ($first) {
        echo "ID: " . $first->id . "\n";

        echo "Testing 'nama' attribute (recordTitleAttribute): ";
        try {
            echo "'" . $first->nama . "'\n";
        } catch (\Throwable $e) {
            echo "ERROR: " . $e->getMessage() . "\n";
        }

        echo "Testing Accessors:\n";
        try {
            echo "  nilai_rata_rata: " . $first->nilai_rata_rata . "\n";
        } catch (\Throwable $e) {
            echo "  nilai_rata_rata ERROR: " . $e->getMessage() . "\n";
        }
        try {
            echo "  jumlah_mahasiswa: " . $first->jumlah_mahasiswa . "\n";
        } catch (\Throwable $e) {
            echo "  jumlah_mahasiswa ERROR: " . $e->getMessage() . "\n";
        }
        try {
            echo "  progress: " . $first->progress . "\n";
        } catch (\Throwable $e) {
            echo "  progress ERROR: " . $e->getMessage() . "\n";
        }

        echo "Testing Relations:\n";
        try {
            echo "  dosenData: " . ($first->dosenData ? 'OK' : 'NULL') . "\n";
        } catch (\Throwable $e) {
            echo "  dosenData ERROR: " . $e->getMessage() . "\n";
        }
        try {
            echo "  kelas: " . ($first->kelas ? 'OK' : 'NULL') . "\n";
        } catch (\Throwable $e) {
            echo "  kelas ERROR: " . $e->getMessage() . "\n";
        }
        try {
            echo "  mataPelajaranKurikulum: " . ($first->mataPelajaranKurikulum ? 'OK' : 'NULL') . "\n";
        } catch (\Throwable $e) {
            echo "  mataPelajaranKurikulum ERROR: " . $e->getMessage() . "\n";
        }
    } else {
        echo "No records found.\n";
    }
} catch (\Throwable $e) {
    echo "FATAL QUERY ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
