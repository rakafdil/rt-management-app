export const formatRp = (n: number) =>
  new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    maximumFractionDigits: 0,
  }).format(n);

export const monthLabel = (ym: string) => {
  const [y, m] = ym.split("-");
  const months = [
    "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
    "Jul", "Agt", "Sep", "Okt", "Nov", "Des",
  ];
  return `${months[parseInt(m, 10) - 1]} ${y}`;
};