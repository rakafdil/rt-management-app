<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HistoriHuniController;
use App\Http\Controllers\Api\PembayaranController;
use App\Http\Controllers\Api\PengeluaranController;
use App\Http\Controllers\Api\PenghuniController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\RumahController;
use App\Http\Controllers\Api\TagihanController;

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1/auth')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('v1')->group(function () {

    // apiResource otomatis membuatkan endpoint: GET(index, show), POST(store), PUT(update), DELETE(destroy)
    Route::apiResource('penghuni', PenghuniController::class);

    Route::apiResource('rumah', RumahController::class);
    
    Route::prefix('rumah/{rumah}')->group(function () {
        Route::get('/histori', [HistoriHuniController::class, 'index']);
        Route::post('/assign', [HistoriHuniController::class, 'assign']);
        Route::post('/unassign', [HistoriHuniController::class, 'unassign']);
        Route::get('/tagihan', [TagihanController::class, 'getByRumah']);
    });

    Route::apiResource('/tagihan', TagihanController::class);
    Route::post('/tagihan/generate-manual', [TagihanController::class, 'generateManual']); 
    
    // Hanya buka method Index (list), Store (bayar), dan Show (detail kwitansi)
    // Pembayaran biasanya tidak boleh di-PUT/Update demi keamanan audit.
    Route::apiResource('pembayaran', PembayaranController::class)->only(['index', 'store', 'show']);

    Route::apiResource('pengeluaran', PengeluaranController::class);

    Route::prefix('reports')->group(function () {
        Route::get('/summary', [ReportController::class, 'summary']);
        
        Route::get('/detail', [ReportController::class, 'detail']);
    });

});