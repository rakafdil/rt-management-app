import { useMemo } from "react";

import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { useDB, formatRp, monthLabel } from "@/lib/store";
import {
  ResponsiveContainer,
  BarChart,
  Bar,
  XAxis,
  YAxis,
  Tooltip,
  CartesianGrid,
  Legend,
  LineChart,
  Line,
} from "recharts";
import {
  TrendingUp,
  TrendingDown,
  Wallet,
  Home,
  Users,
  AlertCircle,
} from "lucide-react";
import { PageHeader } from "@/layouts/MainLayout";
import { useGetPenghuni } from "@/features/penghuni/hooks/usePenghuni";
import { useGetRumah } from "@/features/rumah/hooks/useRumah";
import { useGetTagihan } from "@/features/pembayaran/hooks/useTagihan";

export function DashboardPage() {
  const db = useDB();

  const { data: penghuni } = useGetPenghuni();
  const { data: rumah } = useGetRumah();
  const { data: tagihan } = useGetTagihan();

  const months = useMemo(() => {
    const now = new Date();
    return Array.from({ length: 12 }, (_, i) => {
      const d = new Date(now.getFullYear(), now.getMonth() - (11 - i), 1);
      return `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, "0")}`;
    });
  }, []);

  const chartData = useMemo(() => {
    let runningSaldo = 0;
    return months.map((ym) => {
      const masuk = db.pembayaran
        .filter((p) => p.periode === ym && p.status === "lunas")
        .reduce((s, p) => s + p.nominal * p.jumlahBulan, 0);
      const keluar = db.pengeluaran
        .filter((p) => p.periode === ym)
        .reduce((s, p) => s + p.nominal, 0);
      runningSaldo += masuk - keluar;
      return {
        bulan: monthLabel(ym).split(" ")[0],
        Pemasukan: masuk,
        Pengeluaran: keluar,
        Saldo: runningSaldo,
      };
    });
  }, [db, months]);

  const totalMasuk = chartData.reduce((s, x) => s + x.Pemasukan, 0);
  const totalKeluar = chartData.reduce((s, x) => s + x.Pengeluaran, 0);
  const saldo = totalMasuk - totalKeluar;
  const rumahDihuni = rumah?.filter((r) => r.penghuni_aktif).length;
  const tunggakan = tagihan?.filter((t) => t.status_pembayaran === "belum_bayar" || t.status_pembayaran === "sebagian").length;

  return (
    <div className="p-6 md:p-8 max-w-7xl mx-auto">
      <PageHeader
        title="Dashboard"
        description="Ringkasan administrasi RT Perumahan Mawar — 12 bulan terakhir"
      />

      <div className="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <StatCard
          icon={TrendingUp}
          label="Total Pemasukan"
          value={formatRp(totalMasuk)}
          tone="success"
        />
        <StatCard
          icon={TrendingDown}
          label="Total Pengeluaran"
          value={formatRp(totalKeluar)}
          tone="warning"
        />
        <StatCard
          icon={Wallet}
          label="Saldo Kas"
          value={formatRp(saldo)}
          tone="primary"
        />
        <StatCard
          icon={AlertCircle}
          label="Iuran Belum Lunas"
          value={`${tunggakan} item`}
          tone="destructive"
        />
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
        <Card>
          <CardHeader>
            <CardTitle className="text-sm font-medium text-muted-foreground">
              Status Rumah
            </CardTitle>
          </CardHeader>
          <CardContent>
            <div className="flex items-baseline gap-2">
              <span className="text-3xl font-semibold">{rumahDihuni}</span>
              <span className="text-muted-foreground text-sm">
                / {rumah?.length} dihuni
              </span>
            </div>
            <div className="mt-3 h-2 bg-muted rounded-full overflow-hidden">
              <div
                className="h-full bg-accent"
                style={{
                  width: `${(rumahDihuni ?? 0 / db.rumah.length) * 100}%`,
                }}
              />
            </div>
            <div className="grid grid-cols-2 gap-2 mt-4 text-sm">
              <div className="flex items-center gap-2">
                <Home className="h-4 w-4 text-accent" />
                Dihuni: {rumahDihuni}
              </div>
              <div className="flex items-center gap-2">
                <Home className="h-4 w-4 text-muted-foreground" />
                Kosong: {(rumah?.length ?? 0) - (rumahDihuni ?? 0)}
              </div>
            </div>
          </CardContent>
        </Card>

        <Card>
          <CardHeader>
            <CardTitle className="text-sm font-medium text-muted-foreground">
              Total Penghuni
            </CardTitle>
          </CardHeader>
          <CardContent>
            <div className="flex items-baseline gap-2">
              <span className="text-3xl font-semibold">{penghuni?.length}</span>
              <span className="text-muted-foreground text-sm">terdaftar</span>
            </div>
            <div className="grid grid-cols-2 gap-2 mt-4 text-sm">
              <div className="flex items-center gap-2">
                <Users className="h-4 w-4 text-accent" />
                Tetap:{" "}
                {penghuni?.filter((p) => p.status_penghuni === "tetap").length}
              </div>
              <div className="flex items-center gap-2">
                <Users className="h-4 w-4 text-muted-foreground" />
                Kontrak:{" "}
                {
                  penghuni?.filter((p) => p.status_penghuni === "kontrak")
                    .length
                }
              </div>
            </div>
          </CardContent>
        </Card>

        <Card>
          <CardHeader>
            <CardTitle className="text-sm font-medium text-muted-foreground">
              Saldo Bulan Ini
            </CardTitle>
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-semibold">
              {formatRp(
                (chartData[chartData.length - 1]?.Pemasukan ?? 0) -
                  (chartData[chartData.length - 1]?.Pengeluaran ?? 0),
              )}
            </div>
            <div className="text-xs text-muted-foreground mt-2">
              Masuk {formatRp(chartData[chartData.length - 1]?.Pemasukan || 0)}{" "}
              • Keluar{" "}
              {formatRp(chartData[chartData.length - 1]?.Pengeluaran || 0)}
            </div>
          </CardContent>
        </Card>
      </div>

      <Card className="mb-6">
        <CardHeader>
          <CardTitle>Pemasukan vs Pengeluaran (12 bulan)</CardTitle>
        </CardHeader>
        <CardContent>
          <div className="h-72">
            <ResponsiveContainer width="100%" height="100%">
              <BarChart data={chartData}>
                <CartesianGrid
                  strokeDasharray="3 3"
                  stroke="oklch(0.90 0.015 250)"
                />
                <XAxis
                  dataKey="bulan"
                  stroke="oklch(0.50 0.04 255)"
                  fontSize={12}
                />
                <YAxis
                  stroke="oklch(0.50 0.04 255)"
                  fontSize={12}
                  tickFormatter={(v) => `${(v / 1000).toFixed(0)}k`}
                />
                <Tooltip
                  formatter={(v: unknown) => formatRp(Number(v ?? 0))}
                  contentStyle={{
                    borderRadius: 8,
                    border: "1px solid oklch(0.90 0.015 250)",
                  }}
                />
                <Legend />
                <Bar
                  dataKey="Pemasukan"
                  fill="oklch(0.55 0.12 245)"
                  radius={[4, 4, 0, 0]}
                />
                <Bar
                  dataKey="Pengeluaran"
                  fill="oklch(0.70 0.16 50)"
                  radius={[4, 4, 0, 0]}
                />
              </BarChart>
            </ResponsiveContainer>
          </div>
        </CardContent>
      </Card>

      <Card>
        <CardHeader>
          <CardTitle>Saldo Kumulatif</CardTitle>
        </CardHeader>
        <CardContent>
          <div className="h-60">
            <ResponsiveContainer width="100%" height="100%">
              <LineChart data={chartData}>
                <CartesianGrid
                  strokeDasharray="3 3"
                  stroke="oklch(0.90 0.015 250)"
                />
                <XAxis
                  dataKey="bulan"
                  stroke="oklch(0.50 0.04 255)"
                  fontSize={12}
                />
                <YAxis
                  stroke="oklch(0.50 0.04 255)"
                  fontSize={12}
                  tickFormatter={(v) => `${(v / 1000).toFixed(0)}k`}
                />
                <Tooltip
                  formatter={(v: unknown) => formatRp(Number(v ?? 0))}
                  contentStyle={{
                    borderRadius: 8,
                    border: "1px solid oklch(0.90 0.015 250)",
                  }}
                />
                <Line
                  type="monotone"
                  dataKey="Saldo"
                  stroke="oklch(0.25 0.085 265)"
                  strokeWidth={2}
                  dot={{ r: 3 }}
                />
              </LineChart>
            </ResponsiveContainer>
          </div>
        </CardContent>
      </Card>
    </div>
  );
}

function StatCard({
  icon: Icon,
  label,
  value,
  tone,
}: {
  icon: React.ElementType;
  label: string;
  value: string;
  tone: string;
}) {
  const toneClass: Record<string, string> = {
    success: "bg-[oklch(0.62_0.15_155)]/10 text-[oklch(0.42_0.15_155)]",
    warning: "bg-[oklch(0.70_0.16_50)]/10 text-[oklch(0.45_0.16_50)]",
    primary: "bg-primary/10 text-primary",
    destructive: "bg-destructive/10 text-destructive",
  };
  return (
    <Card>
      <CardContent className="pt-6">
        <div className="flex items-start justify-between">
          <div>
            <div className="text-xs text-muted-foreground font-medium uppercase tracking-wide">
              {label}
            </div>
            <div className="text-xl font-semibold mt-2">{value}</div>
          </div>
          <div
            className={`h-9 w-9 rounded-md flex items-center justify-center ${toneClass[tone]}`}
          >
            <Icon className="h-4 w-4" />
          </div>
        </div>
      </CardContent>
    </Card>
  );
}
