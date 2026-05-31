<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusHuni;
use App\Http\Controllers\Controller;
use App\Http\Requests\Penghuni\AssignPenghuniRequest;
use App\Http\Requests\Penghuni\UnassignPenghuniRequest;
use App\Models\Rumah;
use App\Models\HistoriHuni;
use Illuminate\Support\Facades\DB;

class HistoriHuniController extends Controller
{
    public function index(Rumah $rumah)
    {
        $histori = $rumah->historiHuni()->with('penghuni')->orderBy('tanggal_mulai', 'desc')->get();
        return response()->json(['data' => $histori]);
    }

    public function assign(AssignPenghuniRequest $request, Rumah $rumah)
    {
        $penghuni = $request->validated();

        if ($rumah->status_huni === StatusHuni::DIHUNI) {
            return response()->json([
                'message' => 'Rumah ini masih dihuni. Keluarkan penghuni sebelumnya terlebih dahulu.'
            ], 422);
        }

        DB::transaction(function () use ($penghuni, $rumah) {
            HistoriHuni::create([
                'rumah_id' => $rumah->id,
                'penghuni_id' => $penghuni['penghuni_id'],
                'tanggal_mulai' => $penghuni['tanggal_mulai'],
                'tanggal_selesai' => null,
            ]);

            $rumah->update(['status_huni' => StatusHuni::DIHUNI]);
        });

        return response()->json(['message' => 'Penghuni berhasil dimasukkan ke rumah ini.']);
    }

    public function unassign(UnassignPenghuniRequest $request, Rumah $rumah)
    {
        $selesai = $request->validated();

        $historiAktif = HistoriHuni::where('rumah_id', $rumah->id)
            ->whereNull('tanggal_selesai')
            ->first();

        if (!$historiAktif) {
            return response()->json(['message' => 'Tidak ada penghuni aktif di rumah ini.'], 400);
        }

        DB::transaction(function () use ($selesai, $rumah, $historiAktif) {
            $historiAktif->update(['tanggal_selesai' => $selesai['tanggal_selesai']]);

            $rumah->update(['status_huni' => StatusHuni::KOSONG]);
        });

        return response()->json(['message' => 'Penghuni berhasil dikeluarkan dari rumah ini.']);
    }
}