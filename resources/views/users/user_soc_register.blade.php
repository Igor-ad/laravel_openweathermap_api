@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('web.registration') }}</div>
                <div class="card-body">
                    @include('layouts.forms.google_login')
                    @include('layouts.forms.user_create')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
