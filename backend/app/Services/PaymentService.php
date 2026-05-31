<?php

namespace App\Services;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\DetailPembayaran;
use Illuminate\Support\Facades\DB;
use Exception;

class PaymentService
{
    /**
     * Memproses transaksi pembayaran dan mengalokasikannya ke tagihan-tagihan.
     * * @param array $data Data yang tervalidasi dari form request
     * @return Pembayaran
     * @throws Exception
     */
    public function processPayment(array $data)
    {
        return DB::transaction(function () use ($data) {

            $pembayaran = Pembayaran::create([
                'rumah_id' => $data['rumah_id'],
                'penghuni_id' => $data['penghuni_id'] ?? null,
                'tanggal_bayar' => $data['tanggal_bayar'],
                'total_bayar' => $data['total_bayar'],
                'metode_pembayaran' => $data['metode_pembayaran'] ?? 'Tunai',
                'catatan' => $data['catatan'] ?? null,
            ]);

            $saldoPemasukan = (float) $data['total_bayar'];

            $tagihanList = Tagihan::whereIn('id', $data['tagihan_ids'])
                ->where('status_pembayaran', '!=', 'lunas')
                ->orderBy('periode_tahun', 'asc')
                ->orderBy('periode_bulan', 'asc')
                ->lockForUpdate()
                ->get();

            if ($tagihanList->isEmpty()) {
                throw new Exception('Tagihan yang dipilih tidak ditemukan atau sudah lunas.');
            }

            foreach ($tagihanList as $tagihan) {
                if ($saldoPemasukan <= 0)
                    break;

                $sudahDibayar = DetailPembayaran::where('tagihan_id', $tagihan->id)->sum('nominal_alokasi');
                $sisaTagihan = $tagihan->nominal_tagihan - $sudahDibayar;

                if ($sisaTagihan <= 0)
                    continue;

                $alokasi = min($saldoPemasukan, $sisaTagihan);

                DetailPembayaran::create([
                    'pembayaran_id' => $pembayaran->id,
                    'tagihan_id' => $tagihan->id,
                    'nominal_alokasi' => $alokasi,
                ]);

                $saldoPemasukan -= $alokasi;

                $sisaTagihanBaru = $sisaTagihan - $alokasi;

                Tagihan::where('id', $tagihan->id)->update([
                    'status_pembayaran' => $sisaTagihanBaru <= 0 ? 'lunas' : 'sebagian',
                ]);
            }

            return $pembayaran;
        });
    }
}