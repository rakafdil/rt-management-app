import { useEffect, useState } from "react";
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
import { formatRp } from "@/lib/formatters";
import { Plus, Trash2 } from "lucide-react";
import { toast } from "sonner";
import {
  useCreatePengeluaran,
  useDeletePengeluaran,
  useGetPengeluaran,
} from "@/features/pengeluaran/hooks/usePengeluaran";
import { Loading } from "@/components/Loading";
import { useForm, useWatch } from "react-hook-form";
import { KategoriPengeluaranSearch } from "@/features/pengeluaran/components/PencarianKategori";
import { zodResolver } from "@hookform/resolvers/zod";
import {
  createPengeluaranSchema,
  type CreatePengeluaranDTO,
} from "@/features/pengeluaran/types";
import { z } from "zod";

function getDefaultValues(): CreatePengeluaranDTO {
  return {
    kategori_id: null,
    nama_kategori: "",
    deskripsi: "",
    nominal: 0,
    tanggal_pengeluaran: new Date().toISOString().split("T")[0],
  };
}

export default function PengeluaranPage() {
  const { data: pengeluaran, isLoading } = useGetPengeluaran();
  const createPengeluaranMutation = useCreatePengeluaran();
  const deletePengeluaranMutation = useDeletePengeluaran();

  const [open, setOpen] = useState(false);

  const form = useForm<
    z.input<typeof createPengeluaranSchema>,
    undefined,
    CreatePengeluaranDTO
  >({
    resolver: zodResolver(createPengeluaranSchema),
    defaultValues: getDefaultValues(),
  });

  const {
    register,
    handleSubmit,
    control,
    reset,
    setValue,
    formState: { errors },
  } = form;

  const kategoriId = useWatch({ control, name: "kategori_id" });
  const namaKategori = useWatch({ control, name: "nama_kategori" });
  const nominal = useWatch({ control, name: "nominal" }) as number | undefined;
  const selectedKategoriId = kategoriId as number | null | undefined;

  useEffect(() => {
    if (!open) {
      reset(getDefaultValues());
    }
  }, [open, reset]);

  const sorted = pengeluaran
    ?.slice()
    .sort((a, b) => b.tanggal_pengeluaran.localeCompare(a.tanggal_pengeluaran));

  const onSubmit = (data: CreatePengeluaranDTO) => {
    const formData = new FormData();

    if (data.kategori_id != null) {
      formData.append("kategori_id", String(data.kategori_id));
    }

    if (data.nama_kategori?.trim()) {
      formData.append("nama_kategori", data.nama_kategori.trim());
    }

    formData.append("deskripsi", data.deskripsi.trim());
    formData.append("nominal", String(data.nominal));
    formData.append("tanggal_pengeluaran", data.tanggal_pengeluaran);

    createPengeluaranMutation.mutate(formData, {
      onSuccess: () => {
        toast.success("Pengeluaran dicatat");
        setOpen(false);
        reset(getDefaultValues());
      },
      onError: () => {
        toast.error("Gagal mencatat pengeluaran");
      },
    });
  };

  if (isLoading) {
    return <Loading />;
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
                <TableHead>Kategori</TableHead>
                <TableHead>Deskripsi</TableHead>
                <TableHead>Nominal</TableHead>
                <TableHead className="text-right">Aksi</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              {sorted?.length === 0 && (
                <TableRow>
                  <TableCell
                    colSpan={6}
                    className="text-center text-muted-foreground py-10"
                  >
                    Belum ada pengeluaran
                  </TableCell>
                </TableRow>
              )}
              {sorted?.map((p) => (
                <TableRow key={p.id}>
                  <TableCell className="font-mono text-xs">
                    {p.tanggal_pengeluaran}
                  </TableCell>
                  <TableCell className="font-medium">
                    {p.kategori?.nama_kategori}
                  </TableCell>
                  <TableCell className="text-muted-foreground">
                    {p.deskripsi}
                  </TableCell>
                  <TableCell className="font-medium">
                    {formatRp(p.nominal)}
                  </TableCell>
                  <TableCell className="text-right text-destructive">
                    <Button
                      variant="ghost"
                      size="icon"
                      onClick={() => {
                        if (
                          window.confirm(
                            "Apakah Anda yakin ingin menghapus tagihan ini?",
                          )
                        )
                          deletePengeluaranMutation.mutate(p.id, {
                            onSuccess: () => {
                              toast.success("Pengeluaran berhasil dihapus");
                            },
                            onError: () => {
                              toast.error("Pengeluaran gagal dihapus");
                            },
                          });
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

          <form onSubmit={handleSubmit(onSubmit)} className="space-y-4">
            <div>
              <Label>Kategori</Label>
              <KategoriPengeluaranSearch
                value={{
                  kategori_id: selectedKategoriId ?? null,
                  nama_kategori: namaKategori,
                }}
                onChange={(val) => {
                  setValue("kategori_id", val.kategori_id ?? null, {
                    shouldValidate: true,
                    shouldDirty: true,
                  });
                  setValue("nama_kategori", val.nama_kategori ?? "", {
                    shouldValidate: true,
                    shouldDirty: true,
                  });
                }}
              />
              {errors.nama_kategori && (
                <p className="text-xs text-red-500 mt-1">
                  {errors.nama_kategori.message}
                </p>
              )}
            </div>

            <div>
              <Label>Deskripsi</Label>
              <Input
                {...register("deskripsi")}
                className="mt-1.5"
                placeholder="Misal: Beli lampu jalan"
              />
              {errors.deskripsi && (
                <p className="text-xs text-red-500 mt-1">
                  {errors.deskripsi.message}
                </p>
              )}
            </div>
            <div>
              <Label>Tanggal</Label>
              <Input
                type="date"
                {...register("tanggal_pengeluaran")}
                className="mt-1.5"
              />
              {errors.tanggal_pengeluaran && (
                <p className="text-xs text-red-500 mt-1">
                  {errors.tanggal_pengeluaran.message}
                </p>
              )}
            </div>
            <div>
              <Label>Nominal (Rp)</Label>
              <Input
                type="text"
                value={
                  nominal
                    ? new Intl.NumberFormat("id-ID").format(Number(nominal))
                    : ""
                }
                onChange={(e) => {
                  const value = e.target.value.replace(/\D/g, "");
                  setValue("nominal", value ? Number(value) : 0);
                }}
                className="mt-1.5"
              />
              {errors.nominal && (
                <p className="text-xs text-red-500 mt-1">
                  {errors.nominal.message}
                </p>
              )}
            </div>
            <DialogFooter className="pt-4">
              <Button
                type="button"
                variant="outline"
                onClick={() => setOpen(false)}
              >
                Batal
              </Button>
              <Button
                type="submit"
                disabled={createPengeluaranMutation.isPending}
              >
                Simpan
              </Button>
            </DialogFooter>
          </form>
        </DialogContent>
      </Dialog>
    </div>
  );
}
