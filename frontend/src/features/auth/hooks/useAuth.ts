import { useMutation, useQuery } from "@tanstack/react-query";
import { getMe, login, logout } from "../api";
import { useAuthStore } from "@/store/useAuthStore";

export const useAuthMe = () => {
  const setUser = useAuthStore((state) => state.setUser);
  const clearAuth = useAuthStore((state) => state.logout);

  return useQuery({
    queryKey: ["auth", "me"],
    queryFn: getMe,
    retry: false,
    staleTime: 5 * 60 * 1000,
    onSuccess: (user) => setUser(user),
    onError: () => clearAuth(),
  });
};

export const useAuthLogin = () => {
  const setUser = useAuthStore((state) => state.setUser);

  return useMutation({
    mutationFn: login,
    onSuccess: (user) => setUser(user),
  });
};

export const useAuthLogout = () => {
  const clearAuth = useAuthStore((state) => state.logout);

  return useMutation({
    mutationFn: logout,
    onSuccess: () => clearAuth(),
  });
};
