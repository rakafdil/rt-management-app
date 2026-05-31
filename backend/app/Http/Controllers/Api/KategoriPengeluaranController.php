<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriPengeluaran;
use Illuminate\Http\Request;

class KategoriPengeluaranController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->q;

        return KategoriPengeluaran::query()
            ->when($query, function ($q) use ($query) {
                $q->where(
                    'nama_kategori',
                    'like',
                    "%{$query}%"
                );
            })
            ->limit(10)
            ->get();
    }
}
