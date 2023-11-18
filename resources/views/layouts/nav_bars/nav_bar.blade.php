<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('web.home') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link active"
                               href="{{ route('web.home') }}">{{ __('web.nav.home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active"
                               href="{{ route('logout') }}">{{ __('web.nav.logout') }}</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link active"
                               href="{{ route('login') }}">{{ __('web.nav.login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active"
                               href="{{ route('register') }}">{{ __('web.nav.registration') }}</a>
                        </li>
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>
