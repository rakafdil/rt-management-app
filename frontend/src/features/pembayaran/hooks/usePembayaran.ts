import { createCrudHooks } from "@/lib/useCrudHooks";
import { pembayaranApi } from "../api";

const pembayaranCrud = createCrudHooks(["pembayaran"], pembayaranApi);

export const {
  useGet: useGetPembayaran,
  useGetById: useGetPembayaranById,
  useCreate: useCreatePembayaran,
  useUpdate: useUpdatePembayaran,
  useDelete: useDeletePembayaran,
} = pembayaranCrud;
