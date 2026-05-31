import { createCrudHooks } from "@/lib/useCrudHooks";
import { historiHuniApi, rumahApi, tagihanRumahApi } from "../api";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import type { AssignRumahDTO, UnassignRumahDTO } from "../types";

const rumahCrud = createCrudHooks(["rumah"], rumahApi);

export const {
  useGet: useGetRumah,
  useGetById: useGetRumahById,
  useCreate: useCreateRumah,
  useUpdate: useUpdateRumah,
  useDelete: useDeleteRumah,
} = rumahCrud;

export const useGetHistoriRumah = (rumahId: string) => {
  return useQuery({
    queryKey: ["rumah", rumahId, "histori"],
    queryFn: () => historiHuniApi(rumahId).get(),
  });
};

export const useGetTagihanRumah = (rumahId: string | null) => {
  return useQuery({
    queryKey: ["rumah", rumahId, "tagihan"],
    queryFn: () => tagihanRumahApi(rumahId),
    enabled: rumahId !== null,
  });
};

export const useAssignPenghuni = (rumahId: string) => {
  const queryClient = useQueryClient();

  return useMutation({
    mutationFn: (data: AssignRumahDTO) => historiHuniApi(rumahId).assign(data),

    onSuccess: async () => {
      await queryClient.invalidateQueries({
        queryKey: ["rumah", rumahId, "histori"],
      });

      await queryClient.invalidateQueries({
        queryKey: ["rumah"],
      });
    },
  });
};

export const useUnassignPenghuni = (rumahId: string) => {
  const queryClient = useQueryClient();

  return useMutation({
    mutationFn: (data: UnassignRumahDTO) => historiHuniApi(rumahId).unassign(data),

    onSuccess: async () => {
      await queryClient.invalidateQueries({
        queryKey: ["rumah", rumahId, "histori"],
      });

      await queryClient.invalidateQueries({
        queryKey: ["rumah"],
      });
    },
  });
};
