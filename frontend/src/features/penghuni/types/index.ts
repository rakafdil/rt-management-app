import { z } from "zod";

export const penghuniSchema = z.object({
  id: z.string(),
  nama_lengkap: z.string(),
  status_penghuni: z.enum(["tetap", "kontrak"]),
  status_menikah: z.boolean(),
  nomor_telepon: z.string().nullable(),
  foto_ktp_url: z.string().nullable(),
  rumah_aktif: z
    .object({
      id: z.string(),
      blok_nomor: z.string(),
    })
    .nullable()
    .optional(),
});

export type Penghuni = z.infer<typeof penghuniSchema>;

export const formPenghuniSchema = z.object({
  nama_lengkap: z.string().min(1, "Nama lengkap wajib diisi").max(150),
  status_penghuni: z.enum(["tetap", "kontrak"]),
  status_menikah: z.boolean(),
  nomor_telepon: z.string().max(20).optional(),
  foto_ktp: z.any().optional(), 
});

export type FormPenghuniDTO = z.infer<typeof formPenghuniSchema>;