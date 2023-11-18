<form method="POST" action="{{ route('web.login') }}">
    @csrf
    <div class="form-group row mb-3">
        <div class="col-md-4 offset-md-4">
            <a href="{{ route('google.redirect') }}" class="btn btn-neutral btn-icon">
                <span class="btn-inner--icon">
                    <img src="{{ asset('/img/icons/common/google.svg') }}" alt="Google">
                </span>
                <span class="btn-inner--text">{{ __('web.login_with_google') }}</span>
            </a>
            <input name="email" id="user-email"
                   class="form-control me-2 mt-3 mb-3" type="email"
                   placeholder="{{ __('web.forms.email') }}" aria-label="{{ __('web.forms.email') }}">
            <input name="password" id="user-password"
                   class="form-control me-2 mt-3 mb-3" type="password"
                   placeholder="{{ __('web.forms.pass') }}" aria-label="{{ __('web.forms.pass') }}" value="">
            <button class="btn btn-primary mb-3" type="submit">{{ __('web.nav.login') }}</button>

            @include('layouts.messages.error_show')
        </div>
    </div>
</form>
