import { useMemo, useState } from "react";
import { PageHeader } from "@/layouts/MainLayout";
import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";

import { formatRp } from "@/lib/formatters";
import { Plus, Trash2, CheckCircle2 } from "lucide-react";
import { toast } from "sonner";
import { TambahTagihanDialog } from "@/features/pembayaran/components/TambahTagihanDialog";
import { useGetTagihan } from "@/features/pembayaran/hooks/useTagihan";
import { Loading } from "@/components/Loading";

export default function PembayaranPage() {
  const { data: tagihan, isLoading } = useGetTagihan();

  const toTime = (value: Date | string | number): string => {
    const date = value instanceof Date ? value : new Date(value);
    const day = String(date.getDate()).padStart(2, "0");
    const month = String(date.getMonth() + 1).padStart(2, "0");
    const year = date.getFullYear();
    return `${day}-${month}-${year}`;
  };

  const [open, setOpen] = useState(false);
  const [filter, setFilter] = useState<string>("all");

  const filtered = useMemo(() => {
    const arr = tagihan
      ?.slice()
      .sort(
        (a, b) =>
          b.periode.localeCompare(a.periode) ||
          new Date(b.created_at).getTime() - new Date(a.created_at).getTime(),
      );
    if (filter === "lunas")
      return arr?.filter((p) => p.status_pembayaran === "lunas");
    if (filter === "belum")
      return arr?.filter((p) => p.status_pembayaran === "belum_bayar");
    return arr;
  }, [tagihan, filter]);

  if (isLoading){
    return <Loading/>
  }
  
  return (
    <div className="p-6 md:p-8 max-w-7xl mx-auto">
      <PageHeader
        title="Pembayaran"
        description="Catat dan kelola tagihan iuran satpam & kebersihan"
        action={
          <Button onClick={() => setOpen(true)}>
            <Plus className="h-4 w-4" /> Tambah Tagihan
          </Button>
        }
      />

      <div className="flex gap-2 mb-4">
        <Button
          size="sm"
          variant={filter === "all" ? "default" : "outline"}
          onClick={() => setFilter("all")}
        >
          Semua
        </Button>
        <Button
          size="sm"
          variant={filter === "lunas" ? "default" : "outline"}
          onClick={() => setFilter("lunas")}
        >
          Lunas
        </Button>
        <Button
          size="sm"
          variant={filter === "belum" ? "default" : "outline"}
          onClick={() => setFilter("belum")}
        >
          Belum Lunas
        </Button>
      </div>

      <Card>
        <CardContent className="p-0">
          <Table>
            <TableHeader>
              <TableRow>
                <TableHead>Tanggal</TableHead>
                <TableHead>Rumah</TableHead>
                <TableHead>Penghuni</TableHead>
                <TableHead>Jenis</TableHead>
                <TableHead>Periode</TableHead>
                <TableHead>Nominal</TableHead>
                <TableHead>Status</TableHead>
                <TableHead className="text-right">Aksi</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              {filtered?.length === 0 && (
                <TableRow>
                  <TableCell
                    colSpan={8}
                    className="text-center text-muted-foreground py-10"
                  >
                    Tidak ada data
                  </TableCell>
                </TableRow>
              )}
              {filtered?.map((tagihanRecord) => {
                const now = new Date();

                const monthDiff =
                  (now.getFullYear() - tagihanRecord.periode_tahun) * 12 +
                  (now.getMonth() + 1 - tagihanRecord.periode_bulan);
                return (
                  <TableRow key={tagihanRecord.id}>
                    <TableCell className="font-mono text-xs">
                      {toTime(tagihanRecord.created_at)}
                    </TableCell>
                    <TableCell className="font-medium">
                      {tagihanRecord.rumah?.blok_nomor}
                    </TableCell>
                    <TableCell>{tagihanRecord.rumah?.penghuni_aktif?.nama_lengkap}</TableCell>
                    <TableCell className="capitalize">
                      {tagihanRecord.jenis_iuran?.nama_iuran}
                    </TableCell>
                    <TableCell>
                      {tagihanRecord.periode}
                      {monthDiff > 0 && ` (${monthDiff} bln lalu)`}
                    </TableCell>
                    <TableCell className="font-medium">
                      {formatRp(
                        tagihanRecord.nominal_tagihan *
                          tagihanRecord.periode_bulan,
                      )}
                    </TableCell>
                    <TableCell>
                      {tagihanRecord.status_pembayaran === "lunas" ? (
                        <Badge className="bg-[oklch(0.62_0.15_155)] text-white">
                          Lunas
                        </Badge>
                      ) : (
                        <Badge variant="destructive">Belum</Badge>
                      )}
                    </TableCell>
                    <TableCell className="text-right">
                      {tagihanRecord.status_pembayaran === "belum_bayar" && (
                        <Button
                          variant="ghost"
                          size="icon"
                          onClick={() => {
                            toast.success("Ditandai lunas");
                          }}
                        >
                          <CheckCircle2 className="h-4 w-4 text-[oklch(0.62_0.15_155)]" />
                        </Button>
                      )}
                      <Button
                        variant="ghost"
                        size="icon"
                        onClick={() => {
                          toast.success("Pembayaran dihapus");
                        }}
                      >
                        <Trash2 className="h-4 w-4" />
                      </Button>
                    </TableCell>
                  </TableRow>
                );
              })}
            </TableBody>
          </Table>
        </CardContent>
      </Card>

      <TambahTagihanDialog open={open} onOpenChange={setOpen} />
    </div>
  );
}
