<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laracuss</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        @include('partials.navbar')

        <main class="app-page">
            <section class="hero">
                <div class="hero__container">
                    <div class="hero__content">
                        <h1 class="hero__title">
                            Laracuss tempat diskusi dan berbagi ide
                        </h1>

                        <p class="hero__subtitle">
                            Buat topik, ikut berdiskusi, dan cari informasi dengan cepat.
                            Mulai dari sini.
                        </p>

                        <div class="hero__actions">
                            <a class="btn btn-outline-primary" href="{{ Route::has('register') ? route('register') : url('/register') }}">
                                Sign Up
                            </a>
                            <a class="btn btn-primary" href="{{ url('/discussion') }}">
                                Join Discussion
                            </a>
                        </div>
                    </div>

                    <div class="hero__media" aria-hidden="true">
                        <img
                            class="hero__image"
                            src="{{ asset('assets/images/brooke-cagle-g1Kr4Ozfoac-unsplash.jpg') }}"
                            alt="Ilustrasi diskusi"
                        >
                    </div>
                </div>
            </section>

            <section class="stats">
                <div class="stats__container">
                    <div class="stat-card">
                            <div class="stat-card__icon" aria-hidden="true">
                                <!-- Icon diskusi (chat bubble) -->
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15a4 4 0 0 1-4 4H7l-4 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z" />
                                    <path d="M8 10h8" />
                                    <path d="M8 14h5" />
                                </svg>
                            </div>
                        <div class="stat-card__value">128</div>
                        <div class="stat-card__label">Diskusi berlangsung</div>
                    </div>
                    <div class="stat-card">
                            <div class="stat-card__icon" aria-hidden="true">
                                <!-- Icon jawaban (check + chat) -->
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15a4 4 0 0 1-4 4H7l-4 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z" />
                                    <path d="M8 12l2 2 5-5" />
                                </svg>
                            </div>
                        <div class="stat-card__value">2.456</div>
                        <div class="stat-card__label">Jawaban</div>
                    </div>
                    <div class="stat-card">
                            <div class="stat-card__icon" aria-hidden="true">
                                <!-- Icon user (silhouette) -->
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21a8 8 0 0 0-16 0" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                            </div>
                        <div class="stat-card__value">512</div>
                        <div class="stat-card__label">User aktif</div>
                    </div>
                </div>
            </section>

            <section class="helpother">
                <div class="helpother__container">
                    <div class="helpother__header">
                        Help Other
                    </div>

                    <div class="helpother__grid">
                        <div class="helpother-card">
                            <div class="helpother-card__top">
                                <div class="helpother-user">
                                    <div class="helpother-user__avatar" aria-hidden="true">R</div>
                                    <div class="helpother-user__meta">
                                        <div class="helpother-user__name">Rafi</div>
                                        <div class="helpother-user__time">2 jam lalu</div>
                                    </div>
                                </div>
                            </div>
                            <div class="helpother-card__question">Kenapa Laravel error “Class not found” saat saya panggil controller?</div>
                            <p class="helpother-card__desc">
                                Saya baru bikin controller baru, tapi waktu akses route (mis. `Route::get('/x', [XController::class, ...])`) muncul error “Class not found”.
                                Sudah coba `composer dump-autoload`, tapi masih sama. Struktur folder controller dan nama class-nya terasa sudah benar.
                            </p>
                            <a class="helpother-card__link" href="{{ url('/discussion') }}">Jawab sekarang</a>
                        </div>

                        <div class="helpother-card">
                            <div class="helpother-card__top">
                                <div class="helpother-user">
                                    <div class="helpother-user__avatar" aria-hidden="true">S</div>
                                    <div class="helpother-user__meta">
                                        <div class="helpother-user__name">Siti</div>
                                        <div class="helpother-user__time">5 jam lalu</div>
                                    </div>
                                </div>
                            </div>
                            <div class="helpother-card__question">Bagaimana debugging JavaScript kalau fungsi tidak jalan di browser?</div>
                            <p class="helpother-card__desc">
                                Tombol/aksi di halaman tidak memanggil fungsi yang saya buat. Tidak ada error yang kelihatan, tapi kliknya seperti tidak terjadi apa-apa.
                                Saya pakai Vite, script di-import dari `resources/js`, dan event handler dipasang setelah halaman render.
                            </p>
                            <a class="helpother-card__link" href="{{ url('/discussion') }}">Jawab sekarang</a>
                        </div>

                        <div class="helpother-card">
                            <div class="helpother-card__top">
                                <div class="helpother-user">
                                    <div class="helpother-user__avatar" aria-hidden="true">B</div>
                                    <div class="helpother-user__meta">
                                        <div class="helpother-user__name">Bima</div>
                                        <div class="helpother-user__time">1 hari lalu</div>
                                    </div>
                                </div>
                            </div>
                            <div class="helpother-card__question">Cara rapikan struktur Blade & SCSS biar scalable?</div>
                            <p class="helpother-card__desc">
                                Project mulai membesar: view Blade banyak yang duplikat, dan SCSS makin panjang karena style campur aduk.
                                Saya ingin struktur yang enak untuk tim: ada layout/partials yang jelas, dan style per halaman/komponen yang mudah dicari dan dipakai ulang.
                            </p>
                            <a class="helpother-card__link" href="{{ url('/discussion') }}">Jawab sekarang</a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="cta">
                <div class="cta__container">
                    <div class="cta__inner">
                        <div class="cta__content">
                            <h2 class="cta__title">Siap mulai diskusi bareng?</h2>
                            <p class="cta__subtitle">
                                Buat pertanyaan, bantu jawab, dan kembangkan skill bareng komunitas.
                                Mulai dari topik kecil sampai case yang kompleks.
                            </p>
                        </div>

                        <div class="cta__actions">
                            <a class="btn btn-primary" href="{{ url('/discussion') }}">Join Discussion</a>
                            <a class="btn btn-outline-primary" href="{{ Route::has('register') ? route('register') : url('/register') }}">Sign Up</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        @include('partials.footer')
    </body>
</html>

