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
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import { useEffect } from "react";
import { toast } from "sonner";
import { useGetRumah } from "@/features/rumah/hooks/useRumah";
import { useCreateTagihan, useGetTagihan } from "../hooks/useTagihan";
import { useGetPenghuni } from "@/features/penghuni/hooks/usePenghuni";
import { Controller, useForm, useWatch } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { createTagihanSchema, type CreateTagihanDTO } from "../types";
import { Loader2 } from "lucide-react";

export function TambahTagihanDialog({
  open,
  onOpenChange,
}: {
  open: boolean;
  onOpenChange: (v: boolean) => void;
}) {
  const { data: rumah } = useGetRumah();
  const { data: tagihan } = useGetTagihan();
  const { data: penghuni } = useGetPenghuni();

  const createTagihanMutation = useCreateTagihan();

  const form = useForm<CreateTagihanDTO>({
    resolver: zodResolver(createTagihanSchema),
  });

  const { register, handleSubmit, control, reset, setValue } = form;

  const uniqueJenisIuran = Array.from(
    new Map(
      tagihan?.map((t) => [t.jenis_iuran?.id, t.jenis_iuran]) ?? [],
    ).values(),
  );

  const selectedJenisIuranId = useWatch({
    control,
    name: "jenis_iuran_id",
  });

  useEffect(() => {
    const jenisIuran = uniqueJenisIuran.find(
      (u) => u?.id === Number(selectedJenisIuranId),
    );

    if (jenisIuran) {
      setValue("nominal_tagihan", jenisIuran.nominal_default);
    }
  }, [selectedJenisIuranId, uniqueJenisIuran, setValue]);

  const submit = (data: CreateTagihanDTO) => {
    if (!data.rumah_id) {
      toast.error("Pilih rumah");
      return;
    }

    let nominal_tagihan = null;
    if (data.nominal_tagihan) nominal_tagihan = data.nominal_tagihan;

    const payload = {
      rumah_id: String(data.rumah_id),
      jenis_iuran_id: data.jenis_iuran_id,
      periode_bulan: data.periode_bulan,
      periode_tahun: data.periode_tahun,
      nominal_tagihan: nominal_tagihan,
    };

    const formData = new FormData();

    Object.entries(payload).forEach(([key, value]) => {
      formData.append(key, String(value));
    });

    createTagihanMutation.mutate(formData, {
      onSuccess() {
        toast.success("Tagihan dicatat");
        onOpenChange(false);
        reset();
      },
      onError(err) {
        const msg = err?.message ?? "Gagal menambahkan tagihan";
        toast.error(msg);
      },
    });
  };

  return (
    <Dialog open={open} onOpenChange={onOpenChange}>
      <DialogContent>
        <form
          onSubmit={handleSubmit(submit, (errors) => {
            const msg = errors?.form?.message ?? "Gagal menambahkan tagihan";
            toast.error(msg);
          })}
        >
          <DialogHeader>
            <DialogTitle>Tambahkan Tagihan</DialogTitle>
          </DialogHeader>
          <div className="space-y-4 w-full my-4">
            <div>
              <Label>Rumah</Label>
              <Controller
                control={control}
                name="rumah_id"
                render={({ field }) => {
                  const selectedRumah = rumah?.find(
                    (r) => r.id === String(field.value),
                  );

                  const selectedPenghuni = penghuni?.find(
                    (p) => p.id === selectedRumah?.penghuni_aktif?.id,
                  );

                  return (
                    <Select
                      value={field.value ? String(field.value) : ""}
                      onValueChange={(value) => field.onChange(Number(value))}
                    >
                      <SelectTrigger className="mt-1.5">
                        <SelectValue placeholder="Pilih rumah">
                          {selectedRumah
                            ? `${selectedRumah.blok_nomor} — ${selectedPenghuni?.nama_lengkap ?? ""}`
                            : undefined}
                        </SelectValue>
                      </SelectTrigger>

                      <SelectContent>
                        {rumah
                          ?.filter((r) => r.penghuni_aktif)
                          .map((r) => {
                            const p = penghuni?.find(
                              (x) => x.id === r.penghuni_aktif?.id,
                            );

                            return (
                              <SelectItem key={r.id} value={String(r.id)}>
                                {r.blok_nomor} — {p?.nama_lengkap}
                              </SelectItem>
                            );
                          })}
                      </SelectContent>
                    </Select>
                  );
                }}
              />
            </div>
            <div className="grid grid-cols-2 gap-3">
              <div>
                <Label>Jenis Iuran</Label>
                <Controller
                  control={control}
                  name="jenis_iuran_id"
                  render={({ field }) => (
                    <Select
                      value={String(field.value ?? "")}
                      onValueChange={(value) => field.onChange(Number(value))}
                    >
                      <SelectTrigger className="mt-1.5">
                        <SelectValue placeholder="Pilih jenis iuran" />
                      </SelectTrigger>
                      <SelectContent>
                        {uniqueJenisIuran.map((jenis) => (
                          <SelectItem key={jenis?.id} value={String(jenis?.id)}>
                            {jenis?.nama_iuran}
                          </SelectItem>
                        ))}
                      </SelectContent>
                    </Select>
                  )}
                />
              </div>
              <div>
                <Label>Nominal Tagihan</Label>
                <Input
                  type="number"
                  className="mt-1.5"
                  {...register("nominal_tagihan", {
                    valueAsNumber: true,
                  })}
                />
              </div>
            </div>
            <div className="w-full">
              <Label>Periode Bayar</Label>
              <Input
                type="month"
                className="mt-1.5 w-full text-center [&::-webkit-datetime-edit]:text-center"
                onChange={(e) => {
                  const [year, month] = e.target.value.split("-");

                  setValue("periode_tahun", Number(year));
                  setValue("periode_bulan", Number(month));
                }}
              />
            </div>
          </div>
          <DialogFooter>
            <Button variant="outline" onClick={() => onOpenChange(false)}>
              Batal
            </Button>
            <Button type="submit" disabled={createTagihanMutation.isPending}>
              {createTagihanMutation.isPending && <Loader2 className="mr-2 h-4 w-4 animate-spin" />}
              {createTagihanMutation.isPending ? "Menyimpan..." : "Simpan"}
            </Button>
          </DialogFooter>
        </form>
      </DialogContent>
    </Dialog>
  );
}
