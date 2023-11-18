<form method="POST" action="{{ route('web.register', 'google') }}">
    @csrf
    <div class="form-group row">
        <div class="col-md-4 offset-md-4">
            <input name="provider" id="provider" value="google"
                   class="form-control visually-hidden"
                   type="text" aria-label="provider">
            <button class="btn btn" type="submit">
            <span class="btn-primary--icon">
                  <img src="{{ asset('/img/icons/common/google.svg') }}" alt="Google">
            </span>
                <span class="btn-inner--text">{{ __('web.login_with_google') }}</span>
            </button>
        </div>
    </div>
</form>
