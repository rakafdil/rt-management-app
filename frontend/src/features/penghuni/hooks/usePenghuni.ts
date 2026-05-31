import { useQuery, useMutation, useQueryClient } from "@tanstack/react-query";
import {
  getPenghuni,
  getPenghuniById,
  getTagihanPenghuni,
  getPembayaranPenghuni,
  createPenghuni,
  deletePenghuni,
} from "../api";
import { api } from "@/lib/axios";

export const useGetPenghuni = () => {
  return useQuery({
    queryKey: ["penghuni"],
    queryFn: getPenghuni,
  });
};

export const useGetPenghuniById = (id: string, enabled = true) => {
  return useQuery({
    queryKey: ["penghuni", id],
    queryFn: () => getPenghuniById(id),
    enabled: enabled && !!id,
  });
};

export const useGetTagihanPenghuni = (id: string) => {
  return useQuery({
    queryKey: ["penghuni", id, "tagihan"],
    queryFn: () => getTagihanPenghuni(id),
    enabled: !!id,
  });
};

export const useGetPembayaranPenghuni = (id: string) => {
  return useQuery({
    queryKey: ["penghuni", id, "pembayaran"],
    queryFn: () => getPembayaranPenghuni(id),
    enabled: !!id,
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
    mutationFn: async ({ id, data }: { id: string; data: FormData }) => {
      data.append("_method", "PUT");
      const res = await api.post(`penghuni/${id}`, data, {
        headers: { "Content-Type": "multipart/form-data" },
      });
      return res.data;
    },
    onSuccess: () => queryClient.invalidateQueries({ queryKey: ["penghuni"] }),
  });
};