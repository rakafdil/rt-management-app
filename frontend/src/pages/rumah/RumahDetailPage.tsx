import { Link, useParams } from "react-router-dom";
import { PageHeader } from "@/layouts/MainLayout";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";
import { useDB, formatRp, monthLabel } from "@/lib/store";
import { ArrowLeft } from "lucide-react";

export default function RumahDetailPage() {
  const { id = "" } = useParams<{ id: string }>();
  const { rumah, penghuni, pembayaran } = useDB();
  const r = rumah.find((x) => x.id === id);
  if (!r)
    return (
      <div className="p-8">
        Rumah tidak ditemukan.{" "}
        <Link to="/rumah" className="text-accent underline">
          Kembali
        </Link>
      </div>
    );
  const getNama = (pid: string) => penghuni.find((p) => p.id === pid)?.nama || "—";
  const bayar = pembayaran
    .filter((p) => p.rumahId === r.id)
    .sort((a, b) => b.periode.localeCompare(a.periode));

  return (
    <div className="p-6 md:p-8 max-w-6xl mx-auto">
      <Button variant="ghost" size="sm" asChild className="mb-3 -ml-2">
        <Link to="/rumah">
          <ArrowLeft className="h-4 w-4" /> Kembali
        </Link>
      </Button>
      <PageHeader title={`Rumah ${r.nomor}`} description={r.alamat} />

      <div className="grid lg:grid-cols-3 gap-4 mb-6">
        <Card>
          <CardHeader>
            <CardTitle className="text-sm text-muted-foreground">Status</CardTitle>
          </CardHeader>
          <CardContent>
            {r.penghuniAktifId ? (
              <Badge className="bg-[oklch(0.62_0.15_155)] text-white">Dihuni</Badge>
            ) : (
              <Badge variant="secondary">Tidak Dihuni</Badge>
            )}
            <div className="mt-2 text-lg font-medium">
              {r.penghuniAktifId ? getNama(r.penghuniAktifId) : "—"}
            </div>
          </CardContent>
        </Card>
        <Card>
          <CardHeader>
            <CardTitle className="text-sm text-muted-foreground">Total Pembayaran</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-semibold">
              {formatRp(
                bayar
                  .filter((b) => b.status === "lunas")
                  .reduce((s, b) => s + b.nominal * b.jumlahBulan, 0),
              )}
            </div>
            <div className="text-xs text-muted-foreground mt-1">
              {bayar.filter((b) => b.status === "lunas").length} transaksi lunas
            </div>
          </CardContent>
        </Card>
        <Card>
          <CardHeader>
            <CardTitle className="text-sm text-muted-foreground">Tunggakan</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-semibold text-destructive">
              {bayar.filter((b) => b.status === "belum").length} item
            </div>
          </CardContent>
        </Card>
      </div>

      <Card className="mb-6">
        <CardHeader>
          <CardTitle className="text-base">Historis Penghuni</CardTitle>
        </CardHeader>
        <CardContent className="p-0">
          <Table>
            <TableHeader>
              <TableRow>
                <TableHead>Penghuni</TableHead>
                <TableHead>Mulai</TableHead>
                <TableHead>Selesai</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              {r.histori.length === 0 && (
                <TableRow>
                  <TableCell colSpan={3} className="text-center text-muted-foreground py-6">
                    Belum ada historis
                  </TableCell>
                </TableRow>
              )}
              {r.histori
                .slice()
                .reverse()
                .map((h, i) => (
                  <TableRow key={i}>
                    <TableCell>{getNama(h.penghuniId)}</TableCell>
                    <TableCell>{monthLabel(h.mulai)}</TableCell>
                    <TableCell>
                      {h.selesai ? monthLabel(h.selesai) : <Badge variant="outline">Aktif</Badge>}
                    </TableCell>
                  </TableRow>
                ))}
            </TableBody>
          </Table>
        </CardContent>
      </Card>

      <Card>
        <CardHeader>
          <CardTitle className="text-base">Histori Pembayaran</CardTitle>
        </CardHeader>
        <CardContent className="p-0">
          <Table>
            <TableHeader>
              <TableRow>
                <TableHead>Periode</TableHead>
                <TableHead>Penghuni</TableHead>
                <TableHead>Jenis</TableHead>
                <TableHead>Nominal</TableHead>
                <TableHead>Status</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              {bayar.length === 0 && (
                <TableRow>
                  <TableCell colSpan={5} className="text-center text-muted-foreground py-6">
                    Belum ada pembayaran
                  </TableCell>
                </TableRow>
              )}
              {bayar.map((p) => (
                <TableRow key={p.id}>
                  <TableCell>
                    {monthLabel(p.periode)}
                    {p.jumlahBulan > 1 ? ` (${p.jumlahBulan} bln)` : ""}
                  </TableCell>
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
    </div>
  );
}
