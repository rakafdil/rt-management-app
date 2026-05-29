import { createBrowserRouter } from "react-router-dom";

import { ProtectedRoute } from "@/routes/ProtectedRoute";
import { MainLayout } from "@/layouts/MainLayout";

import { DashboardPage } from "@/pages/dashboard/DashboardPage";
import LaporanPage from "@/pages/laporan/LaporanPage";
import PembayaranPage from "@/pages/pembayaran/PembayaranPage";
import PengeluaranPage from "@/pages/pengeluaran/PengeluaranPage";
import {PenghuniPage} from "@/pages/penghuni/PenghuniPage";
import RumahPage from "@/pages/rumah/RumahPage";
import RumahDetailPage from "@/pages/rumah/RumahDetailPage";
import NotFoundPage from "@/pages/NotFoundPage";
import { authRoutes } from "@/features/auth/routes";

export const router = createBrowserRouter([
  ...authRoutes,

  {
    element: '',
    children: [
      {
        element: <MainLayout />,
        children: [
          {
            path: "/",
            element: <DashboardPage />,
          },
          {
            path: "/rumah",
            element: <RumahPage />,
          },
          {
            path: "/rumah/:id",
            element: <RumahDetailPage />,
          },
          {
            path: "/penghuni",
            element: <PenghuniPage />,
          },
          {
            path: "/pembayaran",
            element: <PembayaranPage />,
          },
          {
            path: "/pengeluaran",
            element: <PengeluaranPage />,
          },
          {
            path: "/laporan",
            element: <LaporanPage />,
          },
        ],
      },
    ],
  },

  {
    path: "*",
    element: <NotFoundPage />,
  },
]);
