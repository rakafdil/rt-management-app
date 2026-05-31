import axios from "axios";
import { api } from "@/lib/axios";

export interface LoginPayload {
  email: string;
  password: string;
  remember?: boolean;
}

export interface AuthUser {
  id: number | string;
  name: string;
  email: string;
}

const getBaseUrl = () => {
  const apiUrl = import.meta.env.VITE_API_URL || "http://localhost:8000/api/v1";
  return apiUrl.replace(/\/api(\/v\d+)?$/, "");
};

export const getCsrfCookie = async () => {
  const baseUrl = getBaseUrl();
  await axios.get(`${baseUrl}/sanctum/csrf-cookie`, {
    withCredentials: true,
  });
};

export const login = async (payload: LoginPayload): Promise<AuthUser> => {
  await getCsrfCookie();
  const response = await api.post("auth/login", payload);
  return response.data.data.user;
};

export const getMe = async (): Promise<AuthUser> => {
  const response = await api.get("auth/me");
  return response.data.data;
};

export const logout = async (): Promise<void> => {
  await api.post("auth/logout");
};
