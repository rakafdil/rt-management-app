import { useEffect, useState, type FormEvent } from "react";
import { useNavigate } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { useAuthLogin, useAuthMe } from "@/features/auth/hooks/useAuth";
import { useAuthStore } from "@/store/useAuthStore";
import { toast } from "sonner";

const LoginForm = () => {
  const navigate = useNavigate();
  const isAuthenticated = useAuthStore((state) => state.isAuthenticated);
  const loginMutation = useAuthLogin();
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [remember, setRemember] = useState(true);

  useEffect(() => {
    if (isAuthenticated) {
      navigate("/");
    }
  }, [isAuthenticated, navigate]);

  const handleSubmit = async (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault();

    loginMutation.mutate(
      { email, password, remember },
      {
        onSuccess: () => {
          toast.success("Login berhasil");
          navigate("/");
        },
        onError: (error: unknown) => {
          const message =
            error instanceof Error
              ? error.message
              : "Email atau password salah";
          toast.error(message);
        },
      },
    );
  };

  return (
    <form onSubmit={handleSubmit} className="space-y-4">
      <div className="space-y-2">
        <Label htmlFor="email">Email</Label>
        <Input
          id="email"
          type="email"
          placeholder="nama@email.com"
          value={email}
          onChange={(event) => setEmail(event.target.value)}
          required
        />
      </div>

      <div className="space-y-2">
        <Label htmlFor="password">Password</Label>
        <Input
          id="password"
          type="password"
          placeholder="Masukkan password"
          value={password}
          onChange={(event) => setPassword(event.target.value)}
          required
        />
      </div>

      <label className="flex items-center gap-2 text-sm text-muted-foreground">
        <input
          type="checkbox"
          checked={remember}
          onChange={(event) => setRemember(event.target.checked)}
          className="h-4 w-4"
        />
        Ingat saya
      </label>

      <Button className="w-full" type="submit" disabled={loginMutation.isPending}>
        {loginMutation.isPending ? "Memproses..." : "Masuk"}
      </Button>
    </form>
  );
};

export const LoginPage = () => {
  // const { isLoading: isChecking } = useAuthMe();

  // // if (isChecking) {
  // //   return (
  // //     <div className="flex h-screen items-center justify-center bg-muted/60 px-4">
  // //       <div className="w-full max-w-md rounded-lg border bg-white p-6 shadow-sm text-center">
  // //         Memeriksa sesi login...
  // //       </div>
  // //     </div>
  // //   );
  // // }

  return (
    <div className="flex h-screen items-center justify-center bg-muted/60 px-4">
      <div className="w-full max-w-md rounded-lg border bg-white p-6 shadow-sm">
        <h2 className="text-2xl font-bold text-center">Masuk ke Akun</h2>
        <p className="text-sm text-muted-foreground text-center mt-1">
          Gunakan akun yang telah dibuat oleh sistem
        </p>
        <div className="mt-6">
          <LoginForm />
        </div>
      </div>
    </div>
  );
};