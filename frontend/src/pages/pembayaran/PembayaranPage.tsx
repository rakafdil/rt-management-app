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
import {
  Plus,
  Trash2,
  CheckCircle2,
  MoreHorizontal,
  Pencil,
  DollarSign,
} from "lucide-react";
import { toast } from "sonner";
import { TagihanDialog } from "@/features/pembayaran/components/TagihanDialog";
import {
  useDeleteTagihan,
  useGetTagihan,
} from "@/features/pembayaran/hooks/useTagihan";
import { Loading } from "@/components/Loading";
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { PembayaranDialog } from "@/features/pembayaran/components/PembayaranDialog";

export default function PembayaranPage() {
  const { data: tagihan, isLoading } = useGetTagihan();

  const deleteTagihanMutation = useDeleteTagihan();

  const toTime = (value: Date | string | number): string => {
    const date = value instanceof Date ? value : new Date(value);
    const day = String(date.getDate()).padStart(2, "0");
    const month = String(date.getMonth() + 1).padStart(2, "0");
    const year = date.getFullYear();
    return `${day}-${month}-${year}`;
  };

  const [openTagihan, setOpenTagihan] = useState(false);
  const [openPembayaran, setOpenPembayaran] = useState(false);

  const [id, setId] = useState<number | null>(null);
  const [rumahId, setRumahId] = useState<number | null>(null);

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

  if (isLoading) {
    return <Loading />;
  }

  return (
    <div className="p-6 md:p-8 max-w-7xl mx-auto">
      <PageHeader
        title="Pembayaran"
        description="Catat dan kelola tagihan iuran satpam & kebersihan"
        action={
          <div className="flex gap-2">
            <Button
              onClick={() => {
                setOpenPembayaran(true);
                setId(null);
                setRumahId(null);
              }}
            >
              <DollarSign className="h-4 w-4" /> Tambah Pembayaran
            </Button>
            <Button
              onClick={() => {
                setOpenTagihan(true);
                setId(null);
              }}
            >
              <Plus className="h-4 w-4" /> Tambah Tagihan
            </Button>
          </div>
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
                    <TableCell>
                      {tagihanRecord.rumah?.penghuni_aktif?.nama_lengkap}
                    </TableCell>
                    <TableCell className="capitalize">
                      {tagihanRecord.jenis_iuran?.nama_iuran}
                    </TableCell>
                    <TableCell>
                      {tagihanRecord.periode}
                      {monthDiff > 0 && ` (${monthDiff} bln lalu)`}
                    </TableCell>
                    <TableCell className="font-medium">
                      {formatRp(tagihanRecord.nominal_tagihan)}
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
                      <DropdownMenu>
                        <DropdownMenuTrigger asChild>
                          <Button variant="ghost" size="icon">
                            <MoreHorizontal className="h-4 w-4" />
                          </Button>
                        </DropdownMenuTrigger>

                        <DropdownMenuContent align="end">
                          {tagihanRecord.status_pembayaran ===
                            "belum_bayar" && (
                            <DropdownMenuItem
                              onClick={() => {
                                setOpenPembayaran(true);
                                setId(tagihanRecord?.id);
                                setRumahId(tagihanRecord.rumah?.id ?? null);
                              }}
                              className="text-success"
                            >
                              <CheckCircle2 className="mr-2 h-4 w-4" />
                              Bayar
                            </DropdownMenuItem>
                          )}

                          <DropdownMenuItem
                            className="text-foreground"
                            onClick={() => {
                              setOpenTagihan(true);
                              setId(tagihanRecord?.id);
                            }}
                          >
                            <Pencil className="mr-2 h-4 w-4" />
                            Edit Tagihan
                          </DropdownMenuItem>

                          <DropdownMenuItem
                            className="text-destructive"
                            onClick={() => {
                              if (
                                window.confirm(
                                  "Apakah Anda yakin ingin menghapus tagihan ini?",
                                )
                              )
                                deleteTagihanMutation.mutate(
                                  tagihanRecord?.id || String(tagihanRecord.id),
                                  {
                                    onSuccess: () => {
                                      toast.success("Tagihan berhasil dihapus");
                                    },
                                    onError: () => {
                                      toast.error("Tagihan gagal dihapus");
                                    },
                                  },
                                );
                            }}
                          >
                            <Trash2 className="mr-2 h-4 w-4" />
                            Hapus
                          </DropdownMenuItem>
                        </DropdownMenuContent>
                      </DropdownMenu>
                    </TableCell>
                  </TableRow>
                );
              })}
            </TableBody>
          </Table>
        </CardContent>
      </Card>

      <TagihanDialog open={openTagihan} onOpenChange={setOpenTagihan} id={id} />
      <PembayaranDialog
        open={openPembayaran}
        onOpenChange={setOpenPembayaran}
        id={id}
        rumahIdInput={rumahId}
      />
    </div>
  );
}
