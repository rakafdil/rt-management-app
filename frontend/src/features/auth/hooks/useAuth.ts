import { useMutation, useQuery } from "@tanstack/react-query";
import { getMe, login, logout } from "../api";
import { useAuthStore } from "@/store/useAuthStore";

export const useAuthMe = () => {
  return useQuery({
    queryKey: ["auth", "me"],
    queryFn: async () => {
      try {
        const user = await getMe();
        useAuthStore.getState().setUser(user);
        return user;
      } catch (error) {
        useAuthStore.getState().logout();
        throw error;
      }
    },
    retry: false,
    staleTime: 5 * 60 * 1000,
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
