import { createCrudHooks } from "@/lib/useCrudHooks";
import { pengeluaranApi } from "../api";

const pengeluaranCrud = createCrudHooks(["pengeluaran"], pengeluaranApi);

export const {
  useGet: useGetPengeluaran,
  useGetById: useGetPengeluaranById,
  useCreate: useCreatePengeluaran,
  useUpdate: useUpdatePengeluaran,
  useDelete: useDeletePengeluaran,
} = pengeluaranCrud;
