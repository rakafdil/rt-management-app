<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisIuran;

class JenisIuranSeeder extends Seeder
{
    public function run(): void
    {
        $iuranUtama = [
            [
                'nama_iuran' => 'Satpam',
                'nominal_default' => 100000,
            ],
            [
                'nama_iuran' => 'Kebersihan',
                'nominal_default' => 15000,
            ],
        ];

        foreach ($iuranUtama as $iuran) {
            JenisIuran::updateOrCreate(
                ['nama_iuran' => $iuran['nama_iuran']],
                $iuran
            );
        }
    }
}