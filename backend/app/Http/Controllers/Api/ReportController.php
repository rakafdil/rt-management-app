<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\GetReportRequest;
use App\Services\ReportService;
use App\Http\Requests;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }
 
    public function summary(Request $request)
    {
        $year = $request->query('tahun', date('Y'));
        
        $request->validate(['tahun' => 'nullable|integer|min:2000|max:' . (date('Y') + 5)]);

        $data = $this->reportService->getYearlySummary((int) $year);

        return response()->json([
            'message' => 'Berhasil mengambil summary laporan keuangan tahun ' . $year,
            'data' => $data
        ]);
    }

 
    public function detail(GetReportRequest $request)
    {
        $validated = $request->validated();
        
        $data = $this->reportService->getMonthlyDetail(
            $validated['bulan'], 
            $validated['tahun']
        );

        return response()->json([
            'message' => 'Berhasil mengambil rincian transaksi periode ' . $validated['bulan'] . '/' . $validated['tahun'],
            'data' => $data
        ]);
    }
}