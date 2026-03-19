<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Buat Discussion</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        @include('partials.navbar')

        <main class="app-page">
            <div class="laracuss-container page-shell">
                <div class="d-flex flex-column gap-3 mb-4">
                    <div class="page-card">
                        <h1 class="page-title">Buat Diskusi Baru</h1>
                        <p class="page-subtitle">Tulis judul, pilih kategori, lalu jelaskan pertanyaan atau ide kamu.</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-info mb-0">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <form method="POST" action="{{ url('/discussion/create') }}" class="vstack gap-3">
                                @csrf

                                <div>
                                    <label class="form-label fw-semibold">Judul</label>
                                    <input
                                        name="title"
                                        class="form-control"
                                        type="text"
                                        placeholder="Tulis judul topik..."
                                        value="{{ old('title') }}"
                                        required
                                    >
                                </div>

                                <div>
                                    <label class="form-label fw-semibold">Kategori</label>
                                    <select name="category" class="form-select" required>
                                        <option value="" selected disabled>Pilih kategori...</option>
                                        <option value="Laravel" {{ old('category') === 'Laravel' ? 'selected' : '' }}>Laravel</option>
                                        <option value="JavaScript" {{ old('category') === 'JavaScript' ? 'selected' : '' }}>JavaScript</option>
                                        <option value="CSS/SCSS" {{ old('category') === 'CSS/SCSS' ? 'selected' : '' }}>CSS/SCSS</option>
                                        <option value="Architecture" {{ old('category') === 'Architecture' ? 'selected' : '' }}>Architecture</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="form-label fw-semibold">Tags (pisahkan pakai koma)</label>
                                    <input
                                        name="tags"
                                        class="form-control"
                                        type="text"
                                        placeholder="contoh: Laravel, Controller"
                                        value="{{ old('tags') }}"
                                    >
                                </div>

                                <div>
                                    <label class="form-label fw-semibold">Deskripsi / Konten</label>
                                    <textarea
                                        name="content"
                                        class="form-control"
                                        rows="6"
                                        placeholder="Ceritakan masalah/ide kamu..."
                                        required
                                    >{{ old('content') }}</textarea>
                                    <div class="text-secondary small mt-2">
                                        Tip: baris kosong bisa dipakai untuk memisahkan paragraf.
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2 pt-2">
                                    <a class="btn btn-outline-secondary" href="{{ url('/discussion') }}">Batal</a>
                                    <button class="btn btn-primary" type="submit">
                                        Buat Diskusi (placeholder)
                                    </button>
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

