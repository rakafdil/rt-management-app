import { createCrudApi } from "@/lib/createCrudApi";
import type { Pengeluaran } from "../types";

export const pengeluaranApi = createCrudApi<Pengeluaran, FormData>("pengeluaran");