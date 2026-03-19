<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit Discussion</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        @include('partials.navbar')

        <main class="app-page">
            <div class="laracuss-container page-shell">
                <div class="d-flex flex-column gap-3 mb-4">
                    <div class="page-card">
                        <h1 class="page-title">Edit Diskusi</h1>
                        <p class="page-subtitle">Perbarui judul, tags, dan konten diskusi.</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-info mb-0">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            @php
                                $threadId = (int)($thread['id'] ?? 1);
                                $tagsArray = $thread['tags'] ?? [];
                                $tagsValue = is_array($tagsArray) ? implode(', ', $tagsArray) : (string)$tagsArray;
                                $contentValue = '';
                                if (isset($thread['content']) && is_array($thread['content'])) {
                                    $contentValue = implode("\n\n", $thread['content']);
                                } else {
                                    $contentValue = (string)($thread['content'] ?? '');
                                }
                                $categoryDefault = $tagsArray[0] ?? 'Laravel';
                            @endphp

                            <form method="POST" action="{{ url('/discussion/' . $threadId . '/edit') }}" class="vstack gap-3">
                                @csrf

                                <div>
                                    <label class="form-label fw-semibold">Judul</label>
                                    <input
                                        name="title"
                                        class="form-control"
                                        type="text"
                                        placeholder="Tulis judul topik..."
                                        value="{{ old('title', $thread['title'] ?? '') }}"
                                        required
                                    >
                                </div>

                                <div>
                                    <label class="form-label fw-semibold">Kategori</label>
                                    <select name="category" class="form-select" required>
                                        <option value="" selected disabled>Pilih kategori...</option>
                                        <option value="Laravel" {{ old('category', $categoryDefault) === 'Laravel' ? 'selected' : '' }}>Laravel</option>
                                        <option value="JavaScript" {{ old('category', $categoryDefault) === 'JavaScript' ? 'selected' : '' }}>JavaScript</option>
                                        <option value="CSS/SCSS" {{ old('category', $categoryDefault) === 'CSS/SCSS' ? 'selected' : '' }}>CSS/SCSS</option>
                                        <option value="Architecture" {{ old('category', $categoryDefault) === 'Architecture' ? 'selected' : '' }}>Architecture</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="form-label fw-semibold">Tags (pisahkan pakai koma)</label>
                                    <input
                                        name="tags"
                                        class="form-control"
                                        type="text"
                                        placeholder="contoh: Laravel, Controller"
                                        value="{{ old('tags', $tagsValue) }}"
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
                                    >{{ old('content', $contentValue) }}</textarea>
                                    <div class="text-secondary small mt-2">
                                        Tip: baris kosong bisa dipakai untuk memisahkan paragraf.
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2 pt-2">
                                    <a class="btn btn-outline-secondary" href="{{ url('/discussion/' . $threadId) }}">Batal</a>
                                    <button class="btn btn-primary" type="submit">
                                        Simpan Perubahan (placeholder)
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

