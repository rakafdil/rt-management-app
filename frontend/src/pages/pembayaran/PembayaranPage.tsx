import { useMemo, useState } from "react";
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
import { useDB, store, formatRp, monthLabel } from "@/lib/store";
import { Plus, Trash2, CheckCircle2 } from "lucide-react";
import { toast } from "sonner";

const TARIF = { satpam: 100000, kebersihan: 15000 };

export default function Pembayaran() {
  const { pembayaran, rumah, penghuni } = useDB();
  const [open, setOpen] = useState(false);
  const [filter, setFilter] = useState<string>("all");

  const filtered = useMemo(() => {
    const arr = pembayaran
      .slice()
      .sort((a, b) => b.periode.localeCompare(a.periode) || b.tanggal.localeCompare(a.tanggal));
    if (filter === "lunas") return arr.filter((p) => p.status === "lunas");
    if (filter === "belum") return arr.filter((p) => p.status === "belum");
    return arr;
  }, [pembayaran, filter]);

  const getRumah = (id: string) => rumah.find((r) => r.id === id);
  const getPenghuni = (id: string) => penghuni.find((p) => p.id === id);

  return (
    <div className="p-6 md:p-8 max-w-7xl mx-auto">
      <PageHeader
        title="Pembayaran"
        description="Catat dan kelola pembayaran iuran satpam & kebersihan"
        action={
          <Button onClick={() => setOpen(true)}>
            <Plus className="h-4 w-4" /> Tambah Pembayaran
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
              {filtered.length === 0 && (
                <TableRow>
                  <TableCell colSpan={8} className="text-center text-muted-foreground py-10">
                    Tidak ada data
                  </TableCell>
                </TableRow>
              )}
              {filtered.map((p) => (
                <TableRow key={p.id}>
                  <TableCell className="font-mono text-xs">{p.tanggal}</TableCell>
                  <TableCell className="font-medium">{getRumah(p.rumahId)?.nomor}</TableCell>
                  <TableCell>{getPenghuni(p.penghuniId)?.nama}</TableCell>
                  <TableCell className="capitalize">{p.jenis}</TableCell>
                  <TableCell>
                    {monthLabel(p.periode)}
                    {p.jumlahBulan > 1 ? ` (${p.jumlahBulan} bln)` : ""}
                  </TableCell>
                  <TableCell className="font-medium">
                    {formatRp(p.nominal * p.jumlahBulan)}
                  </TableCell>
                  <TableCell>
                    {p.status === "lunas" ? (
                      <Badge className="bg-[oklch(0.62_0.15_155)] text-white">Lunas</Badge>
                    ) : (
                      <Badge variant="destructive">Belum</Badge>
                    )}
                  </TableCell>
                  <TableCell className="text-right">
                    {p.status === "belum" && (
                      <Button
                        variant="ghost"
                        size="icon"
                        onClick={() => {
                          store.updatePembayaran(p.id, { status: "lunas" });
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
                        store.deletePembayaran(p.id);
                        toast.success("Pembayaran dihapus");
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

      <PembayaranDialog open={open} onOpenChange={setOpen} />
    </div>
  );
}

function PembayaranDialog({
  open,
  onOpenChange,
}: {
  open: boolean;
  onOpenChange: (v: boolean) => void;
}) {
  const { rumah, penghuni } = useDB();
  const today = new Date().toISOString().slice(0, 10);
  const [form, setForm] = useState({
    rumahId: "",
    jenis: "satpam" as "satpam" | "kebersihan",
    periode: today.slice(0, 7),
    jumlahBulan: 1,
    tanggal: today,
    status: "lunas" as "lunas" | "belum",
  });

  const r = rumah.find((x) => x.id === form.rumahId);
  const penghuniRumah = r?.penghuniAktifId
    ? penghuni.find((p) => p.id === r.penghuniAktifId)
    : null;

  function submit() {
    if (!form.rumahId) {
      toast.error("Pilih rumah");
      return;
    }
    if (!penghuniRumah) {
      toast.error("Rumah belum ada penghuni");
      return;
    }
    store.addPembayaran({
      rumahId: form.rumahId,
      penghuniId: penghuniRumah.id,
      jenis: form.jenis,
      periode: form.periode,
      jumlahBulan: form.jumlahBulan,
      nominal: TARIF[form.jenis],
      tanggal: form.tanggal,
      status: form.status,
    });
    toast.success("Pembayaran dicatat");
    onOpenChange(false);
  }

  return (
    <Dialog open={open} onOpenChange={onOpenChange}>
      <DialogContent>
        <DialogHeader>
          <DialogTitle>Catat Pembayaran</DialogTitle>
        </DialogHeader>
        <div className="space-y-4">
          <div>
            <Label>Rumah</Label>
            <Select
              value={form.rumahId}
              onValueChange={(v) => setForm({ ...form, rumahId: v })}
            >
              <SelectTrigger className="mt-1.5">
                <SelectValue placeholder="Pilih rumah" />
              </SelectTrigger>
              <SelectContent>
                {rumah
                  .filter((r) => r.penghuniAktifId)
                  .map((r) => {
                    const p = penghuni.find((x) => x.id === r.penghuniAktifId);
                    return (
                      <SelectItem key={r.id} value={r.id}>
                        {r.nomor} — {p?.nama}
                      </SelectItem>
                    );
                  })}
              </SelectContent>
            </Select>
            {penghuniRumah && (
              <div className="text-xs text-muted-foreground mt-1">
                Penghuni: {penghuniRumah.nama} ({penghuniRumah.status})
              </div>
            )}
          </div>
          <div className="grid grid-cols-2 gap-3">
            <div>
              <Label>Jenis Iuran</Label>
              <Select
                value={form.jenis}
                onValueChange={(v: any) => setForm({ ...form, jenis: v })}
              >
                <SelectTrigger className="mt-1.5">
                  <SelectValue />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="satpam">Satpam ({formatRp(TARIF.satpam)}/bln)</SelectItem>
                  <SelectItem value="kebersihan">
                    Kebersihan ({formatRp(TARIF.kebersihan)}/bln)
                  </SelectItem>
                </SelectContent>
              </Select>
            </div>
            <div>
              <Label>Jumlah Bulan</Label>
              <Select
                value={String(form.jumlahBulan)}
                onValueChange={(v) => setForm({ ...form, jumlahBulan: parseInt(v) })}
              >
                <SelectTrigger className="mt-1.5">
                  <SelectValue />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="1">1 bulan</SelectItem>
                  <SelectItem value="3">3 bulan</SelectItem>
                  <SelectItem value="6">6 bulan</SelectItem>
                  <SelectItem value="12">12 bulan (tahunan)</SelectItem>
                </SelectContent>
              </Select>
            </div>
          </div>
          <div className="grid grid-cols-2 gap-3">
            <div>
              <Label>Periode Mulai</Label>
              <Input
                type="month"
                value={form.periode}
                onChange={(e) => setForm({ ...form, periode: e.target.value })}
                className="mt-1.5"
              />
            </div>
            <div>
              <Label>Tanggal Bayar</Label>
              <Input
                type="date"
                value={form.tanggal}
                onChange={(e) => setForm({ ...form, tanggal: e.target.value })}
                className="mt-1.5"
              />
            </div>
          </div>
          <div>
            <Label>Status</Label>
            <Select
              value={form.status}
              onValueChange={(v: any) => setForm({ ...form, status: v })}
            >
              <SelectTrigger className="mt-1.5">
                <SelectValue />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="lunas">Lunas</SelectItem>
                <SelectItem value="belum">Belum Lunas</SelectItem>
              </SelectContent>
            </Select>
          </div>
          <div className="rounded-md bg-muted p-3 text-sm flex justify-between">
            <span>Total</span>
            <span className="font-semibold">
              {formatRp(TARIF[form.jenis] * form.jumlahBulan)}
            </span>
          </div>
        </div>
        <DialogFooter>
          <Button variant="outline" onClick={() => onOpenChange(false)}>
            Batal
          </Button>
          <Button onClick={submit}>Simpan</Button>
        </DialogFooter>
      </DialogContent>
    </Dialog>
  );
}

