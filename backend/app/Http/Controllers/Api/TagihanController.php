<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusHuni;
use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Models\Rumah;
use App\Models\JenisIuran;
use App\Http\Requests\Tagihan\StoreTagihanRequest;
use App\Http\Requests\Tagihan\UpdateTagihanRequest;
use App\Http\Resources\TagihanResource;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TagihanController extends Controller
{
    public function index(Request $request)
    {
        $query = Tagihan::with(['rumah', 'jenisIuran'])->orderBy('periode_tahun', 'desc')->orderBy('periode_bulan', 'desc');

        if ($request->has('status')) {
            $query->where('status_pembayaran', $request->status);
        }

        return TagihanResource::collection($query->get());
    }

    public function getByRumah(Rumah $rumah)
    {
        $tagihan = Tagihan::with('jenisIuran')
            ->where('rumah_id', $rumah->id)
            ->orderBy('periode_tahun', 'desc')
            ->orderBy('periode_bulan', 'desc')
            ->get();

        return TagihanResource::collection($tagihan);
    }

    public function generateManual(Request $request)
    {
        $request->validate([
            'bulan' => 'nullable|integer|between:1,12',
            'tahun' => 'nullable|integer|min:2000',
        ]);

        $bulan = $request->bulan ?? Carbon::now()->month;
        $tahun = $request->tahun ?? Carbon::now()->year;

        $rumahDihuni = Rumah::where('status_huni', StatusHuni::DIHUNI)->get();
        $semuaIuran = JenisIuran::all();
        $dibuat = 0;

        foreach ($rumahDihuni as $rumah) {
            foreach ($semuaIuran as $iuran) {
                $tagihanAda = Tagihan::where('rumah_id', $rumah->id)
                    ->where('jenis_iuran_id', $iuran->id)
                    ->where('periode_bulan', $bulan)
                    ->where('periode_tahun', $tahun)
                    ->exists();

                if (!$tagihanAda) {
                    Tagihan::create([
                        'rumah_id' => $rumah->id,
                        'jenis_iuran_id' => $iuran->id,
                        'periode_bulan' => $bulan,
                        'periode_tahun' => $tahun,
                        'nominal_tagihan' => $iuran->nominal_default,
                        'status_pembayaran' => 'belum_bayar',
                    ]);
                    $dibuat++;
                }
            }
        }

        return response()->json([
            'message' => 'Proses generate tagihan manual selesai.',
            'detail' => "$dibuat tagihan baru berhasil dibuat untuk periode $bulan/$tahun."
        ]);
    }

    public function store(StoreTagihanRequest $request)
    {
        $validatedData = $request->validated();

        if (!isset($validatedData['nominal_tagihan'])) {
            $jenisIuran = JenisIuran::findOrFail($validatedData['jenis_iuran_id']);

            $validatedData['nominal_tagihan'] = $jenisIuran->nominal_default;
        }

        $tagihan = Tagihan::create($validatedData);

        $tagihan->load(['rumah', 'jenisIuran']);

        return response()->json([
            'message' => 'Tagihan berhasil dibuat.',
            'data' => new TagihanResource($tagihan)
        ], 201);
    }

    public function show(Tagihan $tagihan)
    {
        $tagihan->load(['rumah', 'jenisIuran']);
        return new TagihanResource($tagihan);
    }

    public function update(UpdateTagihanRequest $request, Tagihan $tagihan)
    {
        $validatedData = $request->validated();

        if (!isset($validatedData['nominal_tagihan'])) {
            $jenisIuran = JenisIuran::findOrFail($validatedData['jenis_iuran_id']);

            $validatedData['nominal_tagihan'] = $jenisIuran->nominal_default;
        }

        $tagihan->update($validatedData);

        return response()->json([
            'message' => 'Tagihan berhasil diperbarui.',
            'data' => new TagihanResource($tagihan)
        ]);
    }

    public function destroy(Tagihan $tagihan)
    {
        if ($tagihan->status_pembayaran !== 'belum_bayar') {
            return response()->json(['message' => 'Tagihan yang sudah dibayar (walau sebagian) tidak boleh dihapus.'], 403);
        }

        $tagihan->delete();
        return response()->json(['message' => 'Tagihan berhasil dihapus.']);
    }
}