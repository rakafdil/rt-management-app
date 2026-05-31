<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetMonthlyLaporanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data = $this->resource;

        return [
            'periode' => data_get($data, 'periode'),
            'ringkasan' => data_get($data, 'ringkasan'),
            'detail_transaksi' => [
                'pemasukan' => PembayaranResource::collection(
                    collect(data_get($data, 'detail_transaksi.pemasukan', []))
                ),
                'pengeluaran' => PengeluaranResource::collection(
                    collect(data_get($data, 'detail_transaksi.pengeluaran', []))
                ),
            ],
        ];
    }
}
