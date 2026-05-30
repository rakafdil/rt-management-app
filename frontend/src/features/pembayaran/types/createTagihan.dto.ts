import { z } from "zod";

export const createTagihanSchema = z.object({
  rumah_id: z.number(),

  jenis_iuran_id: z.number(),

  periode_bulan: z.number().int().min(1).max(12),

  periode_tahun: z.number().int().min(2000),

  nominal_tagihan: z.number().positive().optional(),
});

export type CreateTagihanDTO = z.infer<typeof createTagihanSchema>;
