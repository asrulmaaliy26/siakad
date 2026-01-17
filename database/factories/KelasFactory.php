<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kelas;
use App\Models\ProgramKelas;
use App\Models\JenjangPendidikan;
use App\Models\TahunAkademik;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelas>
 */
class KelasFactory extends Factory
{
    protected $model = Kelas::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_program_kelas' => ProgramKelas::factory(),
            'semester' => $this->faker->numberBetween(1, 8),
            'id_jenjang_pendidikan' => JenjangPendidikan::factory(),
            'id_tahun_akademik' => TahunAkademik::factory(),
            'status_aktif' => 'Y',
        ];
    }
}
