import { Check, Plus } from "lucide-react";
import { useState } from "react";

import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from "@/components/ui/popover";

import {
  Command,
  CommandEmpty,
  CommandGroup,
  CommandInput,
  CommandItem,
  CommandList,
} from "@/components/ui/command";

import { Button } from "@/components/ui/button";

import { useDebounce } from "@/lib/useDebounce";
import { usePencarianKategori } from "../hooks/usePencarianKategori";

type Props = {
  value?: {
    kategori_id?: number | null;
    nama_kategori?: string;
  };

  onChange: (value: {
    kategori_id?: number | null;
    nama_kategori?: string;
  }) => void;
};

export function KategoriPengeluaranSearch({ value, onChange }: Props) {
  const [open, setOpen] = useState(false);
  const [keyword, setKeyword] = useState(value?.nama_kategori ?? "");

  const debouncedKeyword = useDebounce(keyword, 500);
  
  const { data = [], isFetching } =
    usePencarianKategori(debouncedKeyword);
  
  return (
    <Popover open={open} onOpenChange={setOpen}>
      <PopoverTrigger asChild>
        <Button
          variant="outline"
          className="w-full justify-start font-normal text-left truncate"
        >
          {value?.nama_kategori || "Pilih kategori..."}
        </Button>
      </PopoverTrigger>

      <PopoverContent
        className="w-[--radix-popover-trigger-width] max-w-[calc(100vw-2rem)] p-0"
        align="start"
      >
        <Command shouldFilter={false} className="min-w-0">
          <CommandInput
            placeholder="Cari kategori..."
            value={keyword}
            onValueChange={setKeyword}
            className="min-w-0"
          />

          <CommandList className="min-w-0">
            <CommandEmpty>
              {!isFetching && keyword.trim() ? (
                <div
                  className="relative flex min-w-0 cursor-pointer select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none hover:bg-accent hover:text-accent-foreground"
                  onClick={() => {
                    onChange({
                      kategori_id: null,
                      nama_kategori: keyword,
                    });
                    setOpen(false);
                  }}
                >
                  <Plus className="mr-2 h-4 w-4 shrink-0" />
                  <span className="truncate">Tambah "{keyword}"</span>
                </div>
              ) : isFetching ? (
                <div className="py-2 text-center text-sm text-muted-foreground">
                  Mencari...
                </div>
              ) : (
                <div className="py-2 text-center text-sm text-muted-foreground">
                  Kategori tidak ditemukan.
                </div>
              )}
            </CommandEmpty>
            {data.length > 0 && (
              <CommandGroup>
                {data.map((item: { id: number; nama_kategori: string }) => (
                  <CommandItem
                    key={item.id}
                    value={item.nama_kategori}
                    className="min-w-0"
                    onSelect={() => {
                      onChange({
                        kategori_id: item.id,
                        nama_kategori: item.nama_kategori,
                      });
                      setKeyword(item.nama_kategori);
                      setOpen(false);
                    }}
                  >
                    <Check
                      className={`mr-2 h-4 w-4 shrink-0 ${
                        value?.kategori_id === item.id
                          ? "opacity-100"
                          : "opacity-0"
                      }`}
                    />
                    <span className="truncate">{item.nama_kategori}</span>
                  </CommandItem>
                ))}
              </CommandGroup>
            )}
          </CommandList>
        </Command>
      </PopoverContent>
    </Popover>
  );
}
