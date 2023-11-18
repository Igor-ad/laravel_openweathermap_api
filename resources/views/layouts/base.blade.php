<!doctype html>
<html lang="en">

@section('meta')
    @include('layouts.meta.html_head')
@show

<body>
<div class="d-flex justify-content-center">
    <div class="col-sm-10">

        @section('body')
            @include('layouts.body')
        @show

    </div>
</div>
</body>
</html>
