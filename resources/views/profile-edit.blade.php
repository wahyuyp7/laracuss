<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit Profil {{ $userName ?? '' }}</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        @include('partials.navbar')

        <main class="app-page">
            <div class="laracuss-container page-shell">
                <div class="d-flex flex-column gap-3 mb-4">
                    <div class="page-card">
                        <h1 class="page-title mb-0">Edit Profil</h1>
                        <p class="page-subtitle mb-0">Perbarui informasi profil kamu.</p>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            @if ($errors->any())
                                <div class="alert alert-danger mb-3">
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ url('/profile/' . ($userName ?? 'Rafi') . '/edit') }}" class="vstack gap-3" enctype="multipart/form-data">
                                @csrf

                                <div>
                                    <label class="form-label fw-semibold">Nama Tampilan</label>
                                    <input
                                        type="text"
                                        name="displayName"
                                        class="form-control"
                                        value="{{ old('displayName', $profileData['displayName'] ?? $userName) }}"
                                        maxlength="60"
                                        required
                                    >
                                </div>

                                <div>
                                    <label class="form-label fw-semibold">Bio</label>
                                    <textarea
                                        name="bio"
                                        class="form-control"
                                        rows="4"
                                        maxlength="280"
                                        placeholder="Tulis bio singkat kamu..."
                                    >{{ old('bio', $profileData['bio'] ?? '') }}</textarea>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Lokasi</label>
                                        <input
                                            type="text"
                                            name="location"
                                            class="form-control"
                                            value="{{ old('location', $profileData['location'] ?? '') }}"
                                            maxlength="80"
                                            placeholder="Contoh: Jakarta, Indonesia"
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Foto Profil</label>
                                        <input
                                            type="file"
                                            name="photo"
                                            class="form-control"
                                            accept=".jpg,.jpeg,.png,.webp,image/png,image/jpeg,image/webp"
                                        >
                                        <div class="text-secondary small mt-1">Maks 2MB (JPG, PNG, WEBP).</div>
                                    </div>
                                </div>

                                <hr class="my-1">

                                <div>
                                    <h2 class="h6 fw-bold mb-2">Ubah Password</h2>
                                    <div class="text-secondary small mb-2">
                                        Isi bagian ini jika ingin mengubah password.
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Password Saat Ini</label>
                                        <input
                                            type="password"
                                            name="current_password"
                                            class="form-control"
                                            autocomplete="current-password"
                                            placeholder="Masukkan password saat ini"
                                        >
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Password Baru</label>
                                        <input
                                            type="password"
                                            name="new_password"
                                            class="form-control"
                                            autocomplete="new-password"
                                            placeholder="Minimal 8 karakter"
                                        >
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                                        <input
                                            type="password"
                                            name="new_password_confirmation"
                                            class="form-control"
                                            autocomplete="new-password"
                                            placeholder="Ulangi password baru"
                                        >
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2 pt-2">
                                    <a class="btn btn-outline-secondary" href="{{ url('/profile/' . ($userName ?? 'Rafi')) }}">Batal</a>
                                    <button type="submit" class="btn btn-primary">Simpan Profil</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('partials.footer')
    </body>
</html>

