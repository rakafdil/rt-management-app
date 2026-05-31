<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Keuangan\StorePengeluaranRequest;
use App\Http\Requests\Keuangan\UpdatePengeluaranRequest;
use App\Models\KategoriPengeluaran;
use App\Models\Pengeluaran;
use App\Http\Resources\PengeluaranResource;
use DB;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluaran = Pengeluaran::with('kategori')->orderBy('tanggal_pengeluaran', 'desc')->get();
        return PengeluaranResource::collection($pengeluaran);
    }

    public function store(StorePengeluaranRequest $request)
    {
        $validated = $request->validated();

        return DB::transaction(function () use ($validated) {

            if (
                empty($validated['kategori_id']) &&
                !empty($validated['nama_kategori'])
            ) {
                $kategori = KategoriPengeluaran::firstOrCreate([
                    'nama_kategori' => trim($validated['nama_kategori'])
                ]);

                $validated['kategori_id'] = $kategori->id;
            }

            unset($validated['nama_kategori']);

            $pengeluaran = Pengeluaran::create($validated);

            $pengeluaran->load('kategori');

            return response()->json([
                'message' => 'Catatan pengeluaran berhasil ditambahkan.',
                'data' => new PengeluaranResource($pengeluaran),
            ], 201);
        });
    }

    public function show(Pengeluaran $pengeluaran)
    {
        $pengeluaran->load('kategori');
        return new PengeluaranResource($pengeluaran);
    }

    public function update(UpdatePengeluaranRequest $request, Pengeluaran $pengeluaran)
    {
        $validatedData = $request->validated();

        $pengeluaran->update($validatedData);

        return response()->json([
            'message' => 'Catatan pengeluaran berhasil diperbarui.',
            'data' => new PengeluaranResource($pengeluaran)
        ]);
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
        return response()->json(['message' => 'Catatan pengeluaran berhasil dihapus.']);
    }
}