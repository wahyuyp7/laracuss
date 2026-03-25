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
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/profile') }}">Profile</a>
                    </li>
                @endauth
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
                    @php
                        $authUsername = Auth::user()->username ?? '';
                        $sessionPhoto = session('profile_overrides.' . $authUsername . '.photo');
                        $dbPhoto = Auth::user()->picture ?? '';
                        $navPhoto = $sessionPhoto ?: $dbPhoto;
                    @endphp

                    <div class="dropdown">
                        <button
                            class="btn btn-outline-secondary btn-sm dropdown-toggle d-inline-flex align-items-center gap-2"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            @if (!empty($navPhoto))
                                <img
                                    src="{{ asset($navPhoto) }}"
                                    alt="Foto profil {{ $authUsername }}"
                                    class="rounded-circle border"
                                    style="width: 28px; height: 28px; object-fit: cover;"
                                >
                            @else
                                <span
                                    class="rounded-circle bg-primary-subtle border d-inline-flex align-items-center justify-content-center text-primary fw-bold"
                                    style="width: 28px; height: 28px;"
                                >
                                    {{ strtoupper(substr($authUsername ?: 'U', 0, 1)) }}
                                </span>
                            @endif
                            <span>{{ $authUsername }}</span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item" href="{{ url('/profile') }}">
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('/profile/edit') }}">
                                    Edit Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ url('/logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="btn btn-outline-secondary" href="{{ Route::has('login') ? route('login') : url('/login') }}">Login</a>
                    <a class="btn btn-primary" href="{{ Route::has('register') ? route('register') : url('/register') }}">Sign Up</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

