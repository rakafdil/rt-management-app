import { useState } from "react";
import { Dialog, DialogContent, DialogFooter, DialogHeader, DialogTitle } from "@/components/ui/dialog";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Checkbox } from "@/components/ui/checkbox";
import { Upload } from "lucide-react";
import { toast } from "sonner";
import { type Penghuni } from "../types";
import { useCreatePenghuni, useUpdatePenghuni } from "../hooks/usePenghuni";

interface Props {
  open: boolean;
  onOpenChange: (v: boolean) => void;
  editing: Penghuni | null;
}

export function PenghuniDialog({ open, onOpenChange, editing }: Props) {
const createMutation = useCreatePenghuni();
  const updateMutation = useUpdatePenghuni();

  const [form, setForm] = useState({
    nama_lengkap: editing?.nama_lengkap || "",
    nomor_telepon: editing?.nomor_telepon || "",
    status_penghuni: editing?.status_penghuni || "tetap",
    status_menikah: editing?.status_menikah || false,
  });
  
  const [fotoFile, setFotoFile] = useState<File | null>(null);
  const [fotoPreview, setFotoPreview] = useState<string | null>(editing?.foto_ktp || null);


  function handleFile(e: React.ChangeEvent<HTMLInputElement>) {
    const file = e.target.files?.[0];
    if (!file) return;
    setFotoFile(file);
    setFotoPreview(URL.createObjectURL(file)); 
  }

  function submit() {
    if (!form.nama_lengkap) {
      toast.error("Nama lengkap wajib diisi");
      return;
    }

    const formData = new FormData();
    formData.append("nama_lengkap", form.nama_lengkap);
    formData.append("status_penghuni", form.status_penghuni);
    formData.append("status_menikah", form.status_menikah ? "1" : "0");
    if (form.nomor_telepon) formData.append("nomor_telepon", form.nomor_telepon);
    if (fotoFile) formData.append("foto_ktp", fotoFile); 

    if (editing) {
      updateMutation.mutate(
        { id: editing.id, data: formData },
        {
          onSuccess: () => {
            toast.success("Penghuni berhasil diperbarui");
            onOpenChange(false);
          },
          onError: () => toast.error("Gagal memperbarui penghuni"),
        }
      );
    } else {
      createMutation.mutate(formData, {
        onSuccess: () => {
          toast.success("Penghuni baru ditambahkan");
          onOpenChange(false);
        },
        onError: () => toast.error("Gagal menambahkan penghuni"),
      });
    }
  }

  const isPending = createMutation.isPending || updateMutation.isPending;

  return (
    <Dialog open={open} onOpenChange={onOpenChange}>
      <DialogContent>
        <DialogHeader>
          <DialogTitle>{editing ? "Edit Penghuni" : "Tambah Penghuni"}</DialogTitle>
        </DialogHeader>
        <div className="space-y-4">
          <div>
            <Label>Nama Lengkap <span className="text-red-500">*</span></Label>
            <Input
              value={form.nama_lengkap}
              onChange={(e) => setForm({ ...form, nama_lengkap: e.target.value })}
              className="mt-1.5"
            />
          </div>
          <div>
            <Label>Nomor Telepon</Label>
            <Input
              value={form.nomor_telepon}
              onChange={(e) => setForm({ ...form, nomor_telepon: e.target.value })}
              className="mt-1.5"
            />
          </div>
          <div className="grid grid-cols-2 gap-3">
            <div>
              <Label>Status Penghuni <span className="text-red-500">*</span></Label>
              <Select
                value={form.status_penghuni}
                onValueChange={(v) => setForm({ ...form, status_penghuni: v as "tetap" | "kontrak" })}
              >
                <SelectTrigger className="mt-1.5"><SelectValue /></SelectTrigger>
                <SelectContent>
                  <SelectItem value="tetap">Tetap</SelectItem>
                  <SelectItem value="kontrak">Kontrak</SelectItem>
                </SelectContent>
              </Select>
            </div>
            <div className="flex items-end pb-1">
              <label className="flex items-center gap-2 cursor-pointer">
                <Checkbox
                  checked={form.status_menikah}
                  onCheckedChange={(v) => setForm({ ...form, status_menikah: !!v })}
                />
                <span className="text-sm">Sudah Menikah</span>
              </label>
            </div>
          </div>
          <div>
            <Label>Foto KTP (Max 2MB)</Label>
            <div className="mt-1.5 flex items-center gap-3">
              {fotoPreview ? (
                <img src={fotoPreview} alt="KTP" className="h-16 w-24 object-cover rounded border" />
              ) : (
                <div className="h-16 w-24 rounded border border-dashed flex items-center justify-center text-muted-foreground text-xs">No file</div>
              )}
              <label className="cursor-pointer">
                <input type="file" accept="image/*" className="hidden" onChange={handleFile} />
                <Button type="button" variant="outline" asChild>
                  <span><Upload className="h-4 w-4 mr-2" /> Pilih Foto</span>
                </Button>
              </label>
            </div>
          </div>
        </div>
        <DialogFooter>
          <Button variant="outline" onClick={() => onOpenChange(false)} disabled={isPending}>Batal</Button>
          <Button onClick={submit} disabled={isPending}>
            {isPending ? "Menyimpan..." : "Simpan"}
          </Button>
        </DialogFooter>
      </DialogContent>
    </Dialog>
  );
}