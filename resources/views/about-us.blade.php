<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>About Us</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        @include('partials.navbar')

        <main class="app-page">
            <div class="laracuss-container page-shell">
                <div class="d-flex flex-column gap-3">
                    <section class="page-card">
                        <span class="badge text-bg-primary mb-2">Tentang Laracuss</span>
                        <h1 class="page-title mb-2">Apa itu Laracuss?</h1>
                        <p class="page-subtitle mb-0">
                            Laracuss adalah platform komunitas untuk diskusi coding, tempat developer bisa bertanya,
                            menjawab, dan saling belajar seputar Laravel, JavaScript, serta web development.
                        </p>
                    </section>

                    <section class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <p class="text-secondary mb-3">
                                Fokus utama Laracuss adalah membantu developer menyelesaikan masalah nyata lewat diskusi
                                yang terstruktur dan mudah dipahami. Kamu bisa mencari topik, ikut berdiskusi, memberi
                                jawaban, atau memulai thread baru sesuai kebutuhan.
                            </p>
                            <p class="text-secondary mb-0">
                                Singkatnya, Laracuss adalah ruang belajar bersama: lebih dari sekadar tanya jawab, tetapi
                                juga tempat tumbuh bareng komunitas developer.
                            </p>
                        </div>
                    </section>

                    <section class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
                                <div>
                                    <h2 class="h5 fw-bold mb-1">Siap mulai diskusi pertama?</h2>
                                    <p class="text-secondary mb-0">
                                        Jelajahi thread yang ada atau buat akun untuk ikut bertanya dan menjawab.
                                    </p>
                                </div>
                                <div class="d-flex gap-2 flex-wrap">
                                    <a class="btn btn-outline-secondary" href="{{ url('/discussion') }}">Lihat Discussion</a>
                                    <a class="btn btn-primary" href="{{ url('/register') }}">Gabung Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>

        @include('partials.footer')
    </body>
</html>

