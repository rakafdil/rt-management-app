<?php

namespace App\Services;

use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\DB;

class ReportService
{
    public function getYearlySummary(int $year)
    {
        $pemasukan = Pembayaran::select(
                DB::raw('MONTH(tanggal_bayar) as bulan'),
                DB::raw('SUM(total_bayar) as total')
            )
            ->whereYear('tanggal_bayar', $year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan')->toArray();

        $pengeluaran = Pengeluaran::select(
                DB::raw('MONTH(tanggal_pengeluaran) as bulan'),
                DB::raw('SUM(nominal) as total')
            )
            ->whereYear('tanggal_pengeluaran', $year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan')->toArray();

        $chartData = [];
        $saldoKumulatif = $this->getSaldoSebelumTahun($year); 

        for ($i = 1; $i <= 12; $i++) {
            $in = $pemasukan[$i] ?? 0;
            $out = $pengeluaran[$i] ?? 0;
            
            $saldoKumulatif = $saldoKumulatif + $in - $out;

            $chartData[] = [
                'bulan' => $i,
                'nama_bulan' => date('M', mktime(0, 0, 0, $i, 1)), 
                'pemasukan' => (float) $in,
                'pengeluaran' => (float) $out,
                'saldo_akhir' => (float) $saldoKumulatif
            ];
        }

        $totalPemasukanTahunIni = array_sum($pemasukan);
        $totalPengeluaranTahunIni = array_sum($pengeluaran);

        return [
            'tahun' => $year,
            'total_pemasukan' => $totalPemasukanTahunIni,
            'total_pengeluaran' => $totalPengeluaranTahunIni,
            'saldo_sisa_saat_ini' => $this->getSaldoSaatIni(),
            'grafik' => $chartData
        ];
    }

    public function getMonthlyDetail(int $month, int $year)
    {
        $listPemasukan = Pembayaran::with(['rumah', 'penghuni', 'detailPembayaran', 'detailPembayaran.tagihan'])
            ->whereMonth('tanggal_bayar', $month)
            ->whereYear('tanggal_bayar', $year)
            ->orderBy('tanggal_bayar', 'asc')
            ->get();

        $listPengeluaran = Pengeluaran::with('kategori')
            ->whereMonth('tanggal_pengeluaran', $month)
            ->whereYear('tanggal_pengeluaran', $year)
            ->orderBy('tanggal_pengeluaran', 'asc')
            ->get();

        return [
            'periode' => ['bulan' => $month, 'tahun' => $year],
            'ringkasan' => [
                'total_pemasukan' => $listPemasukan->sum('total_bayar'),
                'total_pengeluaran' => $listPengeluaran->sum('nominal'),
            ],
            'detail_transaksi' => [
                'pemasukan' => $listPemasukan,
                'pengeluaran' => $listPengeluaran
            ]
        ];
    }

    public function getSaldoSaatIni(): float
    {
        $totalMasuk = Pembayaran::sum('total_bayar');
        $totalKeluar = Pengeluaran::sum('nominal');
        return (float) ($totalMasuk - $totalKeluar);
    }

    private function getSaldoSebelumTahun(int $year): float
    {
        $totalMasukSebelumnya = Pembayaran::whereYear('tanggal_bayar', '<', $year)->sum('total_bayar');
        $totalKeluarSebelumnya = Pengeluaran::whereYear('tanggal_pengeluaran', '<', $year)->sum('nominal');
        return (float) ($totalMasukSebelumnya - $totalKeluarSebelumnya);
    }
}