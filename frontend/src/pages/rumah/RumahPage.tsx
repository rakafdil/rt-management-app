import { useEffect, useState } from "react";
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

import { useForm, Controller } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";

import { Plus, Pencil, Eye } from "lucide-react";
import { toast } from "sonner";

import {
  formRumahSchema,
  type FormRumahDTO,
  type Rumah,
} from "@/features/rumah/types";
import {
  useCreateRumah,
  useGetRumah,
  useUpdateRumah,
} from "@/features/rumah/hooks/useRumah";
import { useGetPenghuni } from "@/features/penghuni/hooks/usePenghuni";
import { Loading } from "@/components/Loading";

export default function RumahPage() {
  const { data, isLoading } = useGetRumah();

  const { data: penghuni } = useGetPenghuni();

  const createMutation = useCreateRumah();
  const updateMutation = useUpdateRumah();

  const [open, setOpen] = useState(false);

  const [editing, setEditing] = useState<Rumah | null>(null);

  const form = useForm<FormRumahDTO>({
    resolver: zodResolver(formRumahSchema),
    defaultValues: {
      blok_nomor: "",
    },
  });

  const { register, handleSubmit, control, reset } = form;

  function openAdd() {
    setEditing(null);
    reset({ blok_nomor: "" });
    setOpen(true);
  }

  function openEdit(r: Rumah) {
    setEditing(r);
    setOpen(true);
  }

  useEffect(() => {
    if (editing) {
      reset({
        blok_nomor: editing.blok_nomor ?? "",
        penghuni_id: editing.penghuni_aktif?.id,
      });
    } else {
      reset({
        blok_nomor: "",
      });
    }
  }, [editing, open, reset]);
  
  if (isLoading) {
    return <Loading message="Mengambil data terbaru dari server..." />;
  }

  const submit = (data: FormRumahDTO) => {
    const formData = new FormData();
    formData.append("blok_nomor", data.blok_nomor);

    if (data.penghuni_id) {
      formData.append("penghuni_id", data.penghuni_id);
      formData.append("tanggal_mulai", new Date().toISOString().split("T")[0]);
    }

    for (const [key, value] of formData.entries()) {
      console.log(`${key}:`, value);
    }
    if (editing) {
      updateMutation.mutate(
        {
          id: editing.id,
          data: formData,
        },
        {
          onSuccess: () => {
            toast.success("Penghuni berhasil diperbarui");

            setOpen(false);
          },

          onError: (error) => {
            console.log(error);
            toast.error("Gagal memperbarui penghuni");
          },
        },
      );
    } else {
      createMutation.mutate(formData, {
        onSuccess: () => {
          toast.success("Penghuni berhasil ditambahkan");

          setOpen(false);
        },

        onError: () => {
          toast.error("Gagal menambahkan penghuni");
        },
      });
    }
  };

  return (
    <div className="p-6 md:p-8 max-w-7xl mx-auto">
      <PageHeader
        title="Rumah"
        description={`Total ${data?.length} rumah • ${data?.filter((r) => r.penghuni_aktif).length} dihuni`}
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
                <TableHead>Alamat</TableHead>
                <TableHead>Status</TableHead>
                <TableHead>Penghuni Aktif</TableHead>
                <TableHead className="text-right">Aksi</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody>
              {data?.map((r) => (
                <TableRow key={r.id}>
                  <TableCell className="font-medium">{r.blok_nomor}</TableCell>
                  <TableCell>
                    {r.penghuni_aktif ? (
                      <Badge className="bg-[oklch(0.62_0.15_155)] text-white hover:bg-[oklch(0.62_0.15_155)]">
                        Dihuni
                      </Badge>
                    ) : (
                      <Badge variant="secondary">Tidak Dihuni</Badge>
                    )}
                  </TableCell>
                  <TableCell>
                    {r.penghuni_aktif?.nama_lengkap || (
                      <span className="text-muted-foreground">—</span>
                    )}
                  </TableCell>
                  <TableCell className="text-right">
                    <Button variant="ghost" size="icon" asChild>
                      <Link to={`/rumah/${r.id}`}>
                        <Eye className="h-4 w-4" />
                      </Link>
                    </Button>
                    <Button
                      variant="ghost"
                      size="icon"
                      onClick={() => openEdit(r)}
                    >
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
          <form
            onSubmit={handleSubmit(submit, (errors) =>
              console.log("ERROR", errors),
            )}
          >
            <DialogHeader>
              <DialogTitle>
                {editing ? "Edit Rumah" : "Tambah Rumah"}
              </DialogTitle>
            </DialogHeader>
            <div className="space-y-4">
              <div>
                <Label>Nomor Rumah</Label>
                <Input {...register("blok_nomor")} className="mt-1.5" />
              </div>
              <div>
                <Label>Penghuni Aktif</Label>
                <Controller
                  control={control}
                  name="penghuni_id"
                  render={({ field }) => (
                    <Select
                      value={field.value ?? "none"}
                      onValueChange={(value) =>
                        field.onChange(value === "none" ? undefined : value)
                      }
                    >
                      <SelectTrigger>
                        <SelectValue placeholder="Pilih penghuni" />
                      </SelectTrigger>

                      <SelectContent className="max-h-100 overflow-y-scroll">
                        <SelectItem value="none">Tidak ada penghuni</SelectItem>

                        {penghuni?.filter((p) => p.rumah_aktif === null).map((p) => (
                          <SelectItem key={p.id} value={String(p.id)}>
                            {p.nama_lengkap}
                          </SelectItem>
                        ))}
                      </SelectContent>
                    </Select>
                  )}
                />
              </div>
            </div>
            <DialogFooter>
              <Button
                type="button"
                variant="outline"
                onClick={() => setOpen(false)}
              >
                Batal
              </Button>
              <Button type="submit">Simpan</Button>
            </DialogFooter>
          </form>
        </DialogContent>
      </Dialog>
    </div>
  );
}
