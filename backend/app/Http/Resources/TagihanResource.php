<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class TagihanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $namaBulan = Carbon::create()->month($this->periode_bulan)->translatedFormat('F');

        return [
            'id' => $this->id,
            'periode' => $namaBulan . ' ' . $this->periode_tahun,
            'periode_bulan' => $this->periode_bulan,
            'periode_tahun' => $this->periode_tahun,
            'nominal_tagihan' => $this->nominal_tagihan,
            'status_pembayaran' => $this->status_pembayaran,

            'jenis_iuran' => $this->whenLoaded('jenisIuran', function () {
                return [
                    'id' => $this->jenisIuran->id,
                    'nama_iuran' => $this->jenisIuran->nama_iuran,
                    'nominal_default' => $this->jenisIuran->nominal_default
                ];
            }),

            'rumah' => $this->whenLoaded('rumah', function () {
                return [
                    'id' => $this->rumah->id,
                    'blok_nomor' => $this->rumah->blok_nomor,
                    'penghuni_aktif' => $this->rumah->penghuni_aktif
                ];
            }),
            'created_at' => $this->created_at
        ];
    }
}