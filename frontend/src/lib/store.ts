import { useSyncExternalStore } from "react";

export type Penghuni = {
  id: string;
  nama: string;
  fotoKtp?: string; // data URL
  status: "tetap" | "kontrak";
  telepon: string;
  menikah: boolean;
  createdAt: string;
};

export type RumahHistori = {
  penghuniId: string;
  mulai: string; // yyyy-mm
  selesai?: string; // yyyy-mm
};

export type Rumah = {
  id: string;
  nomor: string;
  alamat: string;
  penghuniAktifId?: string;
  histori: RumahHistori[];
};

export type Pembayaran = {
  id: string;
  rumahId: string;
  penghuniId: string;
  jenis: "kebersihan" | "satpam";
  periode: string; // yyyy-mm
  jumlahBulan: number; // 1 atau 12
  nominal: number;
  tanggal: string; // yyyy-mm-dd
  status: "lunas" | "belum";
};

export type Pengeluaran = {
  id: string;
  periode: string; // yyyy-mm
  kategori: string;
  deskripsi: string;
  nominal: number;
  tanggal: string;
};

export type DB = {
  penghuni: Penghuni[];
  rumah: Rumah[];
  pembayaran: Pembayaran[];
  pengeluaran: Pengeluaran[];
};

const KEY = "rt_admin_db_v1";

function uid() {
  return Math.random().toString(36).slice(2, 10);
}

function seed(): DB {
  const today = new Date();
  const ym = (d: Date) =>
    `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, "0")}`;
  const ymd = (d: Date) => d.toISOString().slice(0, 10);

  const penghuni: Penghuni[] = [
    {
      id: "p1",
      nama: "Budi Santoso",
      status: "tetap",
      telepon: "081234567001",
      menikah: true,
      createdAt: ymd(today),
    },
    {
      id: "p2",
      nama: "Siti Aminah",
      status: "tetap",
      telepon: "081234567002",
      menikah: true,
      createdAt: ymd(today),
    },
    {
      id: "p3",
      nama: "Andi Wijaya",
      status: "tetap",
      telepon: "081234567003",
      menikah: false,
      createdAt: ymd(today),
    },
    {
      id: "p4",
      nama: "Rina Kusuma",
      status: "kontrak",
      telepon: "081234567004",
      menikah: true,
      createdAt: ymd(today),
    },
    {
      id: "p5",
      nama: "Dewi Lestari",
      status: "kontrak",
      telepon: "081234567005",
      menikah: false,
      createdAt: ymd(today),
    },
  ];

  const rumah: Rumah[] = Array.from({ length: 20 }, (_, i) => {
    const nomor = `A${String(i + 1).padStart(2, "0")}`;
    const r: Rumah = {
      id: `r${i + 1}`,
      nomor,
      alamat: `Jl. Mawar No. ${i + 1}`,
      histori: [],
    };
    if (i < 3) {
      r.penghuniAktifId = penghuni[i].id;
      r.histori.push({ penghuniId: penghuni[i].id, mulai: "2024-01" });
    } else if (i === 15) {
      r.penghuniAktifId = penghuni[3].id;
      r.histori.push({ penghuniId: penghuni[3].id, mulai: "2025-06" });
    } else if (i === 16) {
      r.penghuniAktifId = penghuni[4].id;
      r.histori.push({ penghuniId: penghuni[4].id, mulai: "2025-09" });
    }
    return r;
  });

  // Seed payments for last 6 months for occupied houses
  const pembayaran: Pembayaran[] = [];
  const pengeluaran: Pengeluaran[] = [];
  for (let m = 11; m >= 0; m--) {
    const d = new Date(today.getFullYear(), today.getMonth() - m, 1);
    const periode = ym(d);
    rumah.forEach((r) => {
      if (!r.penghuniAktifId) return;
      const status: "lunas" | "belum" =
        Math.random() > 0.15 ? "lunas" : "belum";
      pembayaran.push({
        id: uid(),
        rumahId: r.id,
        penghuniId: r.penghuniAktifId,
        jenis: "satpam",
        periode,
        jumlahBulan: 1,
        nominal: 100000,
        tanggal: ymd(d),
        status,
      });
      pembayaran.push({
        id: uid(),
        rumahId: r.id,
        penghuniId: r.penghuniAktifId,
        jenis: "kebersihan",
        periode,
        jumlahBulan: 1,
        nominal: 15000,
        tanggal: ymd(d),
        status,
      });
    });
    pengeluaran.push({
      id: uid(),
      periode,
      kategori: "Gaji Satpam",
      deskripsi: "Gaji satpam bulanan",
      nominal: 1500000,
      tanggal: ymd(d),
    });
    pengeluaran.push({
      id: uid(),
      periode,
      kategori: "Token Listrik",
      deskripsi: "Token pos satpam",
      nominal: 150000,
      tanggal: ymd(d),
    });
    if (m % 3 === 0) {
      pengeluaran.push({
        id: uid(),
        periode,
        kategori: "Perbaikan",
        deskripsi: "Perbaikan jalan/selokan",
        nominal: 500000,
        tanggal: ymd(d),
      });
    }
  }

  return { penghuni, rumah, pembayaran, pengeluaran };
}

