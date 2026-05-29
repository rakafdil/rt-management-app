const LoginForm = () => (
  <div className="p-4 border rounded shadow bg-white">
    <p>Ini form login dari folder features/auth</p>
  </div>
);

export const LoginPage = () => {
  return (
    <div className="flex h-screen items-center justify-center bg-gray-100">
      <div className="w-full max-w-md">
        <h2 className="text-2xl font-bold text-center mb-6">Masuk ke Akun</h2>
        <LoginForm /> 
      </div>
    </div>
  );
};