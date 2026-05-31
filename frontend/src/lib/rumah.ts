export const formatPeriode = (
  bulan?: number,
  tahun?: number,
  periodeStr?: string,
) => {
  if (bulan && tahun) {
    const months = [
      "Januari",
      "Februari",
      "Maret",
      "April",
      "Mei",
      "Juni",
      "Juli",
      "Agustus",
      "September",
      "Oktober",
      "November",
      "Desember",
    ];

    const monthName = months[bulan - 1] || "Bulan Tidak Valid";

    return `${monthName} ${tahun}`;
  }

  return periodeStr || "-";
};

export const formatDateStr = (dateStr?: string) => {
  if (!dateStr) return "-";

  try {
    return new Date(dateStr).toLocaleDateString("id-ID", {
      day: "numeric",
      month: "long",
      year: "numeric",
    });
  } catch {
    return dateStr;
  }
};

export const toSafeNumber = (value: unknown) => {
  const parsed = Number(value);

  return Number.isFinite(parsed) ? parsed : 0;
};