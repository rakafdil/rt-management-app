import { z } from "zod";

export const createPengeluaranSchema = z.object({
  kategori_id: z.coerce.number().positive().nullable().optional(),
  nama_kategori: z.string().optional(),
  deskripsi: z.string().trim().min(1, "Deskripsi wajib diisi"),
  nominal: z.coerce.number().min(1, "Nominal minimal 1"),
  tanggal_pengeluaran: z.string().min(1, "Tanggal pengeluaran wajib diisi"),
});

export const updatePengeluaranSchema = createPengeluaranSchema.partial();

export type CreatePengeluaranDTO = z.infer<typeof createPengeluaranSchema>;

export type UpdatePengeluaranDTO = z.infer<typeof updatePengeluaranSchema>;
