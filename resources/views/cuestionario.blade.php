@extends('layouts.app')

@section('content')

<div class="row justify-content-around">
    <div class="col-md-3 col-md-offset-2">

        <div class="container-fluid">
            <div class="jumbotron">
                <authapi-component :refresh-data="'{!! json_encode($loaded) !!}'" ></authapi-component>
            </div>
        </div>
    </div>
    <div class="container col-md-8 col-md-offset-2">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#pre1">Pregunta 1</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#pre2">Pregunta 2</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#pre3">Pregunta 3</a>
            </li>
        </ul>
        <div class="jumbotron">
            <!-- Tab panes -->
            <div class="tab-content">
                <div id="pre1" class="container tab-pane active">
                    <h4>¿Qué es HTML?</h4>
                    <input type="radio" name="pregunta1" value="A" onclick="respuesta1('A')">
                    A.Compilador de Programas<BR>
                    <input type="radio" name="pregunta1" value="B" onclick="respuesta1('B')">
                    B.Lector de Hojas con extension .HTML<BR>
                    <input type="radio" name="pregunta1" value="C" onclick="respuesta1('C')">
                    C.Lenguaje de etiquetas para crear documentos electronicos<BR>
                    <input type="radio" name="pregunta1" value="D" onclick="respuesta1('D')">
                    D.Explorador<BR>  <BR>
                </div>

                <div id="pre2" class="container tab-pane fade">
                    <h4>¿Que extension tienen los documentos electronicos?</h4>
                    <input type="radio" name="pregunta2" value="A" onclick="respuesta2('A')">
                    A.C<BR>
                    <input type="radio" name="pregunta2" value="B" onclick="respuesta2('B')">
                    B.HTTP.<BR>
                    <input type="radio" name="pregunta2" value="C" onclick="respuesta2('C')">
                    C.HTML<BR>
                    <input type="radio" name="pregunta2" value="D" onclick="respuesta2('D')">
                    D.LINK<BR>  <BR>
                </div>

                <div id="pre3" class="container tab-pane fade">
                    <h4>¿Que etiqueta se utiliza para declarar un documento HTML?</h4>
                    <input type="radio" name="pregunta3" value="A" onclick="respuesta3('A')">
                    A.BODY><BR>
                    <input type="radio" name="pregunta3" value="B" onclick="respuesta3('B')">
                    B.TITLE><BR>
                    <input type="radio" name="pregunta3" value="C" onclick="respuesta3('C')">
                    C.HTML><BR>
                    <input type="radio" name="pregunta3" value="D" onclick="respuesta3('D')">
                        D.FONT><BR> <BR>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

