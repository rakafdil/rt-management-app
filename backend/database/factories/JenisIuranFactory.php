<?php

namespace Database\Factories;

use App\Models\JenisIuran;
use Illuminate\Database\Eloquent\Factories\Factory;

class JenisIuranFactory extends Factory
{
    protected $model = JenisIuran::class;

    public function definition(): array
    {
        $iuranOpsional = [
            'Iuran Kas RT',
            'Iuran Perbaikan Jalan',
            'Iuran 17 Agustus',
            'Iuran Kematian / Sosial',
            'Iuran Pengelolaan Sampah Tambahan',
            'Iuran Kegiatan Pemuda'
        ];

        return [
            'nama_iuran' => $this->faker->unique()->randomElement($iuranOpsional),
            'nominal_default' => $this->faker->randomElement([15000, 20000, 25000, 30000, 50000]),
        ];
    }
}