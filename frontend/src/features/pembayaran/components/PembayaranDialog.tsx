/* eslint-disable react-hooks/set-state-in-effect */
/* eslint-disable @typescript-eslint/no-explicit-any */
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
import { useEffect, useState, useMemo } from "react";
import { toast } from "sonner";
import {
  useGetRumah,
  useGetTagihanRumah,
} from "@/features/rumah/hooks/useRumah";
import {
  useGetPembayaran,
  useUpdatePembayaran,
  useCreatePembayaran,
} from "../hooks/usePembayaran";
import { useGetPenghuni } from "@/features/penghuni/hooks/usePenghuni";
import { Controller, useForm, useWatch } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { createPembayaranSchema, type CreatePembayaranDTO } from "../types";
import { Loader2 } from "lucide-react";
import { Checkbox } from "@/components/ui/checkbox";
import { formatRp } from "@/lib/formatters";
import { Textarea } from "@/components/ui/textarea";
import { useQueryClient } from "@tanstack/react-query";

export function PembayaranDialog({
  open,
  onOpenChange,
  id,
  rumahIdInput,
}: {
  open: boolean;
  onOpenChange: (v: boolean) => void;
  id?: string | number | null;
  rumahIdInput?: string | number | null;
}) {
  const { data: rumah } = useGetRumah();
  const { data: pembayaran } = useGetPembayaran();
  const { data: penghuni } = useGetPenghuni();

  const [rumahId, setRumahId] = useState<string | null>(null);
  const [totalTagihan, setTotalTagihan] = useState<number>(0);

  const activeRumahId = rumahId;
  const { data: tagihan, isLoading: isLoadingTagihan } =
    useGetTagihanRumah(activeRumahId);

  const createPembayaranMutation = useCreatePembayaran();
  const updatePembayaranMutation = useUpdatePembayaran();
  const queryClient = useQueryClient();

  const isEdit = useMemo(() => {
    return !!pembayaran?.some((p) => String(p.id) === String(id));
  }, [pembayaran, id]);

  const form = useForm({
    resolver: zodResolver(createPembayaranSchema),
    defaultValues: {
      rumah_id: undefined,
      tagihan_ids: [],
      total_bayar: 0,
      tanggal_bayar: new Date().toISOString().split("T")[0],
      metode_pembayaran: "",
      catatan: "",
    },
  });

  const {
    register,
    handleSubmit,
    control,
    reset,
    setValue,
    formState: { errors },
  } = form;

  const totalBayarWatch = useWatch({ control, name: "total_bayar" });
  const tagihanIdsWatch = useWatch({ control, name: "tagihan_ids" });
  const metodeBayarWatch = useWatch({ control, name: "metode_pembayaran" });

  useEffect(() => {
    if (!open) {
      reset();
      setRumahId(null);
      setTotalTagihan(0);
      return;
    }

    const selectedPembayaran = pembayaran?.find(
      (p) => String(p.id) === String(id),
    );
    const selectedTagihan = tagihan?.find((t) => String(t.id) === String(id));

    if (isEdit && selectedPembayaran) {
      const rId = String(selectedPembayaran.rumah?.id);
      if (rId && !isNaN(Number(rId))) {
        setValue("rumah_id", Number(rId));
        setRumahId(rId);
      }

      setValue(
        "penghuni_id",
        selectedPembayaran.penghuni?.id
          ? Number(selectedPembayaran.penghuni.id)
          : undefined,
      );

      setValue(
        "tanggal_bayar",
        selectedPembayaran.tanggal_bayar
          ? new Date(selectedPembayaran.tanggal_bayar)
              .toISOString()
              .split("T")[0]
          : new Date().toISOString().split("T")[0],
      );

      setValue("total_bayar", Number(selectedPembayaran.total_bayar) || 0);
      setTotalTagihan(Number(selectedPembayaran.total_bayar) || 0);

      setValue("metode_pembayaran", selectedPembayaran.metode_pembayaran || "");
      setValue("catatan", selectedPembayaran.catatan || "");

      // eslint-disable-next-line @typescript-eslint/no-explicit-any
      const tagihanIds =
        selectedPembayaran.detail_alokasi?.map((d) => d.tagihan_id) || [];
      setValue("tagihan_ids", tagihanIds);
    } else if (!isEdit && selectedTagihan) {
      const targetRumahId = selectedTagihan.rumah?.id
        ? String(selectedTagihan.rumah.id)
        : rumahIdInput
          ? String(rumahIdInput)
          : null;

      if (targetRumahId && !isNaN(Number(targetRumahId))) {
        setValue("rumah_id", Number(targetRumahId));
        setRumahId(targetRumahId);

        const currentHouse = rumah?.find((r) => String(r.id) === targetRumahId);
        if (currentHouse?.penghuni_aktif?.id) {
          setValue("penghuni_id", Number(currentHouse.penghuni_aktif.id));
        } else {
          setValue("penghuni_id", undefined);
        }
      }

      setValue("tanggal_bayar", new Date().toISOString().split("T")[0]);
      setValue("total_bayar", selectedTagihan.nominal_tagihan);
      setTotalTagihan(selectedTagihan.nominal_tagihan);
      setValue("tagihan_ids", [selectedTagihan.id]);
    } else if (!isEdit && rumahIdInput) {
      if (!isNaN(Number(rumahIdInput))) {
        setRumahId(String(rumahIdInput));
        setValue("rumah_id", Number(rumahIdInput));

        const currentRumah = rumah?.find(
          (r) => String(r.id) === String(rumahIdInput),
        );
        if (currentRumah?.penghuni_aktif?.id) {
          setValue("penghuni_id", Number(currentRumah.penghuni_aktif.id));
        } else {
          setValue("penghuni_id", undefined);
        }
      }
    }
  }, [
    id,
    isEdit,
    pembayaran,
    tagihan,
    rumah,
    open,
    rumahIdInput,
    setValue,
    reset,
  ]);

  const submit = (data: CreatePembayaranDTO) => {
    const formData = new FormData();

    formData.append("rumah_id", String(data.rumah_id));
    formData.append("tanggal_bayar", data.tanggal_bayar);
    formData.append("total_bayar", String(data.total_bayar));

    if (data.penghuni_id) {
      formData.append("penghuni_id", String(data.penghuni_id));
    }
    if (data.metode_pembayaran) {
      formData.append("metode_pembayaran", data.metode_pembayaran);
    }
    if (data.catatan) {
      formData.append("catatan", data.catatan);
    }

    data.tagihan_ids.forEach((tagihanId) => {
      formData.append("tagihan_ids[]", String(tagihanId));
    });

    const handleSuccess = async () => {
      await Promise.all([
        queryClient.invalidateQueries({ queryKey: ["pembayaran"] }),
        queryClient.invalidateQueries({ queryKey: ["tagihan"] }),
      ]);

      toast.success(
        isEdit
          ? "Pembayaran berhasil diperbarui"
          : "Pembayaran berhasil dicatat",
      );
      onOpenChange(false);
      reset();
    };

    const handleError = (err: { message?: string }) => {
      const msg =
        err?.message ??
        `Gagal ${isEdit ? "memperbarui" : "menambahkan"} pembayaran`;
      toast.error(msg);
    };

    if (isEdit && id !== null && id !== undefined) {
      updatePembayaranMutation.mutate(
        { id, data: formData },
        { onSuccess: handleSuccess, onError: handleError },
      );
    } else {
      createPembayaranMutation.mutate(formData, {
        onSuccess: handleSuccess,
        onError: handleError,
      });
    }
  };

  const isPending =
    createPembayaranMutation.isPending || updatePembayaranMutation.isPending;

  const groupedTagihan = tagihan?.reduce(
    (acc: Record<string, any[]>, curr: any) => {
      const namaIuran = curr.jenis_iuran?.nama_iuran || "Iuran Lainnya";
      if (!acc[namaIuran]) acc[namaIuran] = [];
      acc[namaIuran].push(curr);
      return acc;
    },
    {} as Record<string, any[]>,
  );

  return (
    <Dialog open={open} onOpenChange={onOpenChange}>
      <DialogContent className="max-h-[90vh] overflow-y-auto scrollbar-thin">
        <form
          onSubmit={handleSubmit(submit, (validationErrors) => {
            const firstError = Object.values(validationErrors)[0]?.message;
            toast.error(
              firstError
                ? String(firstError)
                : "Mohon periksa kembali kelengkapan form Anda.",
            );
          })}
        >
          <DialogHeader>
            <DialogTitle>
              {isEdit ? "Edit Pembayaran" : "Tambahkan Pembayaran"}
            </DialogTitle>
          </DialogHeader>

          <div className="space-y-4 w-full my-4">
            <div>
              <Label>
                Rumah <span className="text-red-500">*</span>
              </Label>
              <Controller
                control={control}
                name="rumah_id"
                render={({ field }) => {
                  const selectedRumah = rumah?.find(
                    (r) => String(r.id) === String(field.value),
                  );
                  const selectedPenghuni = penghuni?.find(
                    (p) => p.id === selectedRumah?.penghuni_aktif?.id,
                  );

                  return (
                    <Select
                      value={
                        field.value && !isNaN(Number(field.value))
                          ? String(field.value)
                          : ""
                      }
                      disabled={isEdit}
                      onValueChange={(value) => {
                        field.onChange(Number(value));
                        setRumahId(value);

                        const currentRumah = rumah?.find(
                          (r) => String(r.id) === value,
                        );
                        if (currentRumah?.penghuni_aktif?.id) {
                          setValue(
                            "penghuni_id",
                            Number(currentRumah.penghuni_aktif.id),
                          );
                        } else {
                          setValue("penghuni_id", undefined);
                        }

                        setValue("tagihan_ids", []);
                        setTotalTagihan(0);
                        setValue("total_bayar", 0);
                      }}
                    >
                      <SelectTrigger className="mt-1.5">
                        <SelectValue placeholder="Pilih rumah">
                          {selectedRumah
                            ? `${selectedRumah.blok_nomor} ${
                                selectedPenghuni?.nama_lengkap
                                  ? `— ${selectedPenghuni.nama_lengkap}`
                                  : "— (Kosong)"
                              }`
                            : undefined}
                        </SelectValue>
                      </SelectTrigger>

                      <SelectContent className="max-h-100 overflow-y-scroll">
                        {rumah?.map((r) => {
                          const p = penghuni?.find(
                            (x) => x.id === r.penghuni_aktif?.id,
                          );

                          return (
                            <SelectItem key={r.id} value={String(r.id)}>
                              {r.blok_nomor}{" "}
                              {p?.nama_lengkap
                                ? `— ${p.nama_lengkap}`
                                : "— (Kosong)"}
                            </SelectItem>
                          );
                        })}
                      </SelectContent>
                    </Select>
                  );
                }}
              />
              {errors.rumah_id && (
                <p className="text-red-500 text-xs mt-1">
                  {errors.rumah_id.message}
                </p>
              )}
            </div>

            <div className="w-full">
              <div>
                <Label>
                  Iuran yang Dibayar <span className="text-red-500">*</span>
                </Label>
                {isLoadingTagihan && activeRumahId && (
                  <p className="text-sm text-muted-foreground mt-2">
                    Memuat tagihan...
                  </p>
                )}
                {!isLoadingTagihan &&
                  activeRumahId &&
                  (tagihan?.length ?? 0) === 0 && (
                    <p className="text-sm text-amber-600 mt-2">
                      Tidak ada tagihan untuk rumah ini.
                    </p>
                  )}

                <Controller
                  control={control}
                  name="tagihan_ids"
                  render={({ field }) => (
                    <div className="space-y-4 mt-3">
                      {groupedTagihan &&
                        Object.entries(groupedTagihan).map(
                          ([groupName, items]) => {
                            const groupIds = items.map((i) => i.id);
                            const currentIds = field.value || [];
                            const isAllGroupSelected =
                              groupIds.length > 0 &&
                              groupIds.every((id) => currentIds.includes(id));
                            const isSomeGroupSelected =
                              groupIds.some((id) => currentIds.includes(id)) &&
                              !isAllGroupSelected;

                            const totalGroupNominal = items.reduce(
                              (sum, item) => sum + Number(item.nominal_tagihan),
                              0,
                            );

                            return (
                              <div
                                key={groupName}
                                className="border rounded-lg p-3 bg-slate-50/50 dark:bg-slate-900/20"
                              >
                                <div className="flex items-center justify-between mb-3 pb-2 border-b">
                                  <div className="flex items-center gap-2">
                                    <Checkbox
                                      checked={
                                        isAllGroupSelected
                                          ? true
                                          : isSomeGroupSelected
                                            ? "indeterminate"
                                            : false
                                      }
                                      onCheckedChange={(checked) => {
                                        if (checked) {
                                          const unselectedItems = items.filter(
                                            (i) => !currentIds.includes(i.id),
                                          );
                                          const newIds = [
                                            ...currentIds,
                                            ...unselectedItems.map((i) => i.id),
                                          ];
                                          field.onChange(newIds);

                                          const addedTotal =
                                            unselectedItems.reduce(
                                              (sum, i) =>
                                                sum + Number(i.nominal_tagihan),
                                              0,
                                            );
                                          const newTotal =
                                            Number(totalTagihan) + addedTotal;
                                          setTotalTagihan(newTotal);
                                          setValue("total_bayar", newTotal);
                                        } else {
                                          const newIds = currentIds.filter(
                                            (id) => !groupIds.includes(id),
                                          );
                                          field.onChange(newIds);

                                          const removedItems = items.filter(
                                            (i) => currentIds.includes(i.id),
                                          );
                                          const removedTotal =
                                            removedItems.reduce(
                                              (sum, i) =>
                                                sum + Number(i.nominal_tagihan),
                                              0,
                                            );
                                          const newTotal =
                                            Number(totalTagihan) - removedTotal;
                                          setTotalTagihan(newTotal);
                                          setValue("total_bayar", newTotal);
                                        }
                                      }}
                                    />
                                    <Label className="font-semibold cursor-pointer">
                                      {groupName}{" "}
                                      <span className="text-muted-foreground text-xs font-normal">
                                        ({items.length} bulan)
                                      </span>
                                    </Label>
                                  </div>
                                  <div className="text-sm font-semibold text-slate-700 dark:text-slate-300">
                                    {formatRp(totalGroupNominal)}
                                  </div>
                                </div>

                                <div className="space-y-2 pl-1">
                                  {items.map((item) => {
                                    const monthNames = [
                                      "",
                                      "Jan",
                                      "Feb",
                                      "Mar",
                                      "Apr",
                                      "Mei",
                                      "Jun",
                                      "Jul",
                                      "Ags",
                                      "Sep",
                                      "Okt",
                                      "Nov",
                                      "Des",
                                    ];

                                    const periodStr =
                                      item.periode_bulan && item.periode_tahun
                                        ? `${monthNames[Number(item.periode_bulan)] || ""} ${item.periode_tahun}`.trim()
                                        : item.periode || "";

                                    const safeIuranName =
                                      item.jenis_iuran?.nama_iuran || "";

                                    return (
                                      <div
                                        key={item.id}
                                        className="flex justify-between items-center gap-2"
                                      >
                                        <div className="flex items-center gap-2">
                                          <Checkbox
                                            checked={currentIds.includes(
                                              item.id,
                                            )}
                                            onCheckedChange={(checked) => {
                                              if (checked) {
                                                const newIds = [
                                                  ...currentIds,
                                                  item.id,
                                                ];
                                                field.onChange(newIds);
                                                const newTotal =
                                                  Number(totalTagihan) +
                                                  Number(item.nominal_tagihan);
                                                setTotalTagihan(newTotal);
                                                setValue(
                                                  "total_bayar",
                                                  newTotal,
                                                );
                                              } else {
                                                const newIds =
                                                  currentIds.filter(
                                                    (id) => id !== item.id,
                                                  );
                                                field.onChange(newIds);
                                                const newTotal =
                                                  Number(totalTagihan) -
                                                  Number(item.nominal_tagihan);
                                                setTotalTagihan(newTotal);
                                                setValue(
                                                  "total_bayar",
                                                  newTotal,
                                                );
                                              }
                                            }}
                                          />
                                          <span className="text-sm">
                                            {periodStr || safeIuranName}
                                          </span>
                                        </div>
                                        <span className="text-sm font-medium">
                                          {formatRp(item.nominal_tagihan)}
                                        </span>
                                      </div>
                                    );
                                  })}
                                </div>
                              </div>
                            );
                          },
                        )}
                    </div>
                  )}
                />
                {errors.tagihan_ids && (
                  <p className="text-red-500 text-xs mt-1">
                    Minimal pilih 1 tagihan untuk dibayar
                  </p>
                )}
              </div>
            </div>

            <div className="grid grid-cols-2 gap-3">
              <div>
                <Label>
                  Nominal Pembayaran <span className="text-red-500">*</span>
                </Label>
                <Input
                  type="number"
                  placeholder="0"
                  className="mt-1.5"
                  {...register("total_bayar", {
                    valueAsNumber: true,
                  })}
                />
                {errors.total_bayar && (
                  <p className="text-red-500 text-xs mt-1">
                    {errors.total_bayar.message}
                  </p>
                )}
              </div>
              <div>
                <Label>
                  Tanggal Bayar <span className="text-red-500">*</span>
                </Label>
                <Input
                  type="date"
                  className="mt-1.5 w-full"
                  {...register("tanggal_bayar")}
                />
                {errors.tanggal_bayar && (
                  <p className="text-red-500 text-xs mt-1">
                    {errors.tanggal_bayar.message}
                  </p>
                )}
              </div>
            </div>

            <div className="grid grid-cols-2 gap-3 mt-2">
              <div className="col-span-2 sm:col-span-2">
                <Label>Metode Pembayaran</Label>
                <Controller
                  control={control}
                  name="metode_pembayaran"
                  render={({ field }) => (
                    <Select
                      value={field.value || ""}
                      onValueChange={field.onChange}
                    >
                      <SelectTrigger className="mt-1.5">
                        <SelectValue placeholder="Pilih metode" />
                      </SelectTrigger>
                      <SelectContent>
                        <SelectItem value="Tunai">Tunai</SelectItem>
                        <SelectItem value="Transfer Bank">
                          Transfer Bank
                        </SelectItem>
                        <SelectItem value="E-Wallet">E-Wallet</SelectItem>
                      </SelectContent>
                    </Select>
                  )}
                />
              </div>
              <div className="col-span-2">
                <Label>Catatan</Label>
                <Textarea
                  placeholder="Opsional, tambahkan catatan jika diperlukan..."
                  className="mt-1.5 w-full min-h-[80px] resize-none"
                  {...register("catatan")}
                />
              </div>
            </div>

            <div className="bg-slate-50 dark:bg-slate-900/50 p-4 rounded-lg border mt-6 text-sm space-y-2">
              <h4 className="font-semibold text-slate-800 dark:text-slate-100 border-b pb-2 mb-2">
                Ringkasan Pembayaran
              </h4>
              <div className="flex justify-between items-center">
                <span className="text-slate-500">
                  Iuran Terpilih ({tagihanIdsWatch?.length || 0})
                </span>
                <span className="font-medium">{formatRp(totalTagihan)}</span>
              </div>
              <div className="flex justify-between items-center">
                <span className="text-slate-500">Metode</span>
                <span className="font-medium">{metodeBayarWatch || "-"}</span>
              </div>
              <div className="flex justify-between items-center text-base font-semibold pt-2 border-t mt-2">
                <span>Total Dibayar</span>
                <span className="text-primary">
                  {formatRp(Number(totalBayarWatch) || 0)}
                </span>
              </div>
            </div>
          </div>

          <DialogFooter>
            <Button
              variant="outline"
              type="button"
              onClick={() => onOpenChange(false)}
            >
              Batal
            </Button>
            <Button type="submit" disabled={isPending}>
              {isPending && <Loader2 className="mr-2 h-4 w-4 animate-spin" />}
              {isPending ? "Menyimpan..." : "Simpan"}
            </Button>
          </DialogFooter>
        </form>
      </DialogContent>
    </Dialog>
  );
}
