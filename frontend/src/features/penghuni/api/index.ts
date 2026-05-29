import { api } from "@/lib/axios"; 
import { type Penghuni } from "../types";

export const getPenghuni = async (): Promise<Penghuni[]> => {
  const response = await api.get("penghuni");
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

export const deletePenghuni = async (id: number): Promise<void> => {
  await api.delete(`penghuni/${id}`);
};