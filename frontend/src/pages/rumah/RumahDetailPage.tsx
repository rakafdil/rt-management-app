import { Link, useParams } from "react-router-dom";
import {
  Card,
  CardContent,
  CardHeader,
  CardTitle,
  CardDescription,
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
import { formatRp } from "@/lib/formatters";
import { formatDateStr, formatPeriode, toSafeNumber } from "@/lib/rumah";
import {
  ArrowLeft,
  Home,
  User,
  Wallet,
  AlertCircle,
  History,
  ReceiptText,
  UserX,
  Inbox,
} from "lucide-react";
import {
  useGetHistoriRumah,
  useGetRumahById,
  useGetTagihanRumah,
} from "@/features/rumah/hooks/useRumah";
import { Loading } from "@/components/Loading";
import { AssignRumahDialog } from "@/features/rumah/components/AssignRumahDialog";
import { UnassignRumahDialog } from "@/features/rumah/components/UnassignRumahDialog";

export default function RumahDetailPage() {
  const { id = "" } = useParams<{ id: string }>();

  const { data: rumah, isLoading: isLoadingRumah } = useGetRumahById(id);
  const { data: historiData, isLoading: isLoadingHistori } =
    useGetHistoriRumah(id);
  const { data: tagihanData, isLoading: isLoadingTagihan } =
    useGetTagihanRumah(id);

  if (isLoadingRumah || isLoadingHistori || isLoadingTagihan) {
    return <Loading message="Memuat data rumah..." />;
  }

  if (!rumah) {
    return (
      <div className="flex flex-col items-center justify-center min-h-100 p-8">
        <div className="bg-muted p-4 rounded-full mb-4">
          <Home className="w-12 h-12 text-muted-foreground" />
        </div>
        <h2 className="text-xl font-semibold mb-2">Rumah Tidak Ditemukan</h2>
        <p className="text-muted-foreground mb-6">
          Data rumah yang Anda cari tidak ada atau telah dihapus.
        </p>
        <Button asChild>
          <Link to="/rumah">Kembali ke Daftar Rumah</Link>
        </Button>
      </div>
    );
  }

  const histori = Array.isArray(historiData) ? historiData : [];
  const tagihanList = Array.isArray(tagihanData) ? tagihanData : [];

  const sortedTagihan = [...tagihanList].sort((a, b) =>
    b.periode.localeCompare(a.periode),
  );

  const totalLunas = sortedTagihan
    .filter((t) => t.status_pembayaran === "lunas")
    .reduce((sum, t) => sum + toSafeNumber(t.nominal_tagihan), 0);

  const countLunas = sortedTagihan.filter(
    (t) => t.status_pembayaran === "lunas",
  ).length;
  const countTunggakan = sortedTagihan.filter(
    (t) => t.status_pembayaran === "belum_bayar",
  ).length;

  return (
    <div className="p-6 md:p-8 max-w-6xl mx-auto space-y-8">
      <div>
        <Button
          variant="ghost"
          size="sm"
          asChild
          className="mb-4 -ml-2 text-muted-foreground hover:text-foreground"
        >
          <Link to="/rumah">
            <ArrowLeft className="h-4 w-4 mr-2" /> Kembali
          </Link>
        </Button>
        <div className="flex items-center gap-3">
          <div className="p-3 bg-primary/10 text-primary rounded-xl">
            <Home className="w-6 h-6" />
          </div>
          <div>
            <h1 className="text-2xl font-bold tracking-tight">
              Rumah {rumah.blok_nomor}
            </h1>
            <p className="text-muted-foreground">
              Detail informasi penghuni dan histori pembayaran
            </p>
          </div>
          <div className="mt-4 flex flex-wrap gap-2">
            <AssignRumahDialog
              rumahId={rumah.id}
              disabled={rumah.status_huni === "dihuni"}
            />
            <UnassignRumahDialog
              rumahId={rumah.id}
              penghuniName={rumah.penghuni_aktif?.nama_lengkap}
              disabled={rumah.status_huni !== "dihuni"}
            />
          </div>
        </div>
      </div>

      <div className="grid md:grid-cols-3 gap-4">
        <Card className="border-l-4 border-l-blue-500 shadow-sm">
          <CardHeader className="pb-2 flex flex-row items-center justify-between space-y-0">
            <CardTitle className="text-sm font-medium text-muted-foreground">
              Status Penghuni
            </CardTitle>
            <User className="w-4 h-4 text-blue-500" />
          </CardHeader>
          <CardContent>
            <div className="flex items-center justify-between mb-1">
              <span className="text-2xl font-bold truncate pr-2">
                {rumah.penghuni_aktif
                  ? rumah.penghuni_aktif.nama_lengkap
                  : "Kosong"}
              </span>
            </div>
            {rumah.status_huni === "dihuni" ? (
              <Badge className="bg-blue-100 text-blue-700 hover:bg-blue-200 border-blue-200 mt-1">
                Sedang Dihuni
              </Badge>
            ) : (
              <Badge variant="secondary" className="mt-1">
                Tidak Dihuni
              </Badge>
            )}
          </CardContent>
        </Card>

        <Card className="border-l-4 border-l-emerald-500 shadow-sm">
          <CardHeader className="pb-2 flex flex-row items-center justify-between space-y-0">
            <CardTitle className="text-sm font-medium text-muted-foreground">
              Total Pembayaran Lunas
            </CardTitle>
            <Wallet className="w-4 h-4 text-emerald-500" />
          </CardHeader>
          <CardContent>
            <div className="text-2xl font-bold text-emerald-600">
              {formatRp(totalLunas)}
            </div>
            <p className="text-xs text-muted-foreground mt-1">
              Dari {countLunas} transaksi sukses
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
              {countTunggakan} Tagihan
            </div>
            <p className="text-xs text-muted-foreground mt-1">
              Menunggu pembayaran
            </p>
          </CardContent>
        </Card>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <Card className="shadow-sm">
          <CardHeader className="border-b bg-muted/40 pb-4">
            <div className="flex items-center gap-2">
              <History className="w-5 h-5 text-primary" />
              <div>
                <CardTitle className="text-lg">Historis Penghuni</CardTitle>
                <CardDescription>
                  Jejak penghuni rumah ini dari waktu ke waktu
                </CardDescription>
              </div>
            </div>
          </CardHeader>
          <CardContent className="p-0">
            <Table>
              <TableHeader>
                <TableRow className="bg-muted/20">
                  <TableHead>Penghuni</TableHead>
                  <TableHead>Mulai</TableHead>
                  <TableHead>Selesai</TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                {histori.length === 0 ? (
                  <TableRow>
                    <TableCell colSpan={3}>
                      <div className="flex flex-col items-center justify-center py-8 text-center text-muted-foreground">
                        <UserX className="h-8 w-8 mb-2 opacity-20" />
                        <p className="text-sm">
                          Belum ada catatan historis penghuni
                        </p>
                      </div>
                    </TableCell>
                  </TableRow>
                ) : (
                  histori
                    .slice()
                    .reverse()
                    .map((h, i) => (
                      <TableRow
                        key={i}
                        className="hover:bg-muted/50 transition-colors"
                      >
                        <TableCell className="font-medium">
                          {h.penghuni?.nama_lengkap}
                        </TableCell>
                        <TableCell className="text-muted-foreground">
                          {formatDateStr(h.tanggal_mulai)}
                        </TableCell>
                        <TableCell>
                          {h.tanggal_selesai ? (
                            <span className="text-muted-foreground">
                              {formatDateStr(h.tanggal_selesai)}
                            </span>
                          ) : (
                            <Badge
                              variant="outline"
                              className="bg-green-50 text-green-700 border-green-200"
                            >
                              Aktif Sekarang
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
              <ReceiptText className="w-5 h-5 text-primary" />
              <div>
                <CardTitle className="text-lg">Histori Pembayaran</CardTitle>
                <CardDescription>
                  Rincian tagihan dan pembayaran rumah
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
                        <p className="text-sm">Belum ada riwayat pembayaran</p>
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
      </div>
    </div>
  );
}
