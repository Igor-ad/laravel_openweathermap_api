<div class="card card-body mt-3 mb-3">
    <div class="container align-content-lg-end">
        {{ __('web.user') }}
        @auth
            {{ Auth::user()->name }}
        @endauth
    </div>
</div>
