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
import { useDB, formatRp, monthLabel } from "@/lib/store";
import { TrendingUp, TrendingDown, Wallet } from "lucide-react";

export default function LaporanPage() {
  const db = useDB();
  const [periode, setPeriode] = useState(new Date().toISOString().slice(0, 7));

  const data = useMemo(() => {
    const masuk = db.pembayaran.filter((p) => p.periode === periode);
    const keluar = db.pengeluaran.filter((p) => p.periode === periode);
    const totalMasuk = masuk
      .filter((p) => p.status === "lunas")
      .reduce((s, p) => s + p.nominal * p.jumlahBulan, 0);
    const totalKeluar = keluar.reduce((s, p) => s + p.nominal, 0);
    return { masuk, keluar, totalMasuk, totalKeluar, saldo: totalMasuk - totalKeluar };
  }, [db, periode]);

  const getNama = (id: string) => db.penghuni.find((p) => p.id === id)?.nama || "—";
  const getRumah = (id: string) => db.rumah.find((r) => r.id === id)?.nomor || "—";

  return (
    <div className="p-6 md:p-8 max-w-7xl mx-auto">
      <PageHeader
        title="Laporan Bulanan"
        description="Detail pemasukan & pengeluaran per bulan"
        action={
          <div className="flex items-center gap-2">
            <Label className="text-sm">Periode:</Label>
            <Input
              type="month"
              value={periode}
              onChange={(e) => setPeriode(e.target.value)}
              className="w-40"
            />
          </div>
        }
      />

      <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <Card>
          <CardContent className="pt-6 flex items-start justify-between">
            <div>
              <div className="text-xs text-muted-foreground uppercase tracking-wide">
                Pemasukan
              </div>
              <div className="text-2xl font-semibold mt-2 text-[oklch(0.42_0.15_155)]">
                {formatRp(data.totalMasuk)}
              </div>
            </div>
            <div className="h-9 w-9 rounded-md bg-[oklch(0.62_0.15_155)]/10 flex items-center justify-center">
              <TrendingUp className="h-4 w-4 text-[oklch(0.42_0.15_155)]" />
            </div>
          </CardContent>
        </Card>
        <Card>
          <CardContent className="pt-6 flex items-start justify-between">
            <div>
              <div className="text-xs text-muted-foreground uppercase tracking-wide">
                Pengeluaran
              </div>
              <div className="text-2xl font-semibold mt-2 text-[oklch(0.45_0.16_50)]">
                {formatRp(data.totalKeluar)}
              </div>
            </div>
            <div className="h-9 w-9 rounded-md bg-[oklch(0.70_0.16_50)]/10 flex items-center justify-center">
              <TrendingDown className="h-4 w-4 text-[oklch(0.45_0.16_50)]" />
            </div>
          </CardContent>
        </Card>
        <Card>
          <CardContent className="pt-6 flex items-start justify-between">
            <div>
              <div className="text-xs text-muted-foreground uppercase tracking-wide">
                Saldo {monthLabel(periode)}
              </div>
              <div
                className={`text-2xl font-semibold mt-2 ${data.saldo >= 0 ? "text-foreground" : "text-destructive"}`}
              >
                {formatRp(data.saldo)}
              </div>
            </div>
            <div className="h-9 w-9 rounded-md bg-primary/10 flex items-center justify-center">
              <Wallet className="h-4 w-4 text-primary" />
            </div>
          </CardContent>
        </Card>
      </div>

      <div className="grid lg:grid-cols-2 gap-4">
        <Card>
          <CardHeader>
            <CardTitle className="text-base">Detail Pemasukan</CardTitle>
          </CardHeader>
          <CardContent className="p-0">
            <Table>
              <TableHeader>
                <TableRow>
                  <TableHead>Rumah</TableHead>
                  <TableHead>Penghuni</TableHead>
                  <TableHead>Jenis</TableHead>
                  <TableHead>Nominal</TableHead>
                  <TableHead>Status</TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                {data.masuk.length === 0 && (
                  <TableRow>
                    <TableCell colSpan={5} className="text-center text-muted-foreground py-6">
                      Tidak ada data
                    </TableCell>
                  </TableRow>
                )}
                {data.masuk.map((p) => (
                  <TableRow key={p.id}>
                    <TableCell className="font-medium">{getRumah(p.rumahId)}</TableCell>
                    <TableCell>{getNama(p.penghuniId)}</TableCell>
                    <TableCell className="capitalize">{p.jenis}</TableCell>
                    <TableCell>{formatRp(p.nominal * p.jumlahBulan)}</TableCell>
                    <TableCell>
                      {p.status === "lunas" ? (
                        <Badge className="bg-[oklch(0.62_0.15_155)] text-white">Lunas</Badge>
                      ) : (
                        <Badge variant="destructive">Belum</Badge>
                      )}
                    </TableCell>
                  </TableRow>
                ))}
              </TableBody>
            </Table>
          </CardContent>
        </Card>

        <Card>
          <CardHeader>
            <CardTitle className="text-base">Detail Pengeluaran</CardTitle>
          </CardHeader>
          <CardContent className="p-0">
            <Table>
              <TableHeader>
                <TableRow>
                  <TableHead>Tanggal</TableHead>
                  <TableHead>Kategori</TableHead>
                  <TableHead>Deskripsi</TableHead>
                  <TableHead className="text-right">Nominal</TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                {data.keluar.length === 0 && (
                  <TableRow>
                    <TableCell colSpan={4} className="text-center text-muted-foreground py-6">
                      Tidak ada data
                    </TableCell>
                  </TableRow>
                )}
                {data.keluar.map((p) => (
                  <TableRow key={p.id}>
                    <TableCell className="font-mono text-xs">{p.tanggal}</TableCell>
                    <TableCell className="font-medium">{p.kategori}</TableCell>
                    <TableCell className="text-muted-foreground">{p.deskripsi}</TableCell>
                    <TableCell className="text-right">{formatRp(p.nominal)}</TableCell>
                  </TableRow>
                ))}
              </TableBody>
            </Table>
          </CardContent>
        </Card>
      </div>
    </div>
  );
}
