import { Button } from "@/components/ui/button";
import {
  Dialog,
  DialogContent,
  DialogFooter,
  DialogHeader,
  DialogTitle,
} from "@/components/ui/dialog";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { formatRp } from "@/lib/formatters";
import { store, useDB } from "@/lib/store";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import { useState } from "react";
import { toast } from "sonner";

const TARIF = { satpam: 100000, kebersihan: 15000 };

export function TambahTagihanDialog({
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
                  <SelectItem value="satpam">
                    Satpam ({formatRp(TARIF.satpam)}/bln)
                  </SelectItem>
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
                onValueChange={(v) =>
                  setForm({ ...form, jumlahBulan: parseInt(v) })
                }
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
