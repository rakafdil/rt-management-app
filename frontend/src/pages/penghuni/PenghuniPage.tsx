import { useState } from "react";
import { Link } from "react-router-dom";
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
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Plus, Pencil, Trash2, Eye } from "lucide-react";
import { toast } from "sonner";

import { type Penghuni } from "@/features/penghuni/types";
import {
  useGetPenghuni,
  useDeletePenghuni,
} from "@/features/penghuni/hooks/usePenghuni";
import { PenghuniDialog } from "@/features/penghuni/components/PenghuniDialog";
import { Loading } from "@/components/Loading";

export function PenghuniPage() {
  const { data: penghuni, isLoading, isError } = useGetPenghuni();
  const deleteMutation = useDeletePenghuni();

  const [editing, setEditing] = useState<Penghuni | null>(null);
  const [open, setOpen] = useState(false);

  if (isLoading) {
    return <Loading message="Mengambil data terbaru dari server..." />;
  }

  if (isError)
    return <div className="text-red-500">Gagal mengambil data penghuni!</div>;

  const handleDelete = (id: string) => {
    if (window.confirm("Apakah Anda yakin ingin menghapus penghuni ini?")) {
      deleteMutation.mutate(id, {
        onSuccess: () => toast.success("Penghuni dihapus"),
        onError: () => toast.error("Gagal menghapus penghuni"),
      });
    }
  };

  return (
    <div className="p-6 md:p-8 max-w-7xl mx-auto">
      <PageHeader
        title="Penghuni"
        description="Kelola data penghuni perumahan"
        action={
          <Button
            onClick={() => {
              setEditing(null);
              setOpen(true);
            }}
          >
            <Plus className="h-4 w-4 mr-2" /> Tambah Penghuni
          </Button>
        }
      />

      <Card>
        <CardContent className="p-0">
          <Table>
            <TableHeader>
              <TableRow>
                <TableHead>Penghuni</TableHead>
                <TableHead>Status</TableHead>
                <TableHead>Telepon</TableHead>
                <TableHead>Status Menikah</TableHead>
                <TableHead className="text-right">Aksi</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              {penghuni?.length === 0 && (
                <TableRow>
                  <TableCell
                    colSpan={5}
                    className="text-center text-muted-foreground py-10"
                  >
                    Belum ada data penghuni
                  </TableCell>
                </TableRow>
              )}
              {penghuni?.map((p) => (
                <TableRow key={p.id}>
                  <TableCell>
                    <div className="flex items-center gap-3">
                      <Avatar className="h-9 w-9">
                        {p.foto_ktp_url ? (
                          <AvatarImage src={p.foto_ktp_url} />
                        ) : null}
                        <AvatarFallback>
                          {p.nama_lengkap
                            .split(" ")
                            .map((x) => x[0])
                            .slice(0, 2)
                            .join("")
                            .toUpperCase()}
                        </AvatarFallback>
                      </Avatar>
                      <div>
                        <div className="font-medium">{p.nama_lengkap}</div>
                      </div>
                    </div>
                  </TableCell>
                  <TableCell>
                    <Badge
                      variant={
                        p.status_penghuni === "tetap" ? "default" : "secondary"
                      }
                    >
                      {p.status_penghuni}
                    </Badge>
                  </TableCell>
                  <TableCell className="font-mono text-sm">
                    {p.nomor_telepon || "-"}
                  </TableCell>
                  <TableCell>
                    {p.status_menikah ? "Menikah" : "Belum menikah"}
                  </TableCell>
                  <TableCell className="text-right">
                    <Button variant="ghost" size="icon" asChild>
                      <Link to={`/penghuni/${p.id}`}>
                        <Eye className="h-4 w-4" />
                      </Link>
                    </Button>
                    <Button
                      variant="ghost"
                      size="icon"
                      onClick={() => {
                        setEditing(p);
                        setOpen(true);
                      }}
                    >
                      <Pencil className="h-4 w-4" />
                    </Button>
                    <Button
                      variant="ghost"
                      size="icon"
                      onClick={() => handleDelete(p.id)}
                      disabled={
                        deleteMutation.isPending &&
                        deleteMutation.variables === p.id
                      }
                    >
                      <Trash2 className="h-4 w-4 text-red-500" />
                    </Button>
                  </TableCell>
                </TableRow>
              ))}
            </TableBody>
          </Table>
        </CardContent>
      </Card>

      <PenghuniDialog open={open} onOpenChange={setOpen} editing={editing} />
    </div>
  );
}
