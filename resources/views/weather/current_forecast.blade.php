@extends('layouts.base')

@section('content')
    <div class="col-10">
        <div class="card-body">
            @include('layouts.json.light_view', [$data])
        </div>
    </div>
@endsection
