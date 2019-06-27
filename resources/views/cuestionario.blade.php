@extends('layouts.app')

@section('content')
<script src="https://h5p.org/sites/all/modules/h5p/library/js/h5p-resizer.js" charset="UTF-8"  type="application/javascript"></script>

<div class="row container-fluid">
    <div class="container col-sm-3">
        <div class="jumbotron">
            <authapi-component :refresh-data="'{!! json_encode($loaded) !!}'"></authapi-component>
        </div>
    </div>
    <div class="container col-sm-8 p-3 bg-white">
            <iframe src="https://h5p.org/h5p/embed/367398" width="1090" height="331" frameborder="0" allowfullscreen="allowfullscreen"></iframe>

    </div>
</div>

@endsection