function load(): DB {
  if (typeof window === "undefined")
    return { penghuni: [], rumah: [], pembayaran: [], pengeluaran: [] };
  try {
    const raw = localStorage.getItem(KEY);
    if (raw) return JSON.parse(raw);
  } catch {
    //
    }
  const s = seed();
  localStorage.setItem(KEY, JSON.stringify(s));
  return s;
}

let state: DB =
  typeof window !== "undefined"
    ? load()
    : { penghuni: [], rumah: [], pembayaran: [], pengeluaran: [] };
const listeners = new Set<() => void>();

function persist() {
  if (typeof window !== "undefined")
    localStorage.setItem(KEY, JSON.stringify(state));
  listeners.forEach((l) => l());
}

export const store = {
  get: () => state,
  subscribe(l: () => void) {
    listeners.add(l);
    return () => listeners.delete(l);
  },
  reset() {
    state = seed();
    persist();
  },

  // Penghuni
  addPenghuni(p: Omit<Penghuni, "id" | "createdAt">) {
    state = {
      ...state,
      penghuni: [
        ...state.penghuni,
        { ...p, id: uid(), createdAt: new Date().toISOString().slice(0, 10) },
      ],
    };
    persist();
  },
  updatePenghuni(id: string, patch: Partial<Penghuni>) {
    state = {
      ...state,
      penghuni: state.penghuni.map((x) =>
        x.id === id ? { ...x, ...patch } : x,
      ),
    };
    persist();
  },
  deletePenghuni(id: string) {
    state = { ...state, penghuni: state.penghuni.filter((x) => x.id !== id) };
    persist();
  },

  // Rumah
  addRumah(r: Omit<Rumah, "id" | "histori">) {
    state = {
      ...state,
      rumah: [
        ...state.rumah,
        {
          ...r,
          id: uid(),
          histori: r.penghuniAktifId
            ? [
                {
                  penghuniId: r.penghuniAktifId,
                  mulai: new Date().toISOString().slice(0, 7),
                },
              ]
            : [],
        },
      ],
    };
    persist();
  },
  updateRumah(id: string, patch: Partial<Rumah>) {
    state = {
      ...state,
      rumah: state.rumah.map((x) => (x.id === id ? { ...x, ...patch } : x)),
    };
    persist();
  },
  setPenghuniRumah(rumahId: string, penghuniId: string | undefined) {
    const ym = new Date().toISOString().slice(0, 7);
    state = {
      ...state,
      rumah: state.rumah.map((r) => {
        if (r.id !== rumahId) return r;
        const histori = [...r.histori];
        const last = histori[histori.length - 1];
        if (last && !last.selesai) last.selesai = ym;
        if (penghuniId) histori.push({ penghuniId, mulai: ym });
        return { ...r, penghuniAktifId: penghuniId, histori };
      }),
    };
    persist();
  },

  // Pembayaran
  addPembayaran(p: Omit<Pembayaran, "id">) {
    state = {
      ...state,
      pembayaran: [...state.pembayaran, { ...p, id: uid() }],
    };
    persist();
  },
  updatePembayaran(id: string, patch: Partial<Pembayaran>) {
    state = {
      ...state,
      pembayaran: state.pembayaran.map((x) =>
        x.id === id ? { ...x, ...patch } : x,
      ),
    };
    persist();
  },
  deletePembayaran(id: string) {
    state = {
      ...state,
      pembayaran: state.pembayaran.filter((x) => x.id !== id),
    };
    persist();
  },

  // Pengeluaran
  addPengeluaran(p: Omit<Pengeluaran, "id">) {
    state = {
      ...state,
      pengeluaran: [...state.pengeluaran, { ...p, id: uid() }],
    };
    persist();
  },
  updatePengeluaran(id: string, patch: Partial<Pengeluaran>) {
    state = {
      ...state,
      pengeluaran: state.pengeluaran.map((x) =>
        x.id === id ? { ...x, ...patch } : x,
      ),
    };
    persist();
  },
  deletePengeluaran(id: string) {
    state = {
      ...state,
      pengeluaran: state.pengeluaran.filter((x) => x.id !== id),
    };
    persist();
  },
};

export function useDB(): DB {
  return useSyncExternalStore(store.subscribe, store.get, store.get);
}

export const formatRp = (n: number) =>
  new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    maximumFractionDigits: 0,
  }).format(n);

export const monthLabel = (ym: string) => {
  const [y, m] = ym.split("-");
  const months = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "Mei",
    "Jun",
    "Jul",
    "Agt",
    "Sep",
    "Okt",
    "Nov",
    "Des",
  ];
  return `${months[parseInt(m) - 1]} ${y}`;
};
