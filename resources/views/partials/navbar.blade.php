<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top app-site-navbar" aria-label="Primary">
    <div class="container">
        <a class="navbar-brand fw-bold fs-5" href="{{ url('/') }}">Laracuss</a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#primaryNavbar"
            aria-controls="primaryNavbar"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="primaryNavbar">
            <ul class="navbar-nav mx-lg-auto mb-3 mb-lg-0 gap-lg-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/discussion') }}">Discussion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/profile') }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/about-us') }}">About Us</a>
                </li>
            </ul>

            <div class="d-flex flex-column flex-lg-row gap-2 align-items-stretch align-items-lg-center">
                <form class="d-flex gap-2" action="{{ url('/search') }}" method="GET" role="search">
                    <input class="form-control" type="search" name="q" placeholder="Pencarian..." aria-label="Pencarian">
                    <button class="btn btn-outline-primary" type="submit">Cari</button>
                </form>

                @auth
                    <a class="btn btn-outline-secondary" href="{{ url('/') }}">Dashboard</a>
                @else
                    <a class="btn btn-outline-secondary" href="{{ Route::has('login') ? route('login') : url('/login') }}">Login</a>
                    <a class="btn btn-primary" href="{{ Route::has('register') ? route('register') : url('/register') }}">Sign Up</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

