<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PenghuniResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_lengkap' => $this->nama_lengkap,
            'foto_ktp_url' => $this->foto_ktp ? url(Storage::url($this->foto_ktp)) : null,
            'status_penghuni' => $this->status_penghuni,
            'nomor_telepon' => $this->nomor_telepon,
            'status_menikah' => $this->status_menikah,
            'status_menikah_label' => $this->status_menikah ? 'Menikah' : 'Belum Menikah',
            'bergabung_sejak' => $this->created_at->format('d M Y'),
            'rumah_aktif' => $this->whenLoaded('historiHuni', function () {
                $historiAktif = $this->historiHuni->first();

                if (!$historiAktif || !$historiAktif->rumah) {
                    return null;
                }

                return [
                    'id' => $historiAktif->rumah->id,
                    'blok_nomor' => $historiAktif->rumah->blok_nomor,
                ];
            }),
        ];
    }
}