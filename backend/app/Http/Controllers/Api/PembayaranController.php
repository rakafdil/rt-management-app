<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Keuangan\StorePembayaranRequest;
use App\Models\Pembayaran;
use App\Http\Resources\PembayaranResource;
use App\Models\Rumah;
use App\Services\PaymentService;

class PembayaranController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        $pembayaran = Pembayaran::with(['rumah', 'penghuni'])->latest()->get();
        return PembayaranResource::collection($pembayaran);
    }

    public function store(StorePembayaranRequest $request)
    {
        try {
            $validated = $request->validated();

            $pembayaran = $this->paymentService->processPayment($validated);

            $pembayaran->load(['rumah', 'penghuni', 'detailPembayaran.tagihan.jenisIuran']);

            return response()->json([
                'message' => 'Pembayaran berhasil diproses.',
                'data' => new PembayaranResource($pembayaran)
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memproses pembayaran.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with(['rumah', 'penghuni', 'detailPembayaran.tagihan.jenisIuran'])->findOrFail($id);
        return new PembayaranResource($pembayaran);
    }

    public function getByRumah(Rumah $rumah)
    {
        $tagihan = Pembayaran::with('detailPembayaran')
            ->where('rumah_id', $rumah->id)
            ->orderBy('periode_tahun', 'desc')
            ->orderBy('periode_bulan', 'desc')
            ->get();

        return PembayaranResource::collection($tagihan);
    }
}