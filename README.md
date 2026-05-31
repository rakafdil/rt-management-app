<div align="center">

# 🏘️ RT Administration System

**Sistem administrasi RT modern — dari pencatatan penghuni hingga laporan keuangan, semua dalam satu platform.**

[![Laravel](https://img.shields.io/badge/Laravel-12+-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![React](https://img.shields.io/badge/React-Vite-61DAFB?style=flat-square&logo=react&logoColor=black)](https://react.dev)
[![TypeScript](https://img.shields.io/badge/TypeScript-5.x-3178C6?style=flat-square&logo=typescript&logoColor=white)](https://typescriptlang.org)
[![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com)

[🎬 Lihat Demo Fitur](./FEATURES.md) · [📐 ERD Diagram](#-erd-diagram) · [🚀 Mulai Instalasi](#-instalasi)

</div>

---

## ✨ Tentang Proyek

RT Administration System adalah aplikasi fullstack untuk membantu pengurus RT mengelola data warga dan keuangan secara digital. Tidak perlu lagi buku catatan manual atau spreadsheet yang berantakan.

**Apa yang bisa dilakukan:**

- 👤 **Manajemen Penghuni** — Catat data warga, status hunian, dan histori pindah masuk/keluar
- 🏠 **Manajemen Rumah** — Kelola blok rumah, assign/unassign penghuni
- 💰 **Sistem Tagihan & Pembayaran** — Buat tagihan iuran bulanan, catat pembayaran, lacak tunggakan
- 📊 **Laporan Keuangan** — Ringkasan pemasukan, pengeluaran, dan saldo kas RT
- 🔐 **Autentikasi Aman** — Login berbasis cookie dengan Laravel Sanctum

> 🎬 **[Lihat demo GIF semua fitur →](./FEATURES.md)**

---

## 🛠️ Teknologi

| Layer | Stack |
|-------|-------|
| **Backend** | PHP 8.2+, Laravel 12, MySQL 8, Laravel Sanctum |
| **Frontend** | React, Vite, TypeScript, Tailwind CSS, shadcn/ui |
| **State & Data** | TanStack Query, Zustand, Axios, Zod |
| **Routing** | React Router DOM |

---

## 📐 ERD Diagram

```mermaid
erDiagram
    rumah ||--o{ histori_huni : "memiliki histori"
    penghuni ||--o{ histori_huni : "tercatat di"
    jenis_iuran ||--o{ tagihan : "menjadi dasar nominal"
    penghuni ||--o{ pembayaran : "melakukan pembayaran"
    rumah ||--o{ pembayaran : "dibayar untuk rumah"
    pembayaran ||--o{ detail_pembayaran : "dipecah alokasinya ke"
    rumah ||--o{ tagihan : "mempunyai tagihan"
    tagihan ||--o{ detail_pembayaran : "dicicil / dilunasi melalui"
    kategori_pengeluaran ||--o{ pengeluaran : "mengkategorikan"

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

<h2>🏠 Entitas Inti Penghuni & Rumah</h2>

<p>
  <strong>Penghuni</strong> menyimpan data pribadi warga seperti nama, nomor KTP,
  nomor telepon, dan status penghuni.
</p>

<p>
  <strong>Rumah</strong> menyimpan data unit rumah yang ada di perumahan berdasarkan
  blok dan nomor rumah.
</p>

<p>
  Hubungan antara penghuni dan rumah dikelola melalui tabel
  <strong>histori_huni</strong>. Tabel ini berfungsi sebagai pencatat riwayat
  hunian, termasuk kapan seorang penghuni mulai menempati rumah dan kapan
  masa huninya berakhir.
</p>

<p>
  Jika nilai <code>tanggal_selesai</code> bernilai <code>NULL</code>, maka
  penghuni tersebut masih aktif menempati rumah tersebut saat ini.
</p>

<h2>💰 Sistem Tagihan</h2>

<p>
  <strong>Jenis Iuran</strong> berfungsi sebagai master data atau template iuran
  yang berlaku di lingkungan perumahan.
</p>

<p>Contoh data jenis iuran:</p>

<ul>
  <li>Iuran Keamanan — Rp50.000 per bulan</li>
  <li>Iuran Kebersihan — Rp25.000 per bulan</li>
  <li>Iuran Kas RT — Rp20.000 per bulan</li>
</ul>

<p>
  Berdasarkan data pada <strong>jenis_iuran</strong>, sistem akan menghasilkan
  (<em>generate</em>) <strong>tagihan</strong> untuk setiap rumah pada periode tertentu.
</p>

<p>
  Setiap tagihan memiliki status pembayaran:
</p>

<ul>
  <li><code>belum_bayar</code> → Belum ada pembayaran.</li>
  <li><code>sebagian</code> → Sudah dibayar sebagian.</li>
  <li><code>lunas</code> → Tagihan telah dibayar penuh.</li>
</ul>

<h2>💳 Sistem Pembayaran</h2>

<p>
  <strong>Pembayaran</strong> mencatat transaksi pembayaran yang dilakukan oleh
  penghuni untuk rumah tertentu.
</p>

<p>
  Satu transaksi pembayaran dapat digunakan untuk membayar beberapa tagihan
  sekaligus. Hubungan tersebut dicatat melalui tabel
  <strong>detail_pembayaran</strong> yang berfungsi sebagai tabel alokasi pembayaran.
</p>

<p>Contoh:</p>

<ul>
  <li>Total pembayaran: Rp150.000</li>
  <li>Tunggakan bulan sebelumnya: Rp50.000</li>
  <li>Tagihan bulan berjalan: Rp100.000</li>
</ul>

<p>
  Dalam kasus tersebut, satu transaksi pembayaran sebesar
  <strong>Rp150.000</strong> dapat dialokasikan ke dua tagihan yang berbeda
  melalui data pada <strong>detail_pembayaran</strong>.
</p>

<h2>📉 Pengeluaran Kas</h2>

<p>
  <strong>Pengeluaran</strong> digunakan untuk mencatat seluruh arus kas keluar
  yang dilakukan oleh pengurus RT atau pengelola perumahan.
</p>

<p>
  Setiap pengeluaran dikelompokkan menggunakan
  <strong>kategori_pengeluaran</strong> agar pencatatan keuangan lebih terstruktur.
</p>

<p>Contoh kategori pengeluaran:</p>

<ul>
  <li>Pemeliharaan Fasilitas</li>
  <li>Operasional Satpam</li>
  <li>Kebersihan Lingkungan</li>
  <li>Perbaikan Infrastruktur</li>
</ul>

<p>
  Sistem pengeluaran dipisahkan dari sistem tagihan karena memiliki tujuan yang
  berbeda:
</p>

<ul>
  <li><strong>Tagihan & Pembayaran</strong> → Mencatat pemasukan dari warga.</li>
  <li><strong>Pengeluaran</strong> → Mencatat biaya operasional dan penggunaan kas RT.</li>
</ul>

## 📁 Struktur Proyek

```
rt-management-app/
│
├── README.md                   ← Kamu di sini
├── FEATURES.md                 ← Demo GIF semua fitur
├── component-diagram.png
│
├── backend/                    ← Laravel API
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/    ← Terima request, panggil Service, kembalikan JSON
│   │   │   ├── Requests/       ← Validasi input dari user
│   │   │   └── Resources/      ← Format response JSON sebelum dikirim ke frontend
│   │   ├── Models/             ← Eloquent ORM & relasi antar tabel
│   │   └── Services/           ← Business logic kompleks (kalkulasi tagihan, laporan)
│   ├── database/
│   │   ├── migrations/         ← Skema tabel database
│   │   └── seeders/            ← Data awal / dummy
│   ├── routes/                 ← Definisi endpoint API
│   └── storage/app/public/     ← File upload dari frontend
│
└── frontend/                   ← React + Vite
    └── src/
        ├── assets/             ← Gambar, ikon, font statis
        ├── components/         ← UI components global (Button, Modal, dll)
        ├── features/           ← Fitur dikelompokkan per domain
        │   ├── auth/           ← api/, components/, hooks/, routes/, types/
        │   ├── penghuni/
        │   ├── rumah/
        │   ├── pembayaran/
        │   └── ...
        ├── layouts/            ← Komponen layout
        ├── lib/                ← Konfigurasi library shared
        ├── pages/              ← Gerbang masuk page
        ├── routes/             ← React Router (createBrowserRouter)
        ├── store/              ← Zustand client-state
        ├── App.tsx             ← Root component (QueryClientProvider, RouterProvider)
        └── main.tsx            ← Vite entry point
```

---

## 🚀 Instalasi

### Persyaratan Sistem

| Software | Versi Minimum |
|----------|---------------|
| PHP | 8.2 |
| Composer | Latest |
| Node.js | 20.x |
| npm | 10.x |
| MySQL | 8.x |
| Git | Latest |

```bash
# Cek versi yang terinstall
php -v && composer -V && node -v && npm -v && mysql --version
```

### 1. Clone Repository

```bash
git clone <repository-url>
cd rt-management-app
```

### 2. Setup Backend (Laravel)

```bash
cd backend

# Install dependencies
composer install

# Buat file environment
cp .env.example .env          # Linux/macOS
copy .env.example .env        # Windows

# Generate application key
php artisan key:generate
```

**Konfigurasi `.env`:**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rt_administration
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
SANCTUM_STATEFUL_DOMAINS=localhost:5173,127.0.0.1:5173
CORS_ALLOWED_ORIGINS=http://localhost:5173,http://127.0.0.1:5173
```

```bash
# Jalankan migration + seeder
php artisan migrate:fresh --seed

# Buat storage link (untuk upload file)
php artisan storage:link

# Jalankan server
php artisan serve
# → http://127.0.0.1:8000
```

### 3. Setup Frontend (React)

```bash
cd frontend

# Install dependencies
npm install

# Buat file environment
echo "VITE_API_URL=http://localhost:8000/api/v1" > .env

# Jalankan dev server
npm run dev
# → http://localhost:5173
```

> **⚠️ Penting:** Gunakan `localhost` (bukan `127.0.0.1`) untuk keduanya agar cookie Laravel Sanctum terbaca dengan benar.

---

## 🔑 Akun Default

Setelah menjalankan seeder:

| Role | Email | Password |
|------|-------|----------|
| Admin | test@example.com | password |

---

## 📦 Build Production

**Backend:**
```bash
php artisan optimize   # cache config, route, view
```

**Frontend:**
```bash
npm run build
# Output: frontend/dist/
```

---

## 🔧 Troubleshooting

<details>
<summary><b>Composer install gagal</b></summary>

```bash
composer self-update
composer clear-cache
composer install
```
</details>

<details>
<summary><b>Error APP_KEY missing</b></summary>

```bash
php artisan key:generate
```
</details>

<details>
<summary><b>Error storage:link</b></summary>

```bash
php artisan storage:unlink
php artisan storage:link
```
</details>

<details>
<summary><b>Frontend tidak bisa terhubung ke API</b></summary>

Pastikan `VITE_API_URL` di `.env` frontend mengarah ke hostname yang sama dengan backend:
```env
VITE_API_URL=http://localhost:8000/api/v1
```
</details>

<details>
<summary><b>Error migration</b></summary>

```bash
php artisan migrate:fresh --seed
```
</details>

---

## 📋 Command Referensi

**Laravel:**
```bash
php artisan serve
php artisan migrate:fresh --seed
php artisan storage:link
php artisan optimize
php artisan test
```

**React + Vite:**
```bash
npm run dev
npm run build
npm run preview
```

---

<div align="center">

Dibuat dengan ❤️ untuk kemudahan administrasi warga RT

</div>
