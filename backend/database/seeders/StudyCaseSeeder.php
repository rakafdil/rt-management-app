<?php

namespace Database\Seeders;

use App\Models\DetailPembayaran;
use App\Models\HistoriHuni;
use App\Models\JenisIuran;
use App\Models\KategoriPengeluaran;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Penghuni;
use App\Models\Rumah;
use App\Models\Tagihan;
use Carbon\Carbon;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class StudyCaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create('id_ID');
        $today = Carbon::today();

        $jenisSatpam = JenisIuran::updateOrCreate(
            ['nama_iuran' => 'Satpam'],
            ['nominal_default' => 100000]
        );

        $jenisKebersihan = JenisIuran::updateOrCreate(
            ['nama_iuran' => 'Kebersihan'],
            ['nominal_default' => 15000]
        );

        $rumahTetap = collect();
        for ($i = 1; $i <= 15; $i++) {
            $rumahTetap->push(Rumah::create([
                'blok_nomor' => 'A' . $i,
                'status_huni' => 'dihuni',
            ]));
        }

        $rumahKontrakDihuni = collect();
        for ($i = 16; $i <= 20; $i++) {
            $status = $i <= 17 ? 'dihuni' : 'kosong';
            $rumah = Rumah::create([
                'blok_nomor' => 'A' . $i,
                'status_huni' => $status,
            ]);

            if ($status === 'dihuni') {
                $rumahKontrakDihuni->push($rumah);
            }
        }

        $penghuniTetap = collect();
        for ($i = 0; $i < 15; $i++) {
            $penghuniTetap->push(Penghuni::create([
                'nama_lengkap' => $faker->name(),
                'foto_ktp' => 'https://i.pravatar.cc/400?u=' . $faker->uuid(),
                'status_penghuni' => 'tetap',
                'nomor_telepon' => $faker->phoneNumber(),
                'status_menikah' => $faker->boolean(50),
            ]));
        }

        $penghuniKontrak = collect();
        for ($i = 0; $i < 3; $i++) {
            $penghuniKontrak->push(Penghuni::create([
                'nama_lengkap' => $faker->name(),
                'foto_ktp' => 'https://i.pravatar.cc/400?u=' . $faker->uuid(),
                'status_penghuni' => 'kontrak',
                'nomor_telepon' => $faker->phoneNumber(),
                'status_menikah' => $faker->boolean(50),
            ]));
        }

        foreach ($rumahTetap as $index => $rumah) {
            HistoriHuni::create([
                'penghuni_id' => $penghuniTetap[$index]->id,
                'rumah_id' => $rumah->id,
                'tanggal_mulai' => $today->copy()->subYears(1)->subMonths($index % 6),
                'tanggal_selesai' => null,
            ]);
        }

        foreach ($rumahKontrakDihuni as $index => $rumah) {
            if (!isset($penghuniKontrak[$index])) {
                continue;
            }

            HistoriHuni::create([
                'penghuni_id' => $penghuniKontrak[$index]->id,
                'rumah_id' => $rumah->id,
                'tanggal_mulai' => $today->copy()->subMonths(2 + $index),
                'tanggal_selesai' => null,
            ]);
        }

        $kategoriOperasional = KategoriPengeluaran::create(['nama_kategori' => 'Operasional/Gaji']);
        $kategoriFasilitas = KategoriPengeluaran::create(['nama_kategori' => 'Fasilitas']);
        $kategoriDarurat = KategoriPengeluaran::create(['nama_kategori' => 'Darurat']);

        $bulanRutin = [
            $today->copy()->startOfMonth()->subMonths(2),
            $today->copy()->startOfMonth()->subMonths(1),
            $today->copy()->startOfMonth(),
        ];

        foreach ($bulanRutin as $bulan) {
            Pengeluaran::create([
                'kategori_id' => $kategoriOperasional->id,
                'deskripsi' => 'Gaji satpam bulan ' . $bulan->translatedFormat('F Y'),
                'nominal' => 1500000,
                'tanggal_pengeluaran' => $bulan->copy()->addDays(2),
            ]);

            Pengeluaran::create([
                'kategori_id' => $kategoriFasilitas->id,
                'deskripsi' => 'Token listrik pos satpam bulan ' . $bulan->translatedFormat('F Y'),
                'nominal' => 350000,
                'tanggal_pengeluaran' => $bulan->copy()->addDays(5),
            ]);
        }

        Pengeluaran::create([
            'kategori_id' => $kategoriDarurat->id,
            'deskripsi' => 'Perbaikan jalan komplek (insidental)',
            'nominal' => 2500000,
            'tanggal_pengeluaran' => $today->copy()->subDays(20),
        ]);

        Pengeluaran::create([
            'kategori_id' => $kategoriDarurat->id,
            'deskripsi' => 'Perbaikan selokan (insidental)',
            'nominal' => 1750000,
            'tanggal_pengeluaran' => $today->copy()->subDays(45),
        ]);

        $statusCycle = ['belum_bayar', 'sebagian', 'lunas'];

        $bulanUmum = [
            $today->copy()->subMonths(2),
            $today->copy()->subMonths(1),
        ];

        foreach ($rumahTetap as $index => $rumah) {
            foreach ($bulanUmum as $month) {
                $status = $statusCycle[($index + $month->month) % 3];
                $this->createTagihan(
                    $rumah->id,
                    $jenisSatpam->id,
                    $month->month,
                    $month->year,
                    100000,
                    $status
                );

                $this->createTagihan(
                    $rumah->id,
                    $jenisKebersihan->id,
                    $month->month,
                    $month->year,
                    15000,
                    $status
                );
            }
        }

        foreach ($rumahKontrakDihuni as $index => $rumah) {
            foreach ($bulanUmum as $month) {
                $status = $statusCycle[($index + $month->month) % 3];
                $this->createTagihan(
                    $rumah->id,
                    $jenisSatpam->id,
                    $month->month,
                    $month->year,
                    100000,
                    $status
                );

                $this->createTagihan(
                    $rumah->id,
                    $jenisKebersihan->id,
                    $month->month,
                    $month->year,
                    15000,
                    $status
                );
            }
        }

        $specialRumah = $rumahTetap->first();
        $specialPenghuni = $penghuniTetap->first();

        $kebersihanTagihanTahunan = collect();
        for ($i = 0; $i < 12; $i++) {
            $bulan = $today->copy()->addMonths($i);
            $kebersihanTagihanTahunan->push($this->createTagihan(
                $specialRumah->id,
                $jenisKebersihan->id,
                $bulan->month,
                $bulan->year,
                15000,
                'lunas'
            ));
        }

        $bayarKebersihanTahunan = Pembayaran::create([
            'penghuni_id' => $specialPenghuni->id,
            'rumah_id' => $specialRumah->id,
            'tanggal_bayar' => $today,
            'total_bayar' => 12 * 15000,
            'metode_pembayaran' => 'transfer',
            'catatan' => 'Bayar kebersihan 12 bulan sekaligus',
        ]);

        foreach ($kebersihanTagihanTahunan as $tagihan) {
            DetailPembayaran::create([
                'pembayaran_id' => $bayarKebersihanTahunan->id,
                'tagihan_id' => $tagihan->id,
                'nominal_alokasi' => 15000,
            ]);
        }

        $satpamBulanan = [
            $today->copy()->subMonths(2),
            $today->copy()->subMonths(1),
            $today->copy(),
        ];

        foreach ($satpamBulanan as $bulan) {
            $tagihan = $this->createTagihan(
                $specialRumah->id,
                $jenisSatpam->id,
                $bulan->month,
                $bulan->year,
                100000,
                'lunas'
            );

            $pembayaran = Pembayaran::create([
                'penghuni_id' => $specialPenghuni->id,
                'rumah_id' => $specialRumah->id,
                'tanggal_bayar' => $bulan->copy()->addDays(3),
                'total_bayar' => 100000,
                'metode_pembayaran' => 'cash',
                'catatan' => 'Bayar satpam bulanan',
            ]);

            DetailPembayaran::create([
                'pembayaran_id' => $pembayaran->id,
                'tagihan_id' => $tagihan->id,
                'nominal_alokasi' => 100000,
            ]);
        }

        $aktifPenghuni = HistoriHuni::whereNull('tanggal_selesai')
            ->pluck('penghuni_id', 'rumah_id');

        $lunasSamples = Tagihan::where('status_pembayaran', 'lunas')
            ->whereNotIn('rumah_id', [$specialRumah->id])
            ->take(3)
            ->get();

        foreach ($lunasSamples as $tagihan) {
            $penghuniId = $aktifPenghuni[$tagihan->rumah_id] ?? null;
            if (!$penghuniId) {
                continue;
            }

            $pembayaran = Pembayaran::create([
                'penghuni_id' => $penghuniId,
                'rumah_id' => $tagihan->rumah_id,
                'tanggal_bayar' => $today->copy()->subDays(10),
                'total_bayar' => $tagihan->nominal_tagihan,
                'metode_pembayaran' => 'transfer',
                'catatan' => 'Pelunasan tagihan',
            ]);

            DetailPembayaran::create([
                'pembayaran_id' => $pembayaran->id,
                'tagihan_id' => $tagihan->id,
                'nominal_alokasi' => $tagihan->nominal_tagihan,
            ]);
        }

        $sebagianSamples = Tagihan::where('status_pembayaran', 'sebagian')
            ->whereNotIn('rumah_id', [$specialRumah->id])
            ->take(2)
            ->get();

        foreach ($sebagianSamples as $tagihan) {
            $penghuniId = $aktifPenghuni[$tagihan->rumah_id] ?? null;
            if (!$penghuniId) {
                continue;
            }

            $nominalSebagian = $tagihan->nominal_tagihan / 2;
            $pembayaran = Pembayaran::create([
                'penghuni_id' => $penghuniId,
                'rumah_id' => $tagihan->rumah_id,
                'tanggal_bayar' => $today->copy()->subDays(6),
                'total_bayar' => $nominalSebagian,
                'metode_pembayaran' => 'cash',
                'catatan' => 'Bayar sebagian tagihan',
            ]);

            DetailPembayaran::create([
                'pembayaran_id' => $pembayaran->id,
                'tagihan_id' => $tagihan->id,
                'nominal_alokasi' => $nominalSebagian,
            ]);
        }
    }

    private function createTagihan(
        int $rumahId,
        int $jenisIuranId,
        int $bulan,
        int $tahun,
        float $nominal,
        string $status
    ): Tagihan {
        return Tagihan::updateOrCreate(
            [
                'rumah_id' => $rumahId,
                'jenis_iuran_id' => $jenisIuranId,
                'periode_bulan' => $bulan,
                'periode_tahun' => $tahun,
            ],
            [
                'nominal_tagihan' => $nominal,
                'status_pembayaran' => $status,
            ]
        );
    }
}
