import { z } from "zod";

export const createPembayaranSchema = z.object({
  penghuni_id: z.number(),
  rumah_id: z.number(),
  total_bayar: z.number().positive(),
  metode_pembayaran: z.string(),

  detail: z.array(z.unknown()).optional(),
});

export type CreatePembayaranDTO = z.infer<
  typeof createPembayaranSchema
>;