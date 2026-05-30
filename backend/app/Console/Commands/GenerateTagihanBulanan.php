<?php

namespace App\Console\Commands;

use App\Enums\StatusHuni;
use Illuminate\Console\Command;
use App\Models\Rumah;
use App\Models\JenisIuran;
use App\Models\Tagihan;
use Carbon\Carbon;

class GenerateTagihanBulanan extends Command
{
    protected $signature = 'rt:generate-tagihan {--bulan=} {--tahun=}';
    protected $description = 'Otomatis membuat tagihan bulanan untuk semua rumah yang sedang dihuni.';

    public function handle()
    {
        $bulan = $this->option('bulan') ?? Carbon::now()->month;
        $tahun = $this->option('tahun') ?? Carbon::now()->year;

        $rumahDihuni = Rumah::where('status_huni', StatusHuni::DIHUNI)->get();
        $semuaIuran = JenisIuran::all();
        $dibuat = 0;

        foreach ($rumahDihuni as $rumah) {
            foreach ($semuaIuran as $iuran) {
                $tagihanAda = Tagihan::where('rumah_id', $rumah->id)
                    ->where('jenis_iuran_id', $iuran->id)
                    ->where('periode_bulan', $bulan)
                    ->where('periode_tahun', $tahun)
                    ->exists();

                if (!$tagihanAda) {
                    Tagihan::create([
                        'rumah_id' => $rumah->id,
                        'jenis_iuran_id' => $iuran->id,
                        'periode_bulan' => $bulan,
                        'periode_tahun' => $tahun,
                        'nominal_tagihan' => $iuran->nominal_default,
                        'status_pembayaran' => 'belum_bayar',
                    ]);
                    $dibuat++;
                }
            }
        }

        $this->info("Proses selesai! $dibuat tagihan baru berhasil digenerate untuk periode $bulan/$tahun.");
    }
}