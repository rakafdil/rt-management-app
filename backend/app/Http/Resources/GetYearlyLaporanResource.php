<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetYearlyLaporanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data = $this->resource;

        return [
            'tahun' => data_get($data, 'tahun'),
            'total_pemasukan' => data_get($data, 'total_pemasukan'),
            'total_pengeluaran' => data_get($data, 'total_pengeluaran'),
            'saldo_sisa_saat_ini' => data_get($data, 'saldo_sisa_saat_ini'),
            'grafik' => collect(data_get($data, 'grafik', []))->map(function ($item) {
                return [
                    'bulan' => data_get($item, 'bulan'),
                    'nama_bulan' => data_get($item, 'nama_bulan'),
                    'pemasukan' => data_get($item, 'pemasukan'),
                    'pengeluaran' => data_get($item, 'pengeluaran'),
                    'saldo_akhir' => data_get($item, 'saldo_akhir'),
                ];
            })->values(),
        ];
    }
}
