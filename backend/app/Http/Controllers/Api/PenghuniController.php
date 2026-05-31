<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Penghuni\UpsertPenghuniRequest;
use App\Models\Penghuni;
use App\Models\HistoriHuni;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Http\Resources\PenghuniResource;
use App\Http\Resources\PembayaranResource;
use App\Http\Resources\TagihanResource;
use Illuminate\Support\Facades\Storage;

class PenghuniController extends Controller
{
    public function index()
    {
        $penghuni = Penghuni::latest()->get();
        return PenghuniResource::collection($penghuni)
            ->response()
            ->setEncodingOptions(JSON_UNESCAPED_SLASHES);
    }

    public function store(UpsertPenghuniRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('foto_ktp')) {
            $path = $request->file('foto_ktp')->store('foto_ktp', 'public');
            $validatedData['foto_ktp'] = $path;
        }

        $penghuni = Penghuni::create($validatedData);

        return response()->json([
            'message' => 'Data penghuni berhasil ditambahkan',
            'data' => new PenghuniResource($penghuni)
        ], 201);
    }

    public function show(Penghuni $penghuni)
    {
        $penghuni->load([
            'historiHuni' => function ($query) {
                $query->whereNull('tanggal_selesai')->with('rumah');
            }
        ]);

        return (new PenghuniResource($penghuni))
            ->response()
            ->setEncodingOptions(JSON_UNESCAPED_SLASHES);
    }

    public function update(UpsertPenghuniRequest $request, Penghuni $penghuni)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('foto_ktp')) {
            if ($penghuni->foto_ktp) {
                Storage::disk('public')->delete($penghuni->foto_ktp);
            }

            $validatedData['foto_ktp'] = $request->file('foto_ktp')->store('foto_ktp', 'public');
        }

        $penghuni->update($validatedData);

        return response()->json([
            'message' => 'Data penghuni berhasil diperbarui',
            'data' => new PenghuniResource($penghuni),
        ], 200, [], JSON_UNESCAPED_SLASHES);
    }

    public function destroy(Penghuni $penghuni)
    {
        $penghuni->delete();
        return response()->json(['message' => 'Data penghuni berhasil dihapus']);
    }

    public function tagihan(Penghuni $penghuni)
    {
        $rumahIds = HistoriHuni::where('penghuni_id', $penghuni->id)
            ->distinct()
            ->pluck('rumah_id');

        $tagihan = Tagihan::with(['rumah', 'jenisIuran'])
            ->whereIn('rumah_id', $rumahIds)
            ->orderBy('periode_tahun', 'desc')
            ->orderBy('periode_bulan', 'desc')
            ->get();

        return TagihanResource::collection($tagihan);
    }

    public function pembayaran(Penghuni $penghuni)
    {
        $pembayaran = Pembayaran::with([
            'rumah',
            'penghuni',
            'detailPembayaran.tagihan.jenisIuran'
        ])
            ->where('penghuni_id', $penghuni->id)
            ->orderBy('tanggal_bayar', 'desc')
            ->get();

        return PembayaranResource::collection($pembayaran);
    }
}