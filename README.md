# Laracuss

Laracuss adalah prototype platform diskusi seputar coding yang dibangun dengan Laravel, Blade, SCSS, dan Bootstrap.

Saat ini project sudah memiliki auth dasar berbasis Laravel Breeze, struktur database awal, serta UI diskusi/profil yang siap dilanjutkan ke backend penuh.

## Fitur Utama

- Home page modern dengan hero, stats, help other, CTA, navbar, dan footer reusable.
- Halaman diskusi:
  - list thread diskusi,
  - detail thread,
  - UI like jawaban,
  - share thread (Web Share API + fallback copy link),
  - edit jawaban (state tersimpan di `localStorage`).
- Halaman create dan edit diskusi (UI placeholder).
- Halaman profil user:
  - daftar pertanyaan dan jawaban user,
  - share profil,
  - edit profil (display name, bio, lokasi, foto, ganti password).
- Authentication:
  - login, register, logout (Laravel Breeze),
  - middleware `auth`/`guest`,
  - authorization edit profil (hanya pemilik akun),
  - avatar user di navbar + dropdown menu (Profile/Edit Profile/Logout).
- Halaman About Us dan Search.

## Tech Stack

- Laravel 10
- Blade Template
- Bootstrap (SCSS + JS via Vite)
- JavaScript (vanilla)
- Laravel Breeze (auth scaffolding)

## Status Project Saat Ini

- Ini masih prototype dengan fokus frontend + backend dasar.
- Fitur auth sudah aktif (Breeze), tetapi modul diskusi masih banyak yang dummy data.
- Beberapa interaksi UI memakai:
  - `localStorage` (contoh: like reply, edit reply),
  - kombinasi `session` dan database untuk data profil.

## Struktur Halaman

Route utama yang sudah tersedia:

- `/` atau `/home` - Home
- `/discussion` - List diskusi
- `/discussion/{id}` - Detail diskusi
- `/discussion/create` - Create diskusi (auth required, UI placeholder)
- `/discussion/{id}/edit` - Edit diskusi (auth required, UI placeholder)
- `/profile/{name?}` - Profil user
- `/profile/{name?}/edit` - Edit profil (auth + owner only)
- `/about-us` - About Us
- `/search` - Search
- `/login` - Login
- `/register` - Register
- `/logout` - Logout (POST)

## Cara Menjalankan Project

Pastikan sudah terpasang:

- PHP >= 8.1
- Composer
- Node.js + npm

Langkah setup:

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

Jalankan development server:

```bash
php artisan serve
npm run dev
```

Build asset production:

```bash
npm run build
```

## Catatan

- Upload foto profil disimpan ke `public/uploads/profile`.
- Favicon project saat ini menggunakan `public/favicon.png`.
- Seeder membuat akun demo login:
  - email: `demo@laracuss.test`
  - password: `password123`
- Data diskusi/profil masih campuran dummy + backend awal (akan dimigrasikan penuh bertahap).

## Rencana Pengembangan Berikutnya

- Migrasi penuh fitur diskusi ke database (`discussions`, `answers`, relasi kategori/user).
- Integrasi like/bookmark/reply dari `localStorage` ke database.
- Refactor route closure ke controller + request class untuk maintainability.
- Penguatan test end-to-end untuk flow auth, profile, dan diskusi.

## Lisensi

Project ini menggunakan lisensi MIT.
