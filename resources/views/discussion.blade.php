<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Discussion</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        @include('partials.navbar')

        <main class="app-page">
            <div class="laracuss-container page-shell">
                @if (isset($thread) && ($isDetail ?? false))
                    <div class="d-flex flex-column gap-3 mb-4">
                        <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
                            <div class="flex-grow-1">
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    @foreach (($thread['tags'] ?? []) as $tag)
                                        <span class="badge text-bg-primary">{{ $tag }}</span>
                                    @endforeach
                                </div>

                                <h1 class="page-title mb-0">{{ $thread['title'] ?? 'Discussion Detail' }}</h1>

                                <div class="text-secondary mt-2">
                                    <span class="fw-semibold">{{ $thread['authorName'] ?? 'Unknown' }}</span>
                                    <span>•</span>
                                    <span>{{ $thread['postedAgo'] ?? '' }}</span>
                                </div>
                            </div>

                            <a class="btn btn-outline-secondary" href="{{ url('/discussion') }}">Kembali</a>
                        </div>

                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    @foreach (($thread['content'] ?? []) as $paragraph)
                                        <p class="text-secondary mb-3">{{ $paragraph }}</p>
                                    @endforeach
                                </div>

                                <div class="d-flex flex-column flex-md-row gap-2 align-items-md-center justify-content-between">
                                    <div class="d-flex flex-wrap gap-2">
                                        <button class="btn btn-outline-primary btn-sm" type="button" disabled>
                                            <span class="d-inline-flex align-items-center gap-2">
                                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                                </svg>
                                                Like
                                            </span>
                                        </button>
                                        <button class="btn btn-outline-secondary btn-sm" type="button" disabled>
                                            <span class="d-inline-flex align-items-center gap-2">
                                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                                                </svg>
                                                Bookmark
                                            </span>
                                        </button>
                                        <button class="btn btn-primary btn-sm" type="button" disabled>
                                            <span class="d-inline-flex align-items-center gap-2">
                                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <path d="M9 14l-4-4 4-4"/>
                                                    <path d="M5 10h9a6 6 0 0 1 0 12h-3"/>
                                                </svg>
                                                Reply
                                            </span>
                                        </button>
                                    </div>

                                    <div class="dropdown">
                                        <button
                                            class="btn btn-outline-secondary btn-sm dropdown-toggle"
                                            type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                        >
                                            <span class="d-inline-flex align-items-center gap-2">
                                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <circle cx="18" cy="5" r="3"/>
                                                    <circle cx="6" cy="12" r="3"/>
                                                    <circle cx="18" cy="19" r="3"/>
                                                    <line x1="8.59" y1="13.51" x2="15.41" y2="17.49"/>
                                                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
                                                </svg>
                                                Share
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu shadow-sm">
                                            <li>
                                                <button
                                                    class="dropdown-item discussion-share-btn"
                                                    type="button"
                                                    data-share-title="{{ $thread['title'] ?? 'Discussion' }}"
                                                    data-share-url="{{ request()->fullUrl() }}"
                                                >
                                                    <span class="d-inline-flex align-items-center gap-2">
                                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                            <circle cx="18" cy="5" r="3"/>
                                                            <circle cx="6" cy="12" r="3"/>
                                                            <circle cx="18" cy="19" r="3"/>
                                                            <line x1="8.59" y1="13.51" x2="15.41" y2="17.49"/>
                                                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
                                                        </svg>
                                                        Bagikan
                                                    </span>
                                                </button>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ url('/discussion/' . ($thread['id'] ?? 1) . '/edit') }}">
                                                    <span class="d-inline-flex align-items-center gap-2">
                                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                            <path d="M12 20h9"/>
                                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/>
                                                        </svg>
                                                        Edit Topik
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <button
                                                    class="dropdown-item discussion-copy-link-btn"
                                                    type="button"
                                                    data-copy-url="{{ request()->fullUrl() }}"
                                                >
                                                    <span class="d-inline-flex align-items-center gap-2">
                                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                            <path d="M10 13a5 5 0 0 0 7.07 0l1.41-1.41a5 5 0 0 0-7.07-7.07L10 4"/>
                                                            <path d="M14 11a5 5 0 0 0-7.07 0l-1.41 1.41a5 5 0 0 0 7.07 7.07L14 20"/>
                                                        </svg>
                                                        Copy Link
                                                    </span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h2 class="h6 fw-bold mb-3">Balasan</h2>

                                @foreach (($thread['replies'] ?? []) as $reply)
                                    <div class="d-flex gap-3 mb-3">
                                        <div class="rounded-circle bg-primary-subtle border d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <span class="fw-bold text-primary">{{ strtoupper(substr($reply['name'] ?? '', 0, 1)) }}</span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center gap-2">
                                                <div class="fw-bold">{{ $reply['name'] ?? 'Anonymous' }}</div>
                                                <div class="text-secondary small">{{ $reply['ago'] ?? '' }}</div>
                                            </div>
                                            @php
                                                $threadId = $thread['id'] ?? 1;
                                                $replyIndex = $loop->index;
                                                $editKey = 'discussion_' . $threadId . '_reply_' . $replyIndex . '_edit';
                                            @endphp

                                            <p
                                                class="text-secondary mb-0 mt-2 discussion-reply-message"
                                                data-message-key="{{ $editKey }}"
                                            >{{ $reply['message'] ?? '' }}</p>

                                            @php
                                                $likeKey = 'discussion_' . ($thread['id'] ?? 1) . '_reply_' . $loop->index;
                                                $initialLikes = (int)($reply['likeCount'] ?? 0);
                                            @endphp

                                            <div class="d-flex align-items-center justify-content-between gap-2 mt-2 flex-wrap">
                                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                                    <button
                                                        class="btn btn-outline-primary btn-sm discussion-reply-like-btn"
                                                        type="button"
                                                        data-like-key="{{ $likeKey }}"
                                                        aria-pressed="false"
                                                    >
                                                        <span class="d-inline-flex align-items-center gap-2">
                                                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                                            </svg>
                                                            Suka
                                                        </span>
                                                    </button>
                                                    <div class="text-secondary small">
                                                        <span
                                                            class="discussion-reply-like-count badge bg-transparent border-0 text-secondary p-0"
                                                            data-like-count-key="{{ $likeKey }}"
                                                            data-initial-count="{{ $initialLikes }}"
                                                        >{{ $initialLikes }}</span>
                                                        <span class="ms-1 d-inline-flex align-items-center gap-1">
                                                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                                                            </svg>
                                                            Suka
                                                        </span>
                                                    </div>
                                                </div>

                                                <button
                                                    type="button"
                                                    class="btn btn-outline-secondary btn-sm discussion-reply-edit-btn"
                                                    data-edit-key="{{ $editKey }}"
                                                >
                                                    <span class="d-inline-flex align-items-center gap-2">
                                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                            <path d="M12 20h9"/>
                                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 18l-4 1 1-4 12.5-11.5z"/>
                                                        </svg>
                                                        Edit
                                                    </span>
                                                </button>
                                            </div>

                                            <div class="discussion-reply-edit-panel mt-2 d-none" data-edit-panel-key="{{ $editKey }}">
                                                <div class="bg-light border rounded-3 p-3">
                                                    <div class="fw-semibold text-secondary d-flex align-items-center gap-2 mb-2">
                                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                            <path d="M12 20h9"/>
                                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 18l-4 1 1-4 12.5-11.5z"/>
                                                        </svg>
                                                        Edit jawaban
                                                    </div>

                                                    <textarea
                                                        class="form-control form-control-sm discussion-reply-edit-textarea"
                                                        rows="4"
                                                        required
                                                    ></textarea>

                                                    <div class="d-flex gap-2 mt-3 justify-content-end flex-nowrap">
                                                        <button type="button" class="btn btn-primary btn-sm discussion-reply-edit-save-btn" data-edit-save-key="{{ $editKey }}">
                                                            Simpan
                                                        </button>
                                                        <button type="button" class="btn btn-outline-secondary btn-sm discussion-reply-edit-cancel-btn" data-edit-cancel-key="{{ $editKey }}">
                                                            Batal
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <hr class="my-4">

                                <form onsubmit="return false;">
                                    <label class="form-label fw-semibold">Tulis balasan</label>
                                    <textarea class="form-control" rows="4" placeholder="Tulis balasan kamu..." required></textarea>
                                    <button class="btn btn-primary w-100 mt-3" type="submit">
                                        Kirim Balasan (placeholder)
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="d-flex flex-column gap-3 mb-4">
                        <div class="page-card">
                            <h1 class="page-title">Discussion</h1>
                            <p class="page-subtitle">
                                Jelajahi topik, lihat thread, dan mulai diskusi baru.
                            </p>
                        </div>

                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="d-flex flex-column gap-3">
                                <div class="card border-0 shadow-sm discussion-thread-card">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center gap-3 flex-wrap">
                                            <div class="rounded-circle bg-primary-subtle border d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                                <span class="fw-bold text-primary">R</span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="fw-semibold">Rafi</div>
                                                <div class="text-secondary small">2 jam lalu • 18 balasan</div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-wrap gap-2 mt-3 mb-2">
                                            <span class="badge text-bg-primary">Laravel</span>
                                            <span class="badge text-bg-light border text-secondary">Help</span>
                                        </div>

                                        <h2 class="h5 mb-2 fw-bold">
                                            Kenapa “Class not found” saat panggil controller?
                                        </h2>
                                        <p class="text-secondary mb-3">
                                            Saya sudah buat controller dan mapping route, tapi saat akses route muncul error “Class not found”.
                                        </p>

                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <a class="btn btn-outline-primary" href="{{ url('/discussion/1') }}">
                                                Lihat Thread
                                            </a>
                                            <button class="btn btn-primary" type="button" disabled>
                                                <span class="d-inline-flex align-items-center gap-2">
                                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                        <path d="M9 14l-4-4 4-4"/>
                                                        <path d="M5 10h9a6 6 0 0 1 0 12h-3"/>
                                                    </svg>
                                                    Reply
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border-0 shadow-sm discussion-thread-card">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center gap-3 flex-wrap">
                                            <div class="rounded-circle bg-primary-subtle border d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                                <span class="fw-bold text-primary">S</span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="fw-semibold">Siti</div>
                                                <div class="text-secondary small">5 jam lalu • 9 balasan</div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-wrap gap-2 mt-3 mb-2">
                                            <span class="badge text-bg-primary">JavaScript</span>
                                            <span class="badge text-bg-light border text-secondary">Debugging</span>
                                        </div>

                                        <h2 class="h5 mb-2 fw-bold">
                                            Event listener tidak jalan walau tidak ada error
                                        </h2>
                                        <p class="text-secondary mb-3">
                                            Aksi di halaman tidak memanggil fungsi yang saya buat. Tidak ada error di console.
                                        </p>

                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <a class="btn btn-outline-primary" href="{{ url('/discussion/2') }}">
                                                Lihat Thread
                                            </a>
                                            <button class="btn btn-primary" type="button" disabled>
                                                <span class="d-inline-flex align-items-center gap-2">
                                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                        <path d="M9 14l-4-4 4-4"/>
                                                        <path d="M5 10h9a6 6 0 0 1 0 12h-3"/>
                                                    </svg>
                                                    Reply
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border-0 shadow-sm discussion-thread-card">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center gap-3 flex-wrap">
                                            <div class="rounded-circle bg-primary-subtle border d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                                <span class="fw-bold text-primary">B</span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="fw-semibold">Bima</div>
                                                <div class="text-secondary small">1 hari lalu • 6 balasan</div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-wrap gap-2 mt-3 mb-2">
                                            <span class="badge text-bg-primary">Architecture</span>
                                            <span class="badge text-bg-light border text-secondary">SCSS/Blade</span>
                                        </div>

                                        <h2 class="h5 mb-2 fw-bold">
                                            Cara rapikan struktur Blade & SCSS agar scalable?
                                        </h2>
                                        <p class="text-secondary mb-3">
                                            View Blade makin banyak duplikat dan SCSS jadi panjang karena style bercampur.
                                        </p>

                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <a class="btn btn-outline-primary" href="{{ url('/discussion/3') }}">
                                                Lihat Thread
                                            </a>
                                            <button class="btn btn-primary" type="button" disabled>
                                                <span class="d-inline-flex align-items-center gap-2">
                                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                        <path d="M9 14l-4-4 4-4"/>
                                                        <path d="M5 10h9a6 6 0 0 1 0 12h-3"/>
                                                    </svg>
                                                    Reply
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="d-flex flex-column gap-3">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h3 class="h6 fw-bold mb-3">Kategori</h3>
                                        <div class="d-flex flex-wrap gap-2">
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ url('/discussion') }}">Laravel</a>
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ url('/discussion') }}">JavaScript</a>
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ url('/discussion') }}">CSS/SCSS</a>
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ url('/discussion') }}">Architecture</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card border-0 shadow-sm">
                                    <div class="card-body p-4">
                                        <h3 class="h6 fw-bold mb-3">Buat Topik Baru</h3>
                                        <p class="text-secondary small mb-3">
                                            Gunakan halaman create untuk isi detail diskusi dengan rapi.
                                        </p>
                                        <a class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2" href="{{ url('/discussion/create') }}">
                                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <path d="M12 5v14"/>
                                                <path d="M5 12h14"/>
                                            </svg>
                                            Buat Diskusi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </main>

        @include('partials.footer')
    </body>
</html>

