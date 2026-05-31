import { useQuery } from "@tanstack/react-query";
import { api } from "@/lib/axios";
import { MonthlyLaporanResponseSchema, GetMonthlyLaporanSchema, GetYearlyLaporanSchema, YearlyLaporanResponseSchema } from "@/features/laporan/types/laporan";
import { z } from "zod";

export const useMonthlyLaporan = (bulan: number, tahun: number) => {
  return useQuery<z.infer<typeof GetMonthlyLaporanSchema>>({
    queryKey: ["laporan", "monthly", bulan, tahun],

    queryFn: async () => {
      const response = await api.get("/reports/detail", {
        params: {
          bulan,
          tahun,
        },
      });

      const parsed = MonthlyLaporanResponseSchema.parse(response.data);

      return parsed.data;
    },

    enabled: typeof bulan === "number" && typeof tahun === "number",
  });
};

export const useYearlyLaporan = (tahun: number) => {
  return useQuery<z.infer<typeof GetYearlyLaporanSchema>>({
    queryKey: ["laporan", "yearly", tahun],

    queryFn: async () => {
      const response = await api.get("/reports/summary", {
        params: {
          tahun,
        },
      });

      const parsed = YearlyLaporanResponseSchema.parse(response.data);

      return parsed.data;
    },

    enabled: typeof tahun === "number" && typeof tahun === "number",
  });
};
