import { createCrudHooks } from "@/lib/useCrudHooks";
import { tagihanApi } from "../api";

const tagihanCrud = createCrudHooks(["tagihan"], tagihanApi);

export const {
  useGet: useGetTagihan,
  useGetById: useGetTagihanById,
  useCreate: useCreateTagihan,
  useUpdate: useUpdateTagihan,
  useDelete: useDeleteTagihan,
} = tagihanCrud;
