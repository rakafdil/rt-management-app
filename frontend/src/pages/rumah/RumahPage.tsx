import { useState } from "react";
import { Link } from "react-router-dom";
import { PageHeader } from "@/layouts/MainLayout";
import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
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
import {
  Dialog,
  DialogContent,
  DialogFooter,
  DialogHeader,
  DialogTitle,
} from "@/components/ui/dialog";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import { useDB, store, type Rumah } from "@/lib/store";
import { Plus, Pencil, Eye } from "lucide-react";
import { toast } from "sonner";

export default function RumahPage() {
  const { rumah, penghuni } = useDB();
  const [open, setOpen] = useState(false);
  const [editing, setEditing] = useState<Rumah | null>(null);
  const [form, setForm] = useState<{ nomor: string; alamat: string; penghuniAktifId?: string }>({
    nomor: "",
    alamat: "",
  });

  function openAdd() {
    setEditing(null);
    setForm({ nomor: "", alamat: "" });
    setOpen(true);
  }
  function openEdit(r: Rumah) {
    setEditing(r);
    setForm({ nomor: r.nomor, alamat: r.alamat, penghuniAktifId: r.penghuniAktifId });
    setOpen(true);
  }

  function submit() {
    if (!form.nomor) {
      toast.error("Nomor rumah wajib diisi");
      return;
    }
    if (editing) {
      const old = editing.penghuniAktifId;
      store.updateRumah(editing.id, { nomor: form.nomor, alamat: form.alamat });
      if (form.penghuniAktifId !== old) {
        store.setPenghuniRumah(editing.id, form.penghuniAktifId || undefined);
      }
      toast.success("Rumah diperbarui");
    } else {
      store.addRumah({
        nomor: form.nomor,
        alamat: form.alamat,
        penghuniAktifId: form.penghuniAktifId,
      });
      toast.success("Rumah ditambahkan");
    }
    setOpen(false);
  }

  const getNama = (id?: string) => penghuni.find((p) => p.id === id)?.nama;

  return (
    <div className="p-6 md:p-8 max-w-7xl mx-auto">
      <PageHeader
        title="Rumah"
        description={`Total ${rumah.length} rumah • ${rumah.filter((r) => r.penghuniAktifId).length} dihuni`}
        action={
          <Button onClick={openAdd}>
            <Plus className="h-4 w-4" /> Tambah Rumah
          </Button>
        }
      />

      <Card>
        <CardContent className="p-0">
          <Table>
            <TableHeader>
              <TableRow>
                <TableHead>Nomor</TableHead>
                <TableHead>Alamat</TableHead>
                <TableHead>Status</TableHead>
                <TableHead>Penghuni Aktif</TableHead>
                <TableHead className="text-right">Aksi</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              {rumah.map((r) => (
                <TableRow key={r.id}>
                  <TableCell className="font-medium">{r.nomor}</TableCell>
                  <TableCell className="text-muted-foreground">{r.alamat}</TableCell>
                  <TableCell>
                    {r.penghuniAktifId ? (
                      <Badge className="bg-[oklch(0.62_0.15_155)] text-white hover:bg-[oklch(0.62_0.15_155)]">
                        Dihuni
                      </Badge>
                    ) : (
                      <Badge variant="secondary">Tidak Dihuni</Badge>
                    )}
                  </TableCell>
                  <TableCell>
                    {getNama(r.penghuniAktifId) || <span className="text-muted-foreground">—</span>}
                  </TableCell>
                  <TableCell className="text-right">
                    <Button variant="ghost" size="icon" asChild>
                      <Link to={`/rumah/${r.id}`}>
                        <Eye className="h-4 w-4" />
                      </Link>
                    </Button>
                    <Button variant="ghost" size="icon" onClick={() => openEdit(r)}>
                      <Pencil className="h-4 w-4" />
                    </Button>
                  </TableCell>
                </TableRow>
              ))}
            </TableBody>
          </Table>
        </CardContent>
      </Card>

      <Dialog open={open} onOpenChange={setOpen}>
        <DialogContent>
          <DialogHeader>
            <DialogTitle>{editing ? "Edit Rumah" : "Tambah Rumah"}</DialogTitle>
          </DialogHeader>
          <div className="space-y-4">
            <div>
              <Label>Nomor Rumah</Label>
              <Input
                value={form.nomor}
                onChange={(e) => setForm({ ...form, nomor: e.target.value })}
                className="mt-1.5"
              />
            </div>
            <div>
              <Label>Alamat</Label>
              <Input
                value={form.alamat}
                onChange={(e) => setForm({ ...form, alamat: e.target.value })}
                className="mt-1.5"
              />
            </div>
            <div>
              <Label>Penghuni Aktif</Label>
              <Select
                value={form.penghuniAktifId || "_none"}
                onValueChange={(v) =>
                  setForm({ ...form, penghuniAktifId: v === "_none" ? undefined : v })
                }
              >
                <SelectTrigger className="mt-1.5">
                  <SelectValue placeholder="Pilih penghuni" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="_none">Tidak dihuni</SelectItem>
                  {penghuni.map((p) => (
                    <SelectItem key={p.id} value={p.id}>
                      {p.nama} ({p.status})
                    </SelectItem>
                  ))}
                </SelectContent>
              </Select>
            </div>
          </div>
          <DialogFooter>
            <Button variant="outline" onClick={() => setOpen(false)}>
              Batal
            </Button>
            <Button onClick={submit}>Simpan</Button>
          </DialogFooter>
        </DialogContent>
      </Dialog>
    </div>
  );
}
