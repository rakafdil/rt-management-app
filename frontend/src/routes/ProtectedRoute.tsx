import { Navigate, Outlet } from "react-router-dom";
import { useAuthStore } from "../store/useAuthStore";
import { useAuthMe } from "@/features/auth/hooks/useAuth";
import { Loading } from "@/components/Loading";

export const ProtectedRoute = () => {
  const { isLoading } = useAuthMe();
  const isAuthenticated = useAuthStore((state) => state.isAuthenticated);

  if (isLoading) {
    return (
      <div className="flex h-screen items-center justify-center bg-muted/60 px-4">
        <Loading message="memeriksa sesi login" />
      </div>
    );
  }

  if (!isAuthenticated) {
    return <Navigate to="/login" replace />;
  }

  return <Outlet />;
};
