import { z } from "zod";

export const tagihanSchema = z.object({
  id: z.number(),

  periode: z.string(),
  periode_bulan: z.number(),
  periode_tahun: z.number(),

  nominal_tagihan: z.number(),

  status_pembayaran: z.enum(["belum_bayar", "sebagian", "lunas"]),

  created_at: z.date(),
  jenis_iuran: z
    .object({
      id: z.number(),
      nama_iuran: z.string(),
    })
    .optional(),

  rumah: z
    .object({
      id: z.number(),
      blok_nomor: z.string(),
      penghuni_aktif: z.object().optional()
    })
    .optional(),
});

export type Tagihan = z.infer<typeof tagihanSchema>;
