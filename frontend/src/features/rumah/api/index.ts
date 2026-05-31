import { createCrudApi } from "@/lib/createCrudApi";
import {
  type AssignRumahDTO,
  type Histori,
  type Rumah,
  type UnassignRumahDTO,
} from "../types";
import { api } from "@/lib/axios";
import type { Tagihan } from "@/features/pembayaran/types";

export const rumahApi = createCrudApi<Rumah, FormData>("rumah");

export const historiHuniApi = (rumah_id: string) => {
  const endpoint = `rumah/${rumah_id}`;

  return {
    get: async (): Promise<Histori> => {
      const response = await api.get(`${endpoint}/histori`);
      return response.data.data;
    },

    assign: async (data: AssignRumahDTO): Promise<{ message: string }> => {
      const response = await api.post(`${endpoint}/assign`, data);
      return response.data.data;
    },

    unassign: async (data: UnassignRumahDTO): Promise<{ message: string }> => {
      const response = await api.post(`${endpoint}/unassign`, data);
      return response.data.data;
    },
  };
};

export const tagihanRumahApi = async (rumah_id: string | null): Promise<Tagihan[]> => {
  const response = await api.get(`rumah/${rumah_id}/tagihan`);
  return response.data.data;
};
