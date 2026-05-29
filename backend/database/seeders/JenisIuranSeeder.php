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
                'nama_iuran' => 'Iuran Satpam',
                'nominal_default' => 100000,
            ],
            [
                'nama_iuran' => 'Iuran Kebersihan',
                'nominal_default' => 15000,
            ]
        ];

        foreach ($iuranUtama as $iuran) {
            JenisIuran::updateOrCreate(
                ['nama_iuran' => $iuran['nama_iuran']], 
                $iuran
            );
        }
        
        try {
            JenisIuran::factory()->count(2)->create();
        } catch (\Exception $e) {
            $this->command->error("Factory Jenis Iuran Gagal: " . $e->getMessage());
        }
    }
}