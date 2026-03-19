<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Search</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        @include('partials.navbar')

        <main class="app-page">
            <div class="laracuss-container page-shell">
                <div class="page-card">
                    <h1 class="page-title">Hasil Pencarian</h1>
                    <p class="page-subtitle">
                        Kata kunci: <strong>{{ $q }}</strong>
                    </p>
                    <p class="page-subtitle" style="margin-top: 12px;">
                        Halaman ini masih placeholder. Nanti bisa Anda sambungkan ke controller/search logic Anda.
                    </p>
                </div>
            </div>
        </main>

        @include('partials.footer')
    </body>
</html>

