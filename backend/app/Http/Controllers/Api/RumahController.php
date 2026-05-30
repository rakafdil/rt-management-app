<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusHuni;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rumah\StoreRumahRequest;
use App\Http\Requests\Rumah\UpdateRumahRequest;
use App\Models\HistoriHuni;
use App\Models\Rumah;
use App\Http\Resources\RumahResource;
use App\Http\Resources\RumahDetailResource;
use DB;
use Illuminate\Validation\ValidationException;

class RumahController extends Controller
{
    public function index()
    {
        $rumah = Rumah::with(['historiHuni.penghuni'])->orderBy('blok_nomor')->get();
        return RumahResource::collection($rumah);
    }

    public function store(StoreRumahRequest $request)
    {
        $store = $request->validated();
        $rumah = DB::transaction(function () use ($store) {
            $rumah = Rumah::create([
                'blok_nomor' => $store['blok_nomor'],
                'status_huni' => !empty($store['penghuni_id'])
                    ? StatusHuni::DIHUNI
                    : StatusHuni::KOSONG,
            ]);

            if (!empty($store['penghuni_id'])) {

                $aktif = HistoriHuni::query()
                    ->where('penghuni_id', $store['penghuni_id'])
                    ->whereNull('tanggal_selesai')
                    ->exists();

                if ($aktif) {
                    throw ValidationException::withMessages([
                        'penghuni_id' => 'Penghuni masih menempati rumah lain.',
                    ]);
                }

                $rumah->historiHuni()->create([
                    'penghuni_id' => $store['penghuni_id'],
                    'tanggal_mulai' => $store['tanggal_mulai'],
                ]);
            }

            return $rumah;
        });

        return response()->json([
            'message' => 'Data rumah berhasil ditambahkan.',
            'data' => new RumahResource($rumah->fresh()),
        ], 201);
    }

    public function show(Rumah $rumah)
    {
        $rumah->load(['historiHuni.penghuni']);
        return new RumahDetailResource($rumah);
    }

    public function update(UpdateRumahRequest $request, Rumah $rumah)
    {
        $store = $request->validated();
        $rumah = DB::transaction(function () use ($store, $rumah) {
            $rumah->update([
                'blok_nomor' => $store['blok_nomor'],
                'status_huni' => !empty($store['penghuni_id'])
                    ? StatusHuni::DIHUNI
                    : StatusHuni::KOSONG,
            ]);

            if (!empty($store['penghuni_id'])) {

                $aktif = HistoriHuni::query()
                    ->where('penghuni_id', $store['penghuni_id'])
                    ->whereNull('tanggal_selesai')
                    ->where('rumah_id', '!=', $rumah->id)
                    ->exists();

                if ($aktif) {
                    throw ValidationException::withMessages([
                        'penghuni_id' => 'Penghuni masih menempati rumah lain.',
                    ]);
                }
                $rumah->historiHuni()
                    ->whereNull('tanggal_selesai')
                    ->update(['tanggal_selesai' => now()]);

                $rumah->historiHuni()->create([
                    'penghuni_id' => $store['penghuni_id'],
                    'tanggal_mulai' => $store['tanggal_mulai'],
                ]);
                
            } else {
                $rumah->historiHuni()
                    ->whereNull('tanggal_selesai')
                    ->update(['tanggal_selesai' => now()]);
            }

            return $rumah;
        });

        return response()->json([
            'message' => 'Data rumah berhasil diperbarui.',
            'data' => new RumahResource($rumah->fresh()),
        ], 201);
    }
    public function destroy(Rumah $rumah)
    {
        $rumah->delete();
        return response()->json(['message' => 'Data rumah berhasil dihapus.']);
    }
}