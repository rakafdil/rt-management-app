import { z } from "zod";

export const YearlyGrafikItemSchema = z.object({
  bulan: z.number(),
  nama_bulan: z.string(),
  pemasukan: z.coerce.number(),
  pengeluaran: z.coerce.number(),
  saldo_akhir: z.coerce.number(),
});

export const GetYearlyLaporanSchema = z.object({
  tahun: z.number(),
  total_pemasukan: z.coerce.number(),
  total_pengeluaran: z.coerce.number(),
  saldo_sisa_saat_ini: z.coerce.number(),
  grafik: z.array(YearlyGrafikItemSchema),
});

export const PembayaranItemSchema = z.object({
  id: z.number(),
  tanggal_bayar: z.string(), // "YYYY-MM-DD"
  total_bayar: z.coerce.number(),
  metode_pembayaran: z.string(),
  catatan: z.string().nullable().optional(),
  waktu_transaksi: z.string(), // "DD MMM YYYY HH:mm"
  rumah: z
    .object({
      id: z.number(),
      blok_nomor: z.string(),
    })
    .nullable()
    .optional(),
  penghuni: z
    .object({
      id: z.number(),
      nama_lengkap: z.string(),
    })
    .nullable()
    .optional(),
  detail_alokasi: z
    .array(
      z.object({
        tagihan_id: z.number(),
        nominal_dialokasikan: z.coerce.number(),
        jenis_iuran: z.string().nullable().optional(),
        periode: z.string(),
      }),
    )
    .optional(),
});

export const PengeluaranItemSchema = z.object({
  id: z.number(),
  deskripsi: z.string(),
  nominal: z.coerce.number(),
  tanggal_pengeluaran: z.string(), // "YYYY-MM-DD"
  kategori: z
    .object({
      id: z.number(),
      nama_kategori: z.string(),
    })
    .nullable()
    .optional(),
});

export const GetMonthlyLaporanSchema = z.object({
  periode: z.object({
    bulan: z.number(),
    tahun: z.number(),
  }),
  ringkasan: z.object({
    total_pemasukan: z.coerce.number(),
    total_pengeluaran: z.coerce.number(),
  }),
  detail_transaksi: z.object({
    pemasukan: z.array(PembayaranItemSchema),
    pengeluaran: z.array(PengeluaranItemSchema),
  }),
});

export const YearlyLaporanResponseSchema = z.object({
  message: z.string(),
  data: GetYearlyLaporanSchema,
});

export const MonthlyLaporanResponseSchema = z.object({
  message: z.string(),
  data: GetMonthlyLaporanSchema,
});

export type YearlyLaporanResponse = z.infer<typeof YearlyLaporanResponseSchema>;
export type MonthlyLaporanResponse = z.infer<
  typeof MonthlyLaporanResponseSchema
>;
