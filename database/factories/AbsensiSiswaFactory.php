<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AbsensiSiswa;
use App\Models\AkademikKrs;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AbsensiSiswa>
 */
class AbsensiSiswaFactory extends Factory
{
    protected $model = AbsensiSiswa::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_krs' => AkademikKrs::factory(),
            'status' => $this->faker->randomElement(['Hadir', 'Izin', 'Sakit', 'Alpa']),
            'waktu_absen' => now(),
        ];
    }
}
