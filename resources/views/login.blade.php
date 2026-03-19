<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        @include('partials.navbar')

        <main class="app-page">
            <section class="auth">
                <div class="auth__container">
                    <div class="card border-0 shadow-sm auth__card">
                        <div class="card-body p-4 p-sm-4">
                            <div class="mb-3">
                                <h1 class="h4 fw-bold mb-1">Login</h1>
                                <p class="text-secondary mb-0">
                                    Masuk untuk ikut diskusi dan menyimpan aktivitas Anda.
                                </p>
                            </div>

                            @if (session('status'))
                                <div class="alert alert-info mb-3" role="status">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form action="{{ url('/login') }}" method="POST" class="vstack gap-3">
                                @csrf

                                <div>
                                    <label class="form-label fw-semibold">Email</label>
                                    <input class="form-control form-control-lg" type="email" name="email" placeholder="nama@email.com" required autocomplete="email">
                                </div>

                                <div>
                                    <label class="form-label fw-semibold">Password</label>
                                    <div class="position-relative">
                                        <input
                                            id="loginPasswordInput"
                                            class="form-control form-control-lg auth__password-input"
                                            type="password"
                                            name="password"
                                            placeholder="••••••••"
                                            required
                                            autocomplete="current-password"
                                        >
                                        <button
                                            class="btn btn-sm btn-outline-secondary auth__password-toggle"
                                            type="button"
                                            data-password-toggle="loginPasswordInput"
                                            aria-label="Tampilkan password"
                                        >
                                            Tampilkan
                                        </button>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                </div>

                                <button class="btn btn-primary btn-lg w-100" type="submit">
                                    Masuk
                                </button>

                                <div class="text-center text-secondary">
                                    Belum punya akun?
                                    <a class="link-primary fw-semibold" href="{{ Route::has('register') ? route('register') : url('/register') }}">Sign Up</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        @include('partials.footer')

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const toggleBtn = document.querySelector('[data-password-toggle]');
                if (!toggleBtn) return;

                const targetId = toggleBtn.getAttribute('data-password-toggle');
                const input = document.getElementById(targetId);
                if (!input) return;

                const setShown = (shown) => {
                    input.type = shown ? 'text' : 'password';
                    toggleBtn.textContent = shown ? 'Sembunyikan' : 'Tampilkan';
                    toggleBtn.setAttribute('aria-label', shown ? 'Sembunyikan password' : 'Tampilkan password');
                };

                setShown(false);

                toggleBtn.addEventListener('click', () => {
                    setShown(input.type === 'password');
                });
            });
        </script>
    </body>
</html>

