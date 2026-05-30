import { createCrudApi } from "@/lib/createCrudApi";
import type { Pembayaran, Tagihan } from "../types";

export const pembayaranApi = createCrudApi<Pembayaran, FormData>("pembayaran");
export const tagihanApi = createCrudApi<Tagihan, FormData>("tagihan");
