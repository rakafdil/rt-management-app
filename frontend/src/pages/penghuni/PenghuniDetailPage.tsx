import { Link, useParams } from "react-router-dom";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
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
import {
  ArrowLeft,
  AlertCircle,
  Wallet,
  ReceiptText,
  Inbox,
} from "lucide-react";
import { Loading } from "@/components/Loading";
import { formatRp } from "@/lib/formatters";
import { formatDateStr, formatPeriode, toSafeNumber } from "@/lib/rumah";
import {
  useGetPembayaranPenghuni,
  useGetPenghuniById,
  useGetTagihanPenghuni,
} from "@/features/penghuni/hooks/usePenghuni";
import { PenghuniInfoCard } from "@/features/penghuni/components/PenghuniInfoCard";

export function PenghuniDetailPage() {
  const { id = "" } = useParams<{ id: string }>();

  const { data: penghuni, isLoading: isLoadingPenghuni } =
    useGetPenghuniById(id);
  const { data: tagihanData, isLoading: isLoadingTagihan } =
    useGetTagihanPenghuni(id);
  const { data: pembayaranData, isLoading: isLoadingPembayaran } =
    useGetPembayaranPenghuni(id);

  if (isLoadingPenghuni || isLoadingTagihan || isLoadingPembayaran) {
    return <Loading message="Memuat data penghuni..." />;
  }

  if (!penghuni) {
    return (
      <div className="flex flex-col items-center justify-center min-h-100 p-8">
        <div className="bg-muted p-4 rounded-full mb-4">
          <AlertCircle className="w-12 h-12 text-muted-foreground" />
        </div>
        <h2 className="text-xl font-semibold mb-2">Penghuni Tidak Ditemukan</h2>
        <p className="text-muted-foreground mb-6">
          Data penghuni yang Anda cari tidak ada atau telah dihapus.
        </p>
        <Button asChild>
          <Link to="/penghuni">Kembali ke Daftar Penghuni</Link>
        </Button>
      </div>
    );
  }

  const tagihanList = Array.isArray(tagihanData) ? tagihanData : [];
  const pembayaranList = Array.isArray(pembayaranData) ? pembayaranData : [];

  const sortedTagihan = [...tagihanList].sort((a, b) =>
    b.periode.localeCompare(a.periode),
  );

  const totalLunas = sortedTagihan
    .filter((t) => t.status_pembayaran === "lunas")
    .reduce((sum, t) => sum + toSafeNumber(t.nominal_tagihan), 0);

  const totalTunggakan = sortedTagihan
    .filter((t) => t.status_pembayaran !== "lunas")
    .reduce((sum, t) => sum + toSafeNumber(t.nominal_tagihan), 0);

  const totalPembayaran = pembayaranList.reduce(
    (sum, p) => sum + toSafeNumber(p.total_bayar),
    0,
  );

  return (
    <div className="p-6 md:p-8 max-w-6xl mx-auto space-y-8">
      <div>
        <Button
          variant="ghost"
          size="sm"
          asChild
          className="mb-4 -ml-2 text-muted-foreground hover:text-foreground"
        >
          <Link to="/penghuni">
            <ArrowLeft className="h-4 w-4 mr-2" /> Kembali
          </Link>
        </Button>
      </div>

      <PenghuniInfoCard penghuni={penghuni} />

      <div className="grid md:grid-cols-3 gap-4">
        <Card className="border-l-4 border-l-emerald-500 shadow-sm">
          <CardHeader className="pb-2 flex flex-row items-center justify-between space-y-0">
            <CardTitle className="text-sm font-medium text-muted-foreground">
              Total Pembayaran
            </CardTitle>
            <Wallet className="w-4 h-4 text-emerald-500" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold text-emerald-600">
              {formatRp(totalPembayaran)}
            </div>
            <p className="text-xs text-muted-foreground mt-1">
              Dari {pembayaranList.length} transaksi
            </p>
          </CardContent>
        </Card>

        <Card className="border-l-4 border-l-blue-500 shadow-sm">
          <CardHeader className="pb-2 flex flex-row items-center justify-between space-y-0">
            <CardTitle className="text-sm font-medium text-muted-foreground">
              Total Tagihan Lunas
            </CardTitle>
            <ReceiptText className="w-4 h-4 text-blue-500" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold text-blue-600">
              {formatRp(totalLunas)}
            </div>
            <p className="text-xs text-muted-foreground mt-1">
              {sortedTagihan.filter((t) => t.status_pembayaran === "lunas")
                .length} tagihan selesai
            </p>
          </CardContent>
        </Card>

        <Card className="border-l-4 border-l-rose-500 shadow-sm">
          <CardHeader className="pb-2 flex flex-row items-center justify-between space-y-0">
            <CardTitle className="text-sm font-medium text-muted-foreground">
              Tunggakan Aktif
            </CardTitle>
            <AlertCircle className="w-4 h-4 text-rose-500" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold text-rose-600">
              {formatRp(totalTunggakan)}
            </div>
            <p className="text-xs text-muted-foreground mt-1">
              {sortedTagihan.filter((t) => t.status_pembayaran !== "lunas")
                .length} tagihan belum lunas
            </p>
          </CardContent>
        </Card>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <Card className="shadow-sm">
          <CardHeader className="border-b bg-muted/40 pb-4">
            <div className="flex items-center gap-2">
              <ReceiptText className="w-5 h-5 text-primary" />
              <div>
                <CardTitle className="text-lg">Tagihan Penghuni</CardTitle>
                <CardDescription>
                  Rincian tagihan yang terkait penghuni ini
                </CardDescription>
              </div>
            </div>
          </CardHeader>
          <CardContent className="p-0">
            <Table>
              <TableHeader>
                <TableRow className="bg-muted/20">
                  <TableHead>Periode</TableHead>
                  <TableHead>Jenis Iuran</TableHead>
                  <TableHead>Nominal</TableHead>
                  <TableHead className="text-right">Status</TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                {sortedTagihan.length === 0 ? (
                  <TableRow>
                    <TableCell colSpan={4}>
                      <div className="flex flex-col items-center justify-center py-10 text-center text-muted-foreground">
                        <div className="bg-muted p-3 rounded-full mb-3">
                          <Inbox className="h-6 w-6 text-muted-foreground/50" />
                        </div>
                        <p className="text-sm">Belum ada tagihan</p>
                      </div>
                    </TableCell>
                  </TableRow>
                ) : (
                  sortedTagihan.map((t) => (
                    <TableRow
                      key={t.id}
                      className="hover:bg-muted/50 transition-colors"
                    >
                      <TableCell className="font-medium">
                        {formatPeriode(
                          t.periode_bulan,
                          t.periode_tahun,
                          t.periode,
                        )}
                      </TableCell>
                      <TableCell className="capitalize text-muted-foreground">
                        {t.jenis_iuran?.nama_iuran ?? "—"}
                      </TableCell>
                      <TableCell>
                        {formatRp(toSafeNumber(t.nominal_tagihan))}
                      </TableCell>
                      <TableCell className="text-right">
                        {t.status_pembayaran === "lunas" ? (
                          <Badge className="bg-emerald-100 text-emerald-700 hover:bg-emerald-200 border-emerald-200">
                            Lunas
                          </Badge>
                        ) : t.status_pembayaran === "sebagian" ? (
                          <Badge className="bg-amber-100 text-amber-700 hover:bg-amber-200 border-amber-200">
                            Sebagian
                          </Badge>
                        ) : (
                          <Badge className="bg-rose-100 text-rose-700 hover:bg-rose-200 border-rose-200">
                            Belum Bayar
                          </Badge>
                        )}
                      </TableCell>
                    </TableRow>
                  ))
                )}
              </TableBody>
            </Table>
          </CardContent>
        </Card>

        <Card className="shadow-sm">
          <CardHeader className="border-b bg-muted/40 pb-4">
            <div className="flex items-center gap-2">
              <Wallet className="w-5 h-5 text-primary" />
              <div>
                <CardTitle className="text-lg">Pembayaran</CardTitle>
                <CardDescription>
                  Riwayat pembayaran penghuni
                </CardDescription>
              </div>
            </div>
          </CardHeader>
          <CardContent className="p-0">
            <Table>
              <TableHeader>
                <TableRow className="bg-muted/20">
                  <TableHead>Tanggal</TableHead>
                  <TableHead>Total</TableHead>
                  <TableHead>Metode</TableHead>
                  <TableHead>Alokasi</TableHead>
                  <TableHead className="text-right">Catatan</TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                {pembayaranList.length === 0 ? (
                  <TableRow>
                    <TableCell colSpan={5}>
                      <div className="flex flex-col items-center justify-center py-10 text-center text-muted-foreground">
                        <div className="bg-muted p-3 rounded-full mb-3">
                          <Inbox className="h-6 w-6 text-muted-foreground/50" />
                        </div>
                        <p className="text-sm">Belum ada pembayaran</p>
                      </div>
                    </TableCell>
                  </TableRow>
                ) : (
                  pembayaranList.map((p) => (
                    <TableRow
                      key={p.id}
                      className="hover:bg-muted/50 transition-colors"
                    >
                      <TableCell className="font-medium">
                        {formatDateStr(p.tanggal_bayar || p.waktu_transaksi)}
                      </TableCell>
                      <TableCell>{formatRp(toSafeNumber(p.total_bayar))}</TableCell>
                      <TableCell className="capitalize text-muted-foreground">
                        {p.metode_pembayaran || "-"}
                      </TableCell>
                      <TableCell>
                        {p.detail_alokasi?.length ? (
                          <div className="space-y-1 text-xs text-muted-foreground">
                            {p.detail_alokasi.map((d, i) => (
                              <div key={`${p.id}-${i}`}>
                                {d.jenis_iuran || "Iuran"} • {d.periode} • {formatRp(toSafeNumber(d.nominal_dialokasikan))}
                              </div>
                            ))}
                          </div>
                        ) : (
                          <span className="text-muted-foreground">-</span>
                        )}
                      </TableCell>
                      <TableCell className="text-right text-muted-foreground">
                        {p.catatan || "-"}
                      </TableCell>
                    </TableRow>
                  ))
                )}
              </TableBody>
            </Table>
          </CardContent>
        </Card>
      </div>
    </div>
  );
}
