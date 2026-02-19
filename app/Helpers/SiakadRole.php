<?php

namespace App\Helpers;

class SiakadRole
{
    const SUPER_ADMIN = 'super_admin';
    const ADMIN = 'admin';
    const DOSEN = 'pengajar';
    const MAHASISWA = 'murid';

    // Helper to get all roles
    public static function all(): array
    {
        return [
            self::SUPER_ADMIN,
            self::ADMIN,
            self::DOSEN,
            self::MAHASISWA,
        ];
    }
}
