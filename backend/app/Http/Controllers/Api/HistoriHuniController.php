<?php

namespace App\Http\Controllers\Api;

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
        if ($rumah->status_huni === 'dihuni') {
            return response()->json([
                'message' => 'Rumah ini masih dihuni. Keluarkan penghuni sebelumnya terlebih dahulu.'
            ], 422);
        }

        DB::transaction(function () use ($request, $rumah) {
            HistoriHuni::create([
                'rumah_id' => $rumah->id,
                'penghuni_id' => $request->penghuni_id,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => null,
            ]);

            $rumah->update(['status_huni' => 'dihuni']);
        });

        return response()->json(['message' => 'Penghuni berhasil dimasukkan ke rumah ini.']);
    }

    public function unassign(UnassignPenghuniRequest $request, Rumah $rumah)
    {
        $historiAktif = HistoriHuni::where('rumah_id', $rumah->id)
            ->whereNull('tanggal_selesai')
            ->first();

        if (!$historiAktif) {
            return response()->json(['message' => 'Tidak ada penghuni aktif di rumah ini.'], 400);
        }

        DB::transaction(function () use ($request, $rumah, $historiAktif) {
            $historiAktif->update(['tanggal_selesai' => $request->tanggal_selesai]);

            $rumah->update(['status_huni' => 'kosong']);
        });

        return response()->json(['message' => 'Penghuni berhasil dikeluarkan dari rumah ini.']);
    }
}