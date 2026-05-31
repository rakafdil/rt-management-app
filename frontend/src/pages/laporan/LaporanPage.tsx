import { useMemo, useState } from "react";
import { PageHeader } from "@/layouts/MainLayout";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Badge } from "@/components/ui/badge";
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";
import { formatRp, monthLabel } from "@/lib/formatters";
import {
  TrendingUp,
  TrendingDown,
  Wallet,
  CalendarDays,
  Calendar,
} from "lucide-react";
import {
  useMonthlyLaporan,
  useYearlyLaporan,
} from "@/features/laporan/hooks/useLaporan";

type ViewMode = "monthly" | "yearly";

export default function LaporanPage() {
  const now = new Date();

  const [viewMode, setViewMode] = useState<ViewMode>("monthly");
  const [periode, setPeriode] = useState({
    bulan: now.getMonth() + 1,
    tahun: now.getFullYear(),
  });

  const { data: laporanBulan } = useMonthlyLaporan(
    periode.bulan,
    periode.tahun,
  );
  const { data: laporanTahun } = useYearlyLaporan(periode.tahun);

  const monthlyData = useMemo(() => {
    const masuk = laporanBulan?.detail_transaksi.pemasukan || [];
    const keluar = laporanBulan?.detail_transaksi.pengeluaran || [];
    const totalMasuk = laporanBulan?.ringkasan.total_pemasukan ?? 0;
    const totalKeluar = laporanBulan?.ringkasan.total_pengeluaran ?? 0;
    return {
      masuk,
      keluar,
      totalMasuk,
      totalKeluar,
      saldo: totalMasuk - totalKeluar,
    };
  }, [laporanBulan]);

  const yearlyData = useMemo(() => {
    const totalMasuk = laporanTahun?.total_pemasukan ?? 0;
    const totalKeluar = laporanTahun?.total_pengeluaran ?? 0;
    const saldoSisa = laporanTahun?.saldo_sisa_saat_ini ?? 0;
    const grafik = laporanTahun?.grafik || [];
    return {
      totalMasuk,
      totalKeluar,
      saldoSisa,
      grafik,
    };
  }, [laporanTahun]);

  const monthInputValue = `${periode.tahun}-${String(periode.bulan).padStart(2, "0")}`;

  const handleMonthChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const val = e.target.value;
    if (val) {
      const [yyyy, mm] = val.split("-");
      setPeriode((prev) => ({
        ...prev,
        tahun: parseInt(yyyy, 10),
        bulan: parseInt(mm, 10),
      }));
    }
  };

  const handleYearChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const val = e.target.value;
    if (val) {
      setPeriode((prev) => ({
        ...prev,
        tahun: parseInt(val, 10),
      }));
    }
  };

  return (
    <div className="p-6 md:p-8 max-w-7xl mx-auto space-y-6">
      <PageHeader
        title="Laporan Keuangan"
        description="Pantau detail pemasukan & pengeluaran keuangan"
        action={
          <div className="flex flex-col sm:flex-row items-end sm:items-center gap-4">
            <div className="flex p-1 space-x-1 bg-muted rounded-lg border">
              <button
                onClick={() => setViewMode("monthly")}
                className={`flex items-center gap-2 px-3 py-1.5 text-sm font-medium rounded-md transition-all ${
                  viewMode === "monthly"
                    ? "bg-background shadow-sm text-foreground"
                    : "text-muted-foreground hover:text-foreground"
                }`}
              >
                <CalendarDays className="w-4 h-4" />
                Bulanan
              </button>
              <button
                onClick={() => setViewMode("yearly")}
                className={`flex items-center gap-2 px-3 py-1.5 text-sm font-medium rounded-md transition-all ${
                  viewMode === "yearly"
                    ? "bg-background shadow-sm text-foreground"
                    : "text-muted-foreground hover:text-foreground"
                }`}
              >
                <Calendar className="w-4 h-4" />
                Tahunan
              </button>
            </div>

            <div className="flex items-center gap-2 bg-background p-1 rounded-lg">
              <Label className="text-sm font-medium ml-2">Periode:</Label>
              {viewMode === "monthly" ? (
                <Input
                  type="month"
                  value={monthInputValue}
                  onChange={handleMonthChange}
                  className="w-40 h-9"
                />
              ) : (
                <Input
                  type="number"
                  value={periode.tahun}
                  onChange={handleYearChange}
                  className="w-32 h-9"
                  min={2000}
                  max={2100}
                />
              )}
            </div>
          </div>
        }
      />

      {viewMode === "monthly" && (
        <div className="space-y-6 animate-in fade-in slide-in-from-bottom-4 duration-500">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
            <Card>
              <CardContent className="pt-6 flex items-start justify-between">
                <div>
                  <div className="text-xs text-muted-foreground uppercase tracking-wide font-medium">
                    Pemasukan Bulan Ini
                  </div>
                  <div className="text-2xl font-semibold mt-2 text-[oklch(0.42_0.15_155)]">
                    {formatRp(monthlyData.totalMasuk)}
                  </div>
                </div>
                <div className="h-10 w-10 rounded-full bg-[oklch(0.62_0.15_155)]/10 flex items-center justify-center">
                  <TrendingUp className="h-5 w-5 text-[oklch(0.42_0.15_155)]" />
                </div>
              </CardContent>
            </Card>
            <Card>
              <CardContent className="pt-6 flex items-start justify-between">
                <div>
                  <div className="text-xs text-muted-foreground uppercase tracking-wide font-medium">
                    Pengeluaran Bulan Ini
                  </div>
                  <div className="text-2xl font-semibold mt-2 text-[oklch(0.45_0.16_50)]">
                    {formatRp(monthlyData.totalKeluar)}
                  </div>
                </div>
                <div className="h-10 w-10 rounded-full bg-[oklch(0.70_0.16_50)]/10 flex items-center justify-center">
                  <TrendingDown className="h-5 w-5 text-[oklch(0.45_0.16_50)]" />
                </div>
              </CardContent>
            </Card>
            <Card>
              <CardContent className="pt-6 flex items-start justify-between">
                <div>
                  <div className="text-xs text-muted-foreground uppercase tracking-wide font-medium">
                    Saldo {monthLabel(String(periode.bulan))}
                  </div>
                  <div
                    className={`text-2xl font-semibold mt-2 ${
                      monthlyData.saldo >= 0
                        ? "text-foreground"
                        : "text-destructive"
                    }`}
                  >
                    {formatRp(monthlyData.saldo)}
                  </div>
                </div>
                <div className="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center">
                  <Wallet className="h-5 w-5 text-primary" />
                </div>
              </CardContent>
            </Card>
          </div>

          <div className="grid lg:grid-cols-2 gap-4">
            <Card className="flex flex-col">
              <CardHeader className="pb-3 border-b">
                <CardTitle className="text-base font-semibold">
                  Detail Pemasukan
                </CardTitle>
              </CardHeader>
              <CardContent className="p-0 flex-1">
                <Table>
                  <TableHeader className="bg-muted/50">
                    <TableRow>
                      <TableHead>Rumah</TableHead>
                      <TableHead>Penghuni</TableHead>
                      <TableHead>Jenis</TableHead>
                      <TableHead className="text-right">Nominal</TableHead>
                    </TableRow>
                  </TableHeader>
                  <TableBody>
                    {monthlyData.masuk.length === 0 && (
                      <TableRow>
                        <TableCell
                          colSpan={5}
                          className="text-center text-muted-foreground py-8"
                        >
                          Belum ada data pemasukan bulan ini
                        </TableCell>
                      </TableRow>
                    )}
                    {monthlyData.masuk.map((p) => (
                      <TableRow key={p.id}>
                        <TableCell className="font-medium">
                          {p.rumah?.blok_nomor}
                        </TableCell>
                        <TableCell>{p.penghuni?.nama_lengkap}</TableCell>
                        <TableCell>
                          <div className="flex flex-wrap gap-1">
                            {p.detail_alokasi?.length ? (
                              p.detail_alokasi.map((d) => (
                                <Badge key={d.tagihan_id} variant="secondary">
                                  {d.jenis_iuran}
                                </Badge>
                              ))
                            ) : (
                              <span className="text-muted-foreground">-</span>
                            )}
                          </div>
                        </TableCell>
                        <TableCell className="text-right font-medium text-[oklch(0.42_0.15_155)]">
                          {formatRp(p.total_bayar)}
                        </TableCell>
                      </TableRow>
                    ))}
                  </TableBody>
                </Table>
              </CardContent>
            </Card>

            <Card className="flex flex-col">
              <CardHeader className="pb-3 border-b">
                <CardTitle className="text-base font-semibold">
                  Detail Pengeluaran
                </CardTitle>
              </CardHeader>
              <CardContent className="p-0 flex-1">
                <Table>
                  <TableHeader className="bg-muted/50">
                    <TableRow>
                      <TableHead>Tanggal</TableHead>
                      <TableHead>Kategori</TableHead>
                      <TableHead>Deskripsi</TableHead>
                      <TableHead className="text-right">Nominal</TableHead>
                    </TableRow>
                  </TableHeader>
                  <TableBody>
                    {monthlyData.keluar.length === 0 && (
                      <TableRow>
                        <TableCell
                          colSpan={4}
                          className="text-center text-muted-foreground py-8"
                        >
                          Belum ada data pengeluaran bulan ini
                        </TableCell>
                      </TableRow>
                    )}
                    {monthlyData.keluar.map((p) => (
                      <TableRow key={p.id}>
                        <TableCell className="font-mono text-xs whitespace-nowrap">
                          {p.tanggal_pengeluaran}
                        </TableCell>
                        <TableCell className="font-medium">
                          {p.kategori?.nama_kategori}
                        </TableCell>
                        <TableCell
                          className="text-muted-foreground line-clamp-1 max-w-[200px]"
                          title={p.deskripsi}
                        >
                          {p.deskripsi}
                        </TableCell>
                        <TableCell className="text-right font-medium text-[oklch(0.45_0.16_50)]">
                          {formatRp(p.nominal)}
                        </TableCell>
                      </TableRow>
                    ))}
                  </TableBody>
                </Table>
              </CardContent>
            </Card>
          </div>
        </div>
      )}

      {viewMode === "yearly" && (
        <div className="space-y-6 animate-in fade-in slide-in-from-bottom-4 duration-500">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
            <Card>
              <CardContent className="pt-6 flex items-start justify-between">
                <div>
                  <div className="text-xs text-muted-foreground uppercase tracking-wide font-medium">
                    Total Pemasukan ({periode.tahun})
                  </div>
                  <div className="text-2xl font-semibold mt-2 text-[oklch(0.42_0.15_155)]">
                    {formatRp(yearlyData.totalMasuk)}
                  </div>
                </div>
                <div className="h-10 w-10 rounded-full bg-[oklch(0.62_0.15_155)]/10 flex items-center justify-center">
                  <TrendingUp className="h-5 w-5 text-[oklch(0.42_0.15_155)]" />
                </div>
              </CardContent>
            </Card>
            <Card>
              <CardContent className="pt-6 flex items-start justify-between">
                <div>
                  <div className="text-xs text-muted-foreground uppercase tracking-wide font-medium">
                    Total Pengeluaran ({periode.tahun})
                  </div>
                  <div className="text-2xl font-semibold mt-2 text-[oklch(0.45_0.16_50)]">
                    {formatRp(yearlyData.totalKeluar)}
                  </div>
                </div>
                <div className="h-10 w-10 rounded-full bg-[oklch(0.70_0.16_50)]/10 flex items-center justify-center">
                  <TrendingDown className="h-5 w-5 text-[oklch(0.45_0.16_50)]" />
                </div>
              </CardContent>
            </Card>
            <Card>
              <CardContent className="pt-6 flex items-start justify-between">
                <div>
                  <div className="text-xs text-muted-foreground uppercase tracking-wide font-medium">
                    Sisa Saldo Saat Ini
                  </div>
                  <div
                    className={`text-2xl font-semibold mt-2 ${
                      yearlyData.saldoSisa >= 0
                        ? "text-foreground"
                        : "text-destructive"
                    }`}
                  >
                    {formatRp(yearlyData.saldoSisa)}
                  </div>
                </div>
                <div className="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center">
                  <Wallet className="h-5 w-5 text-primary" />
                </div>
              </CardContent>
            </Card>
          </div>

          <Card>
            <CardHeader className="pb-3 border-b">
              <CardTitle className="text-base font-semibold">
                Rekap Grafik Per Bulan
              </CardTitle>
            </CardHeader>
            <CardContent className="p-0">
              <Table>
                <TableHeader className="bg-muted/50">
                  <TableRow>
                    <TableHead className="w-[200px]">Bulan</TableHead>
                    <TableHead className="text-right">Pemasukan</TableHead>
                    <TableHead className="text-right">Pengeluaran</TableHead>
                    <TableHead className="text-right">Saldo Akhir</TableHead>
                  </TableRow>
                </TableHeader>
                <TableBody>
                  {yearlyData.grafik.length === 0 && (
                    <TableRow>
                      <TableCell
                        colSpan={4}
                        className="text-center text-muted-foreground py-8"
                      >
                        Data tahun {periode.tahun} tidak tersedia.
                      </TableCell>
                    </TableRow>
                  )}
                  {yearlyData.grafik.map((item) => (
                    <TableRow key={item.bulan} className="hover:bg-muted/50">
                      <TableCell className="font-medium text-foreground">
                        {item.nama_bulan}
                      </TableCell>
                      <TableCell className="text-right text-[oklch(0.42_0.15_155)]">
                        + {formatRp(item.pemasukan)}
                      </TableCell>
                      <TableCell className="text-right text-[oklch(0.45_0.16_50)]">
                        - {formatRp(item.pengeluaran)}
                      </TableCell>
                      <TableCell className="text-right font-semibold">
                        {formatRp(item.saldo_akhir)}
                      </TableCell>
                    </TableRow>
                  ))}
                </TableBody>
              </Table>
            </CardContent>
          </Card>
        </div>
      )}
    </div>
  );
}
