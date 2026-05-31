import { z } from "zod";

export const createPembayaranSchema = z.object({
  rumah_id: z.coerce.number().int().positive(),
  penghuni_id: z.coerce.number().int().positive().nullable().optional(),
  tanggal_bayar: z.string().min(1),
  total_bayar: z.coerce.number().positive(),
  metode_pembayaran: z.string().max(50).optional().nullable(),
  catatan: z.string().optional().nullable(),
  tagihan_ids: z.array(z.coerce.number().int().positive()).min(1),
});

export type CreatePembayaranDTO = z.infer<
  typeof createPembayaranSchema
>;