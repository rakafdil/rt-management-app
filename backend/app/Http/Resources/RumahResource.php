<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RumahResource extends JsonResource
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
                'nomor_telepon' => $this->penghuni_aktif->nomor_telepon,
            ] : null,
        ];
    }
}