import { useQuery, useMutation, useQueryClient } from "@tanstack/react-query";
import { getPenghuni, createPenghuni, deletePenghuni } from "../api";
import { api } from "@/lib/axios";

export const useGetPenghuni = () => {
  return useQuery({
    queryKey: ["penghuni"],
    queryFn: getPenghuni,
  });
};

export const useCreatePenghuni = () => {
  const queryClient = useQueryClient();

  return useMutation({
    mutationFn: createPenghuni,
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ["penghuni"] });
    },
  });
};

export const useDeletePenghuni = () => {
  const queryClient = useQueryClient();

  return useMutation({
    mutationFn: deletePenghuni,
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ["penghuni"] });
    },
  });
};

export const useUpdatePenghuni = () => {
  const queryClient = useQueryClient();
  return useMutation({
    mutationFn: async ({ id, data }: { id: number; data: FormData }) => {
      data.append("_method", "PUT");
      const res = await api.post(`penghuni/${id}`, data, {
        headers: { "Content-Type": "multipart/form-data" },
      });
      return res.data;
    },
    onSuccess: () => queryClient.invalidateQueries({ queryKey: ["penghuni"] }),
  });
};