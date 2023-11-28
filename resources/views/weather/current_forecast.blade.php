@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card-body">
                @include('layouts.json.light_view', [$data])
            </div>
        </div>
    </div>
</div>
@endsection
