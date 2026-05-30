import { z } from "zod";

export const pembayaranSchema = z.object({
  id: z.number(),

  tanggal_bayar: z.string(),
  total_bayar: z.number(),
  metode_pembayaran: z.string().nullable().optional(),
  catatan: z.string().nullable().optional(),
  waktu_transaksi: z.string(),

  rumah: z
    .object({
      id: z.number(),
      blok_nomor: z.string(),
    })
    .optional(),

  penghuni: z
    .object({
      id: z.number(),
      nama_lengkap: z.string(),
    })
    .optional(),

  detail_alokasi: z
    .array(
      z.object({
        tagihan_id: z.number(),
        nominal_dialokasikan: z.number(),
        jenis_iuran: z.string().nullable(),
        periode: z.string(),
      })
    )
    .optional(),
});

export type Pembayaran = z.infer<typeof pembayaranSchema>;