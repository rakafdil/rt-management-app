import { useQuery } from "@tanstack/react-query";
import { api } from "@/lib/axios";

export const usePencarianKategori = (keyword: string) => {
  return useQuery({
    queryKey: ["kategori-pengeluaran", keyword],

    queryFn: async () => {
      const response = await api.get("/kategori-pengeluaran/search", {
        params: {
          q: keyword,
        },
      });

      const data = response.data?.data ?? response.data;

      return Array.isArray(data) ? data : [];
    },

    // enabled: keyword.trim().length > 0,
  });
};
