<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RumahDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'blok_nomor' => $this->blok_nomor,
            'status_huni' => $this->status_huni->value,
            'penghuni_aktif' => $this->penghuni_aktif ? [
                'id' => $this->penghuni_aktif->id,
                'nama_lengkap' => $this->penghuni_aktif->nama_lengkap,
            ] : null,
            'histori_huni' => $this->whenLoaded('historiHuni', function () {
                return $this->historiHuni->map(function ($histori) {
                    return [
                        'id' => $histori->id,
                        'nama_lengkap' => $histori->penghuni->nama_lengkap ?? 'Unknown',
                        'tanggal_mulai' => $histori->tanggal_mulai->format('d M Y'),
                        'tanggal_selesai' => $histori->tanggal_selesai ? $histori->tanggal_selesai->format('d M Y') : 'Sekarang (Masih Aktif)',
                    ];
                });
            }),
        ];
    }
}