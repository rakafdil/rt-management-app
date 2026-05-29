import { useState } from "react";
import { PageHeader } from "@/layouts/MainLayout";
import { Button } from "@/components/ui/button";
import { Card, CardContent } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
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
import { useDB, store, formatRp, monthLabel } from "@/lib/store";
import { Plus, Trash2 } from "lucide-react";
import { toast } from "sonner";

export default function PengeluaranPage() {
  const { pengeluaran } = useDB();
  const [open, setOpen] = useState(false);
  const today = new Date().toISOString().slice(0, 10);
  const [form, setForm] = useState({
    kategori: "",
    deskripsi: "",
    nominal: 0,
    tanggal: today,
    periode: today.slice(0, 7),
  });

  const sorted = pengeluaran.slice().sort((a, b) => b.tanggal.localeCompare(a.tanggal));

  function submit() {
    if (!form.kategori || form.nominal <= 0) {
      toast.error("Kategori & nominal wajib");
      return;
    }
    store.addPengeluaran(form);
    toast.success("Pengeluaran dicatat");
    setOpen(false);
    setForm({
      kategori: "",
      deskripsi: "",
      nominal: 0,
      tanggal: today,
      periode: today.slice(0, 7),
    });
  }

  return (
    <div className="p-6 md:p-8 max-w-7xl mx-auto">
      <PageHeader
        title="Pengeluaran"
        description="Catat pengeluaran RT (gaji satpam, listrik, perbaikan, dll)"
        action={
          <Button onClick={() => setOpen(true)}>
            <Plus className="h-4 w-4" /> Tambah Pengeluaran
          </Button>
        }
      />

      <Card>
        <CardContent className="p-0">
          <Table>
            <TableHeader>
              <TableRow>
                <TableHead>Tanggal</TableHead>
                <TableHead>Periode</TableHead>
                <TableHead>Kategori</TableHead>
                <TableHead>Deskripsi</TableHead>
                <TableHead>Nominal</TableHead>
                <TableHead className="text-right">Aksi</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              {sorted.length === 0 && (
                <TableRow>
                  <TableCell colSpan={6} className="text-center text-muted-foreground py-10">
                    Belum ada pengeluaran
                  </TableCell>
                </TableRow>
              )}
              {sorted.map((p) => (
                <TableRow key={p.id}>
                  <TableCell className="font-mono text-xs">{p.tanggal}</TableCell>
                  <TableCell>{monthLabel(p.periode)}</TableCell>
                  <TableCell className="font-medium">{p.kategori}</TableCell>
                  <TableCell className="text-muted-foreground">{p.deskripsi}</TableCell>
                  <TableCell className="font-medium">{formatRp(p.nominal)}</TableCell>
                  <TableCell className="text-right">
                    <Button
                      variant="ghost"
                      size="icon"
                      onClick={() => {
                        store.deletePengeluaran(p.id);
                        toast.success("Dihapus");
                      }}
                    >
                      <Trash2 className="h-4 w-4" />
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
            <DialogTitle>Tambah Pengeluaran</DialogTitle>
          </DialogHeader>
          <div className="space-y-4">
            <div>
              <Label>Kategori</Label>
              <Input
                value={form.kategori}
                onChange={(e) => setForm({ ...form, kategori: e.target.value })}
                placeholder="Mis. Perbaikan jalan"
                className="mt-1.5"
              />
            </div>
            <div>
              <Label>Deskripsi</Label>
              <Input
                value={form.deskripsi}
                onChange={(e) => setForm({ ...form, deskripsi: e.target.value })}
                className="mt-1.5"
              />
            </div>
            <div className="grid grid-cols-2 gap-3">
              <div>
                <Label>Periode</Label>
                <Input
                  type="month"
                  value={form.periode}
                  onChange={(e) => setForm({ ...form, periode: e.target.value })}
                  className="mt-1.5"
                />
              </div>
              <div>
                <Label>Tanggal</Label>
                <Input
                  type="date"
                  value={form.tanggal}
                  onChange={(e) => setForm({ ...form, tanggal: e.target.value })}
                  className="mt-1.5"
                />
              </div>
            </div>
            <div>
              <Label>Nominal (Rp)</Label>
              <Input
                type="number"
                value={form.nominal || ""}
                onChange={(e) =>
                  setForm({ ...form, nominal: parseInt(e.target.value) || 0 })
                }
                className="mt-1.5"
              />
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

