<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register</title>
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
                                <h1 class="h4 fw-bold mb-1">Sign Up</h1>
                                <p class="text-secondary mb-0">
                                    Buat akun untuk mulai diskusi dan ikut berkontribusi.
                                </p>
                            </div>

                            @if (session('status'))
                                <div class="alert alert-info mb-3" role="status">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form action="{{ url('/register') }}" method="POST" class="vstack gap-3">
                                @csrf

                                <div>
                                    <label class="form-label fw-semibold">Nama</label>
                                    <input class="form-control form-control-lg" type="text" name="name" placeholder="Nama lengkap" required autocomplete="name">
                                </div>

                                <div>
                                    <label class="form-label fw-semibold">Email</label>
                                    <input class="form-control form-control-lg" type="email" name="email" placeholder="nama@email.com" required autocomplete="email">
                                </div>

                                <div>
                                    <label class="form-label fw-semibold">Password</label>
                                    <div class="position-relative">
                                        <input
                                            id="registerPasswordInput"
                                            class="form-control form-control-lg auth__password-input"
                                            type="password"
                                            name="password"
                                            placeholder="••••••••"
                                            required
                                            autocomplete="new-password"
                                        >
                                        <button
                                            class="btn btn-sm btn-outline-secondary auth__password-toggle"
                                            type="button"
                                            data-password-toggle="registerPasswordInput"
                                            aria-label="Tampilkan password"
                                        >
                                            Tampilkan
                                        </button>
                                    </div>
                                </div>

                                <div>
                                    <label class="form-label fw-semibold">Konfirmasi Password</label>
                                    <div class="position-relative">
                                        <input
                                            id="registerPasswordConfirmationInput"
                                            class="form-control form-control-lg auth__password-input"
                                            type="password"
                                            name="password_confirmation"
                                            placeholder="••••••••"
                                            required
                                            autocomplete="new-password"
                                        >
                                        <button
                                            class="btn btn-sm btn-outline-secondary auth__password-toggle"
                                            type="button"
                                            data-password-toggle="registerPasswordConfirmationInput"
                                            aria-label="Tampilkan password"
                                        >
                                            Tampilkan
                                        </button>
                                    </div>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="terms" id="termsCheckbox" required>
                                    <label class="form-check-label" for="termsCheckbox">
                                        Saya setuju dengan syarat & ketentuan.
                                    </label>
                                </div>

                                <button class="btn btn-primary btn-lg w-100" type="submit">
                                    Daftar
                                </button>

                                <div class="text-center text-secondary">
                                    Sudah punya akun?
                                    <a class="link-primary fw-semibold" href="{{ Route::has('login') ? route('login') : url('/login') }}">Login</a>
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
                const toggleButtons = document.querySelectorAll('[data-password-toggle]');
                if (!toggleButtons || toggleButtons.length === 0) return;

                toggleButtons.forEach((btn) => {
                    const targetId = btn.getAttribute('data-password-toggle');
                    const input = document.getElementById(targetId);
                    if (!input) return;

                    const setShown = (shown) => {
                        input.type = shown ? 'text' : 'password';
                        btn.textContent = shown ? 'Sembunyikan' : 'Tampilkan';
                        btn.setAttribute('aria-label', shown ? 'Sembunyikan password' : 'Tampilkan password');
                    };

                    setShown(false);

                    btn.addEventListener('click', () => {
                        setShown(input.type === 'password');
                    });
                });
            });
        </script>
    </body>
</html>

