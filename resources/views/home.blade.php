@extends('layouts.app')

@section('content')
@php
    session_start();
    $_SESSION['loaded'] = false;

@endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                            <h5 class="card-title">Bienvenido</h5>
                            <br>
                            <br>
                            <br>
                            <a href="/cuestionario" class="btn btn-primary btn-lg btn-block">Cuestionario de prueba 1</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
