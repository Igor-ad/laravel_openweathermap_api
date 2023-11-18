<form method="POST" action="{{ route('web.register', 'users') }}">
    @csrf
    <div class="form-group row mb-3">
        <div class="col-md-4 offset-md-4">
            <input name="name" id="user-name"
                   class="form-control me-2 mt-3 mb-3" type="text"
                   placeholder="{{ __('web.forms.name') }}" aria-label="{{ __('web.forms.name') }}">
            <input name="email" id="user-email"
                   class="form-control me-2 mt-3 mb-3" type="email"
                   placeholder="{{ __('web.forms.email') }}" aria-label="{{ __('web.forms.email') }}">
            <input name="password" id="user-password"
                   class="form-control me-2 mt-3 mb-3" type="password"
                   placeholder="{{ __('web.forms.pass') }}" aria-label="{{ __('web.forms.pass') }}">
            <input name="password_confirmation" id="password_confirmation"
                   class="form-control me-2 mt-3 mb-3" type="password"
                   placeholder="{{ __('web.forms.pass_conf') }}" aria-label="{{ __('web.forms.pass_conf') }}">
            <button class="btn btn-primary mb-3" type="submit">{{ __('web.create_new_user') }}</button>

            @include('layouts.messages.error_show')
        </div>
    </div>
</form>
