import { Loader2 } from "lucide-react";
import React from "react";

interface LoadingProps {
  message?: string;
}

export const Loading = ({
  message = "Mengambil data terbaru dari server...",
}: LoadingProps) => {
  return (
    <div className="flex h-full flex-col items-center justify-center gap-4 p-8">
      <Loader2 className="h-10 w-10 animate-spin text-blue-500" />

      <div className="space-y-1 text-center">
        <h2 className="text-lg font-semibold text-gray-800">Sedang memuat</h2>

        <p className="text-sm text-gray-500">{message}</p>
      </div>
    </div>
  );
};
