# Laracuss

Laracuss adalah prototype platform diskusi seputar coding yang dibangun dengan Laravel, Blade, SCSS, dan Bootstrap.

Fokus project saat ini ada di sisi frontend/UI: pengalaman diskusi, halaman profil user, dan alur create/edit konten dengan data dummy.

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
  - edit profil (display name, bio, lokasi, foto, ganti password dummy).
- Halaman login dan register dengan desain konsisten Bootstrap + toggle show/hide password.
- Halaman About Us dan Search.

## Tech Stack

- Laravel 10
- Blade Template
- Bootstrap (SCSS + JS via Vite)
- JavaScript (vanilla)

## Status Project Saat Ini

- Ini masih prototype/frontend-first.
- Fitur auth, create/edit diskusi, dan persistence data masih placeholder.
- Beberapa interaksi UI memakai:
  - `localStorage` (contoh: like reply, edit reply),
  - `session` Laravel (contoh: override data profil dummy).

## Struktur Halaman

Route utama yang sudah tersedia:

- `/` atau `/home` - Home
- `/discussion` - List diskusi
- `/discussion/{id}` - Detail diskusi
- `/discussion/create` - Create diskusi (UI)
- `/discussion/{id}/edit` - Edit diskusi (UI)
- `/profile/{name?}` - Profil user
- `/profile/{name?}/edit` - Edit profil
- `/about-us` - About Us
- `/search` - Search
- `/login` - Login (UI)
- `/register` - Register (UI)

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
- Karena ini prototype, data belum terhubung ke database untuk fitur diskusi/profil secara penuh.

## Rencana Pengembangan Berikutnya

- Integrasi autentikasi Laravel (Breeze/Fortify/Sanctum).
- Migrasi dari dummy data ke database (thread, reply, like, bookmark, profile).
- Validasi dan authorization berbasis user login.
- Unit/feature test untuk route dan flow diskusi.

## Lisensi

Project ini menggunakan lisensi MIT.
