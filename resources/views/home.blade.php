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
                            <h5 class="card-title"><strong>Bienvenido </strong> {{ Auth::user()->name }}</h5>
                            <br>
                            <p>En esta sección se muestran los cuestionarios actuales con los que cuenta el prototipo,
                                recuerde leer las instrucciones iniciales de cada uno para no tener interrupciones al resolver.</p>
                            <br>
                            <br>
                            <ul class="list-group">
                                    <li class="list-group-item list-group-item-primary">
                                        <a href="/cuestionario" class="btn btn-link">Cuestionario de prueba 1</a>
                                    </li>
                                    <li class="list-group-item list-group-item-secondary">
                                        <a href="#" class="btn btn-link">Cuestionario de prueba 2</a>
                                    </li>
                                  </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
