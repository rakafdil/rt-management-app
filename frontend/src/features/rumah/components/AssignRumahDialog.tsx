import { useEffect, useState } from "react";
import { useForm, Controller } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { UserPlus } from "lucide-react";
import { toast } from "sonner";
import { z } from "zod";

import { Button } from "@/components/ui/button";
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
} from "@/components/ui/dialog";
import { Label } from "@/components/ui/label";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import { useGetPenghuni } from "@/features/penghuni/hooks/usePenghuni";
import { useAssignPenghuni } from "@/features/rumah/hooks/useRumah";
import type { AssignRumahDTO } from "../types";

const assignRumahFormSchema = z.object({
  penghuni_id: z.string().min(1, "Pilih penghuni"),
});

type AssignRumahFormDTO = z.infer<typeof assignRumahFormSchema>;

interface Props {
  rumahId: string;
  disabled?: boolean;
}

export function AssignRumahDialog({ rumahId, disabled = false }: Props) {
  const [open, setOpen] = useState(false);
  const { data: penghuniList = [], isLoading } = useGetPenghuni();
  const assignMutation = useAssignPenghuni(rumahId);

  const {
    control,
    handleSubmit,
    reset,
    formState: { errors },
  } = useForm<AssignRumahFormDTO>({
    resolver: zodResolver(assignRumahFormSchema),
    defaultValues: {
      penghuni_id: "",
    },
  });

  useEffect(() => {
    if (!open) {
      reset({ penghuni_id: "" });
    }
  }, [open, reset]);

  const handleAssign = (data: AssignRumahFormDTO) => {
    const payload: AssignRumahDTO = {
      penghuni_id: data.penghuni_id,
      tanggal_mulai: new Date(),
    };

    assignMutation.mutate(payload, {
      onSuccess: () => {
        toast.success("Penghuni berhasil diassign");
        setOpen(false);
      },
      onError: () => {
        toast.error("Gagal assign penghuni");
      },
    });
  };

  const sortedPenghuni = penghuniList.slice().sort((a, b) =>
    a.nama_lengkap.localeCompare(b.nama_lengkap),
  );

  return (
    <Dialog open={open} onOpenChange={setOpen}>
      <Button
        type="button"
        onClick={() => setOpen(true)}
        disabled={disabled}
        variant="outline"
        className="gap-2"
      >
        <UserPlus className="h-4 w-4" />
        Assign Penghuni
      </Button>

      <DialogContent>
        <DialogHeader>
          <DialogTitle>Assign Penghuni</DialogTitle>
          <DialogDescription>
            Pilih penghuni yang akan menempati rumah ini.
          </DialogDescription>
        </DialogHeader>

        <form onSubmit={handleSubmit(handleAssign)} className="space-y-4">
          <div>
            <Label>
              Penghuni <span className="text-red-500">*</span>
            </Label>

            <Controller
              control={control}
              name="penghuni_id"
              render={({ field }) => (
                <Select
                  value={field.value}
                  onValueChange={field.onChange}
                  disabled={isLoading || sortedPenghuni.length === 0}
                >
                  <SelectTrigger className="mt-1.5">
                    <SelectValue placeholder="Pilih penghuni" />
                  </SelectTrigger>
                  <SelectContent>
                    {sortedPenghuni.map((penghuni) => (
                      <SelectItem key={penghuni.id} value={penghuni.id}>
                        {penghuni.nama_lengkap}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
              )}
            />

            {errors.penghuni_id && (
              <p className="mt-1 text-xs text-red-500">
                {errors.penghuni_id.message}
              </p>
            )}
          </div>

          <DialogFooter>
            <Button
              type="button"
              variant="outline"
              onClick={() => setOpen(false)}
            >
              Batal
            </Button>
            <Button
              type="submit"
              disabled={assignMutation.isPending || isLoading || disabled}
            >
              Simpan
            </Button>
          </DialogFooter>
        </form>
      </DialogContent>
    </Dialog>
  );
}