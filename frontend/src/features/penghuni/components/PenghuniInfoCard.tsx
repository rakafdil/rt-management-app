import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Badge } from "@/components/ui/badge";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Phone, User } from "lucide-react";
import type { Penghuni } from "../types";

interface PenghuniInfoCardProps {
  penghuni: Penghuni;
}

export function PenghuniInfoCard({ penghuni }: PenghuniInfoCardProps) {
  const initials = penghuni.nama_lengkap
    .split(" ")
    .map((word) => word[0])
    .slice(0, 2)
    .join("")
    .toUpperCase();

  return (
    <Card className="overflow-hidden">
      <CardHeader className="border-b bg-muted/40">
        <div className="flex items-center gap-3">
          <Avatar className="h-12 w-12">
            {penghuni.foto_ktp_url ? (
              <AvatarImage src={penghuni.foto_ktp_url} />
            ) : null}
            <AvatarFallback>{initials}</AvatarFallback>
          </Avatar>
          <div className="flex-1">
            <CardTitle className="text-xl flex items-center gap-2">
              {penghuni.nama_lengkap}
              <User className="h-4 w-4 text-muted-foreground" />
            </CardTitle>
            <div className="mt-2 flex flex-wrap gap-2">
              <Badge
                variant={
                  penghuni.status_penghuni === "tetap"
                    ? "default"
                    : "secondary"
                }
              >
                {penghuni.status_penghuni}
              </Badge>
              <Badge variant="outline">
                {penghuni.status_menikah ? "Menikah" : "Belum menikah"}
              </Badge>
            </div>
          </div>
          <div className="hidden sm:flex items-center gap-2 text-sm text-muted-foreground">
            <Phone className="h-4 w-4" />
            <span>{penghuni.nomor_telepon || "-"}</span>
          </div>
        </div>
      </CardHeader>
      <CardContent className="p-6">
        <div className="grid gap-6 md:grid-cols-[1fr_260px]">
          <div className="space-y-2 text-sm">
            <div className="text-muted-foreground">Nomor Telepon</div>
            <div className="font-medium text-base">
              {penghuni.nomor_telepon || "-"}
            </div>
            <div className="mt-4 text-muted-foreground">Status Menikah</div>
            <div className="font-medium text-base">
              {penghuni.status_menikah ? "Menikah" : "Belum menikah"}
            </div>
            <div className="mt-4 text-muted-foreground">Menghuni</div>
            <div className="font-medium text-base">
              {penghuni.rumah_aktif?.blok_nomor ?? "Tidak menghuni"}
            </div>
          </div>
          <div>
            <div className="text-sm text-muted-foreground mb-2">
              Foto KTP
            </div>
            {penghuni.foto_ktp_url ? (
              <img
                src={penghuni.foto_ktp_url}
                alt={`KTP ${penghuni.nama_lengkap}`}
                className="w-full h-40 object-cover rounded-md border"
              />
            ) : (
              <div className="flex h-40 items-center justify-center rounded-md border border-dashed text-sm text-muted-foreground">
                Tidak ada foto
              </div>
            )}
          </div>
        </div>
      </CardContent>
    </Card>
  );
}
