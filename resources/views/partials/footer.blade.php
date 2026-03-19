<footer class="app-footer" role="contentinfo">
    <div class="app-footer__container">
        <div class="app-footer__top">
            <div class="app-footer__brand">
                <a class="app-footer__logo" href="{{ url('/') }}">Laracuss</a>
                <p class="app-footer__tagline">
                    Tempat diskusi, berbagi ide, dan tumbuh bareng komunitas.
                </p>
            </div>

            <div class="app-footer__cols" aria-label="Footer links">
                <div class="app-footer__col">
                    <div class="app-footer__title">Menu</div>
                    <a class="app-footer__link" href="{{ url('/') }}">Home</a>
                    <a class="app-footer__link" href="{{ url('/discussion') }}">Discussion</a>
                    <a class="app-footer__link" href="{{ url('/about-us') }}">About Us</a>
                </div>

                <div class="app-footer__col">
                    <div class="app-footer__title">Akun</div>
                    @auth
                        <a class="app-footer__link" href="{{ url('/') }}">Dashboard</a>
                    @else
                        <a class="app-footer__link" href="{{ Route::has('login') ? route('login') : url('/login') }}">Login</a>
                        <a class="app-footer__link" href="{{ Route::has('register') ? route('register') : url('/register') }}">Sign Up</a>
                    @endauth
                </div>

                <div class="app-footer__col">
                    <div class="app-footer__title">Cari</div>
                    <form class="app-footer__search" action="{{ url('/search') }}" method="GET" role="search">
                        <input class="app-footer__searchInput" type="search" name="q" placeholder="Cari topik..." aria-label="Cari topik">
                        <button class="app-footer__searchBtn" type="submit">Cari</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="app-footer__bottom">
            <div class="app-footer__copy">
                © {{ date('Y') }} Laracuss. All rights reserved.
            </div>
        </div>
    </div>
</footer>

