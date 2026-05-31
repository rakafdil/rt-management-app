import { api } from "@/lib/axios";
import { type Penghuni } from "../types";
import type { Pembayaran, Tagihan } from "@/features/pembayaran/types";

export const getPenghuni = async (): Promise<Penghuni[]> => {
  const response = await api.get("penghuni");
  return response.data.data; 
};

export const getPenghuniById = async (id: string): Promise<Penghuni> => {
  const response = await api.get(`penghuni/${id}`);
  return response.data.data;
};

export const getTagihanPenghuni = async (id: string): Promise<Tagihan[]> => {
  const response = await api.get(`penghuni/${id}/tagihan`);
  return response.data.data;
};

export const getPembayaranPenghuni = async (
  id: string,
): Promise<Pembayaran[]> => {
  const response = await api.get(`penghuni/${id}/pembayaran`);
  return response.data.data;
};

export const createPenghuni = async (data: FormData): Promise<Penghuni> => {
  const response = await api.post("penghuni", data, {
    headers: {
      "Content-Type": "multipart/form-data",
    },
  });
  return response.data.data;
};

export const deletePenghuni = async (id: string): Promise<void> => {
  await api.delete(`penghuni/${id}`);
};