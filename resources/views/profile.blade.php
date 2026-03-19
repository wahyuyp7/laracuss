<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profil {{ $userName ?? '' }}</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        @include('partials.navbar')

        <main class="app-page">
            <div class="laracuss-container page-shell">
                <div class="d-flex flex-column gap-3 mb-4">
                    <div class="page-card">
                        <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
                            <div>
                                <h1 class="page-title mb-0">Profil {{ $userName }}</h1>
                                <p class="page-subtitle mb-0">
                                    Daftar pertanyaan dan jawaban yang pernah dipublish.
                                </p>
                            </div>

                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <a
                                    class="btn btn-primary btn-sm d-flex align-items-center gap-2"
                                    href="{{ url('/profile/' . ($userName ?? 'Rafi') . '/edit') }}"
                                >
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M12 20h9"/>
                                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/>
                                    </svg>
                                    <span>Edit Profil</span>
                                </a>

                                <div class="dropdown">
                                    <button
                                        class="btn btn-outline-secondary btn-sm dropdown-toggle d-flex align-items-center gap-2"
                                        type="button"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                    >
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <circle cx="18" cy="5" r="3"/>
                                            <circle cx="6" cy="12" r="3"/>
                                            <circle cx="18" cy="19" r="3"/>
                                            <line x1="8.59" y1="13.51" x2="15.41" y2="17.49"/>
                                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
                                        </svg>
                                        <span class="profile-action-label">Share</span>
                                    </button>

                                    <ul class="dropdown-menu shadow-sm">
                                    <li>
                                        <button
                                            class="dropdown-item profile-share-btn"
                                            type="button"
                                            data-share-title="Profil {{ $userName }}"
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
                                                <span class="profile-action-label">Bagikan</span>
                                            </span>
                                        </button>
                                    </li>

                                    <li>
                                        <button
                                            class="dropdown-item profile-copy-link-btn"
                                            type="button"
                                            data-copy-url="{{ request()->fullUrl() }}"
                                        >
                                            <span class="d-inline-flex align-items-center gap-2">
                                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <path d="M10 13a5 5 0 0 0 7.07 0l1.41-1.41a5 5 0 0 0-7.07-7.07L10 4"/>
                                                    <path d="M14 11a5 5 0 0 0-7.07 0l-1.41 1.41a5 5 0 0 0 7.07 7.07L14 20"/>
                                                </svg>
                                                <span class="profile-action-label">Copy Link</span>
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
                            @if (session('status'))
                                <div class="alert alert-info mb-3">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                @if (!empty($profileData['photo']))
                                    <img
                                        src="{{ asset($profileData['photo']) }}"
                                        alt="Foto profil {{ $profileData['displayName'] ?? $userName }}"
                                        class="rounded-circle border"
                                        style="width: 56px; height: 56px; object-fit: cover;"
                                    >
                                @else
                                    <div class="rounded-circle bg-primary-subtle border d-flex align-items-center justify-content-center"
                                        style="width: 56px; height: 56px;"
                                        aria-hidden="true"
                                    >
                                        <span class="fw-bold text-primary">
                                            {{ strtoupper(substr($profileData['displayName'] ?? $userName ?? 'U', 0, 1)) }}
                                        </span>
                                    </div>
                                @endif

                                <div class="d-flex flex-column">
                                    <div class="fw-bold fs-5">{{ $profileData['displayName'] ?? $userName }}</div>
                                    <div class="text-secondary">
                                        {{ count($questions ?? []) }} pertanyaan • {{ count($answers ?? []) }} jawaban
                                    </div>
                                    @if (!empty($profileData['location']))
                                        <div class="text-secondary small">{{ $profileData['location'] }}</div>
                                    @endif
                                </div>
                            </div>

                            @if (!empty($profileData['bio']))
                                <hr class="my-3">
                                @if (!empty($profileData['bio']))
                                    <p class="text-secondary mb-2">{{ $profileData['bio'] }}</p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h2 class="h6 fw-bold mb-3">Pertanyaan</h2>

                                @if (!empty($questions))
                                    <div class="vstack gap-3">
                                        @foreach ($questions as $question)
                                            <div class="border rounded-3 p-3">
                                                <div class="d-flex align-items-start justify-content-between gap-3">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex flex-wrap gap-2 mb-2">
                                                            @foreach (($question['tags'] ?? []) as $tag)
                                                                <span class="badge text-bg-primary">{{ $tag }}</span>
                                                            @endforeach
                                                        </div>

                                                        <div class="fw-bold mb-1">
                                                            {{ $question['title'] ?? 'Untitled' }}
                                                        </div>

                                                        <div class="text-secondary small">
                                                            {{ $question['postedAgo'] ?? '' }}
                                                        </div>
                                                    </div>

                                                    <a
                                                        class="btn btn-outline-primary btn-sm flex-shrink-0"
                                                        href="{{ url('/discussion/' . ($question['id'] ?? 1)) }}"
                                                    >
                                                        Buka Thread
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-secondary">
                                        Belum ada pertanyaan yang dipublish.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4">
                                <h2 class="h6 fw-bold mb-3">Jawaban</h2>

                                @if (!empty($answers))
                                    <div class="vstack gap-3">
                                        @foreach ($answers as $item)
                                            @php
                                                $thread = $item['thread'] ?? [];
                                                $reply = $item['reply'] ?? [];
                                            @endphp

                                            <div class="border rounded-3 p-3">
                                                <div class="d-flex align-items-start justify-content-between gap-3">
                                                    <div class="flex-grow-1">
                                                        <div class="text-secondary small mb-1">
                                                            Replied on:
                                                            <span class="fw-semibold text-secondary">
                                                                {{ $thread['title'] ?? '-' }}
                                                            </span>
                                                        </div>

                                                        <div class="fw-bold mb-1">
                                                            {{ $reply['message'] ? \Illuminate\Support\Str::limit($reply['message'], 90) : '-' }}
                                                        </div>

                                                        <div class="text-secondary small">
                                                            {{ $reply['ago'] ?? '' }}
                                                        </div>
                                                    </div>

                                                    <a
                                                        class="btn btn-outline-secondary btn-sm flex-shrink-0"
                                                        href="{{ url('/discussion/' . ($thread['id'] ?? 1)) }}"
                                                    >
                                                        Lihat
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-secondary">
                                        Belum ada jawaban yang dipublish.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('partials.footer')
    </body>
</html>

