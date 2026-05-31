# RT Administration System

Sistem Administrasi RT berbasis Fullstack menggunakan **Laravel** sebagai Backend API dan **React + Vite** sebagai Frontend.

## Teknologi yang Digunakan

### Backend

* PHP 8.2+
* Laravel 12+
* Composer
* MySQL

### Frontend

* React
* Vite
* TypeScript
* Axios
* React Router
* TanStack Query
* Tailwind CSS
* shadcn

## ERD Diagram
``` mermaid
erDiagram
    %% ==========================================
    %% DEFINISI RELASI DENGAN PENJELASAN DI PANAH
    %% ==========================================
    
    rumah ||--o{ histori_huni : "memiliki histori"
    penghuni ||--o{ histori_huni : "tercatat di"
    
    jenis_iuran ||--o{ tagihan : "menjadi dasar nominal"
    
    penghuni ||--o{ pembayaran : "melakukan pembayaran"
    rumah ||--o{ pembayaran : "dibayar untuk rumah"
    
    pembayaran ||--o{ detail_pembayaran : "dipecah alokasinya ke"
    rumah ||--o{ tagihan : "mempunyai tagihan"
    tagihan ||--o{ detail_pembayaran : "dicicil / dilunasi melalui"
    
    kategori_pengeluaran ||--o{ pengeluaran : "mengkategorikan"

    %% ==========================================
    %% DEFINISI TABEL DAN ATRIBUT
    %% ==========================================

    penghuni {
        bigint id PK
        varchar nama_lengkap
        varchar foto_ktp
        varchar status_penghuni "tetap, kontrak"
        varchar nomor_telepon
        boolean status_menikah
        timestamp created_at
        timestamp updated_at
        timestamp deleted_at
    }

    rumah {
        bigint id PK
        varchar blok_nomor UK "Unique"
        varchar status_huni "dihuni, kosong"
        timestamp created_at
        timestamp updated_at
    }

    histori_huni {
        bigint id PK
        bigint penghuni_id FK
        bigint rumah_id FK
        date tanggal_mulai
        date tanggal_selesai "Null = Masih menghuni"
        timestamp created_at
        timestamp updated_at
    }

    jenis_iuran {
        bigint id PK
        varchar nama_iuran
        decimal nominal_default
        timestamp created_at
        timestamp updated_at
    }

    tagihan {
        bigint id PK
        bigint rumah_id FK
        bigint jenis_iuran_id FK
        int periode_bulan "1 - 12"
        int periode_tahun "YYYY"
        decimal nominal_tagihan
        varchar status_pembayaran "belum_bayar, sebagian, lunas"
        timestamp created_at
        timestamp updated_at
    }

    pembayaran {
        bigint id PK
        bigint penghuni_id FK "Siapa yang membayar"
        bigint rumah_id FK "Untuk rumah mana"
        date tanggal_bayar
        decimal total_bayar
        varchar metode_pembayaran
        text catatan
        timestamp created_at
        timestamp updated_at
        timestamp deleted_at
    }

    detail_pembayaran {
        bigint id PK
        bigint pembayaran_id FK
        bigint tagihan_id FK
        decimal nominal_alokasi
        timestamp created_at
    }

    kategori_pengeluaran {
        bigint id PK
        varchar nama_kategori
    }

    pengeluaran {
        bigint id PK
        bigint kategori_id FK
        text deskripsi
        decimal nominal
        date tanggal_pengeluaran
        timestamp created_at
        timestamp updated_at
        timestamp deleted_at
    }
```

## Project Structure

```
rt-management-app/          <-- Root folder 
│
├── README.md               <-- Panduan instalasi, screenshot fitur, dan ERD
│
├── backend/
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/    <-- Tempat menerima request, memanggil Service/Model, dan membalikkan response JSON
│   │   │   ├── Requests/       <-- Tempat class validasi input dari user
│   │   │   └── Resources/      <-- Tempat standarisasi format response JSON (menyaring data sensitif, memformat tanggal, dll) sebelum dikirim ke frontend
│   │   │
│   │   ├── Models/             <-- Representasi tabel database dan tempat mendefinisikan relasi antar tabel (Eloquent ORM)
│   │   │
│   │   └── Services/           <-- Tempat menaruh business logic kompleks seperti kalkulasi tagihan bulanan atau query grafik laporan keuangan
│   │
│   ├── database/
│   │   ├── migrations/         <-- Skema pembuatan tabel database
│   │   └── seeders/            <-- Script untuk memasukkan data awal/dummy
│   │
│   ├── routes/                 <-- Tempat mendefinisikan URL/Endpoint
│   │
│   └── storage/
│       └── app/public/         <-- Folder untuk menyimpan file fisik hasil upload dari frontend
└── frontend/               <-- Folder project React
    ├── package.json
    ├── public/
    ├── src/
    │   ├── assets/
    │   ├── components/     <-- Reusable components (Button, Modal, Sidebar)
    │   ├── pages/          <-- Halaman utama (Dashboard, Penghuni, Rumah, Keuangan)
    │   ├── services/       <-- Konfigurasi Axios untuk memanggil API backend
    │   ├── utils/          <-- Helper (format uang Rupiah, format tanggal)
    │   ├── App.tsx
    │   └── main.tsx
    └── .env.example        <-- Simpan VITE_API_URL=http://localhost:8000/api/v1

```
## Component Diagram
![component-diagram](./component-diagram.png)



# Persyaratan Sistem

Pastikan software berikut telah terinstall:

| Software | Versi Minimum |
| -------- | ------------- |
| PHP      | 8.2           |
| Composer | Latest        |
| Node.js  | 20.x          |
| npm      | 10.x          |
| MySQL    | 8.x           |
| Git      | Latest        |

Cek versi yang terinstall:

```bash
php -v
composer -V
node -v
npm -v
mysql --version
git --version
```

# Clone Repository

```bash
git clone <repository-url>
cd project-root
```


# Instalasi Backend (Laravel)

Masuk ke folder backend:

```bash
cd backend
```

## Install Dependency

```bash
composer install
```

## Membuat File Environment

Linux / MacOS:

```bash
cp .env.example .env
```

Windows:

```powershell
copy .env.example .env
```

## Generate Application Key

```bash
php artisan key:generate
```

## Konfigurasi Database

Buka file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rt_administration
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
SANCTUM_STATEFUL_DOMAINS=localhost:5173,127.0.0.1:5173,localhost:8000,127.0.0.1:8000
CORS_ALLOWED_ORIGINS=http://localhost:5173,http://127.0.0.1:5173

SESSION_DRIVER=file
SANCTUM_STATEFUL_DOMAINS=localhost:5173,127.0.0.1:5173,localhost:8000,127.0.0.1:8000
CORS_ALLOWED_ORIGINS=http://localhost:5173,http://127.0.0.1:5173
```

Sesuaikan dengan konfigurasi MySQL masing-masing.



## Menjalankan Migration

```bash
php artisan migrate
```

Jika project memiliki seeder:

```bash
php artisan db:seed
```

Atau:

```bash
php artisan migrate:fresh --seed
```

## Membuat Database (Harusnya otomatis dari migration jika tidak ada)

Login ke MySQL:

```sql
CREATE DATABASE rt_administration;
```


## Membuat Storage Link

Jika menggunakan upload file:

```bash
php artisan storage:link
```


## Menjalankan Backend

```bash
php artisan serve
```

Secara default API akan berjalan pada:

```text
http://127.0.0.1:8000
```


# Instalasi Frontend (React + Vite)

Masuk ke folder frontend:

```bash
cd frontend
```

## Install Dependency

```bash
npm install
```


## Membuat File Environment

Buat file:

```text
frontend/.env
```

Isi:

```env
VITE_API_URL=http://localhost:8000/api/v1
```

Atau jika menggunakan domain:

```env
VITE_API_URL=https://api.domain.com/api/v1
```


## Menjalankan Frontend

```bash
npm run dev
```

Secara default frontend berjalan pada:

```text
http://localhost:5173
```

Catatan: Autentikasi memakai cookie (Laravel Sanctum). Gunakan hostname yang sama untuk frontend dan backend (contoh: sama-sama `localhost`) agar cookie CSRF terbaca. Pastikan domain frontend ada di `SANCTUM_STATEFUL_DOMAINS` dan `CORS_ALLOWED_ORIGINS`.


# Menjalankan Project Secara Lengkap

## Terminal 1 (Backend)

```bash
cd backend

php artisan serve
```

Output:

```text
http://localhost:8000
```


## Terminal 2 (Frontend)

```bash
cd frontend

npm run dev
```

Output:

```text
http://localhost:5173
```


# Akun Default

Jika menggunakan Seeder:

| Role  | Email                                         | Password |
| ----- | --------------------------------------------- | -------- |
| Admin | [test@example.com](mailto:test@example.com)   | password |

> Sesuaikan dengan data seeder yang digunakan.

---

# Build Production

## Backend

Optimasi konfigurasi:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Frontend

Build aplikasi:

```bash
npm run build
```

Hasil build akan berada di:

```text
frontend/dist
```

Preview build:

```bash
npm run preview
```

---

# Testing

## Backend

```bash
php artisan test
```

atau

```bash
php artisan test --parallel
```

---

## Frontend

```bash
npm run test
```

atau sesuai framework testing yang digunakan.

---

# Troubleshooting

## Composer Install Gagal

Update composer:

```bash
composer self-update
```

Lalu:

```bash
composer clear-cache
composer install
```

---

## Error APP_KEY Missing

```bash
php artisan key:generate
```

---

## Error Storage Link

Hapus link lama:

```bash
php artisan storage:unlink
```

Kemudian:

```bash
php artisan storage:link
```

---

## Error Vite Tidak Bisa Terhubung ke API

Pastikan:

```env
VITE_API_URL=http://127.0.0.1:8000/api/v1
```

Jika kamu menggunakan `localhost` untuk backend, gunakan:

```env
VITE_API_URL=http://localhost:8000/api/v1
```

Backend sedang berjalan:

```bash
php artisan serve
```

---

## Error Migration

Rollback:

```bash
php artisan migrate:rollback
```

Reset:

```bash
php artisan migrate:fresh
```

Dengan seeder:

```bash
php artisan migrate:fresh --seed
```

---

# Command Penting

## Laravel

```bash
php artisan serve
php artisan migrate
php artisan migrate:fresh --seed
php artisan db:seed
php artisan storage:link
php artisan test
```

## React + Vite

```bash
npm install
npm run dev
npm run build
npm run preview
```

---

# Environment Variables

## Backend (.env)

```env
APP_NAME="RT Administration System"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rt_administration
DB_USERNAME=root
DB_PASSWORD=
```

---

## Frontend (.env)

```env
VITE_API_URL=http://localhost:8000/api/v1
```

---

# Deployment Overview

## Backend

1. Upload source code Laravel
2. Jalankan:

```bash
composer install --optimize-autoloader --no-dev
```

3. Konfigurasi `.env`
4. Generate key:

```bash
php artisan key:generate
```

5. Migration:

```bash
php artisan migrate --force
```

6. Cache:

```bash
php artisan optimize
```

---

## Frontend

```bash
npm install
npm run build
```

Deploy isi folder:

```text
frontend/dist
```

ke Nginx, Apache, Vercel, atau layanan hosting lainnya.

---

# License

Proyek ini dikembangkan untuk kebutuhan Sistem Administrasi RT.
