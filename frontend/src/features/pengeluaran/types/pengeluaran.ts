import { z } from "zod";

export const kategoriPengeluaranSchema = z.object({
  id: z.number(),
  nama_kategori: z.string(),
});

export const pengeluaranSchema = z.object({
  id: z.number(),
  deskripsi: z.string(),
  nominal: z.coerce.number(),
  tanggal_pengeluaran: z.string(),
  kategori: kategoriPengeluaranSchema.optional(),
});

export type Pengeluaran = z.infer<
  typeof pengeluaranSchema
>;