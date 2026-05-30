import { z } from "zod";

export const createKeuanganPembayaranSchema = z.object({
  rumah_id: z.number(),
  penghuni_id: z.number().nullable().optional(),

  tanggal_bayar: z.string(),

  total_bayar: z.number().positive(),

  metode_pembayaran: z.string().max(50).optional(),

  catatan: z.string().optional(),

  tagihan_ids: z
    .array(z.number())
    .min(1, "Minimal 1 tagihan dipilih"),
});

export type CreateKeuanganPembayaranDTO = z.infer<
  typeof createKeuanganPembayaranSchema
>;