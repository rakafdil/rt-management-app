import { useState } from "react";
import { UserX } from "lucide-react";
import { toast } from "sonner";

import { Button } from "@/components/ui/button";
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
} from "@/components/ui/alert-dialog";
import { useUnassignPenghuni } from "@/features/rumah/hooks/useRumah";
import type { UnassignRumahDTO } from "../types";

interface Props {
  rumahId: string;
  penghuniName?: string | null;
  disabled?: boolean;
}

export function UnassignRumahDialog({
  rumahId,
  penghuniName,
  disabled = false,
}: Props) {
  const [open, setOpen] = useState(false);
  const unassignMutation = useUnassignPenghuni(rumahId);

  const handleUnassign = () => {
    const payload: UnassignRumahDTO = {
      tanggal_selesai: new Date(),
    };

    unassignMutation.mutate(payload, {
      onSuccess: () => {
        toast.success("Penghuni berhasil diunassign");
        setOpen(false);
      },
      onError: () => {
        toast.error("Gagal unassign penghuni");
      },
    });
  };

  return (
    <>
      <Button
        type="button"
        variant="destructive"
        className="gap-2"
        onClick={() => setOpen(true)}
        disabled={disabled}
      >
        <UserX className="h-4 w-4" />
        Unassign Penghuni
      </Button>

      <AlertDialog open={open} onOpenChange={setOpen}>
        <AlertDialogContent>
          <AlertDialogHeader>
            <AlertDialogTitle>Unassign Penghuni?</AlertDialogTitle>
            <AlertDialogDescription>
              {penghuniName
                ? `Penghuni ${penghuniName} akan dilepaskan dari rumah ini.`
                : "Penghuni aktif akan dilepaskan dari rumah ini."}
            </AlertDialogDescription>
          </AlertDialogHeader>

          <AlertDialogFooter>
            <AlertDialogCancel>Batal</AlertDialogCancel>
            <AlertDialogAction
              onClick={(event) => {
                event.preventDefault();
                handleUnassign();
              }}
              className="bg-destructive text-destructive-foreground hover:bg-destructive/90"
              disabled={unassignMutation.isPending || disabled}
            >
              Ya, Lepaskan
            </AlertDialogAction>
          </AlertDialogFooter>
        </AlertDialogContent>
      </AlertDialog>
    </>
  );
}