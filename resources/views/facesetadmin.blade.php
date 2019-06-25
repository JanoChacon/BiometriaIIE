@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Crear faceset') }}</div>
                    <div class="card-body">
                        <form method="POST" action="/faceset-create">
                            @csrf

                            <div class="form-group row">
                                <label for="displayname" class="col-md-4 col-form-label text-md-right">{{ __('display_name') }}</label>

                                <div class="col-md-6">
                                    <input id="displayname" type="text" class="form-control @error('displayname') is-invalid @enderror" name="displayname" value="{{ old('displayname') }}" required autocomplete="displayname" autofocus>

                                    @error('displayname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="outerid" class="col-md-4 col-form-label text-md-right">{{ __('outer_id') }}</label>

                                <div class="col-md-6">
                                    <input id="outerid" type="text" class="form-control @error('outerid') is-invalid @enderror" name="outerid" value="{{ old('outerid') }}" required autocomplete="outerid">

                                    @error('outerid')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Crear') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <br>
                <div class="card">
                        <div class="card-header">{{ __('Crear face en faceset') }}</div>

                        <div class="card-body">
                            <form method="POST" action="face-add">
                                @csrf

                                <div class="form-group row">
                                    <label for="outer_id" class="col-md-4 col-form-label text-md-right">{{ __('outer_id') }}</label>

                                    <div class="col-md-6">
                                        <input id="outer_id" type="text" class="form-control @error('outer_id') is-invalid @enderror" name="outer_id" value="{{ old('outer_id') }}" required autocomplete="displayname" autofocus>

                                        @error('outer_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="facetokens" class="col-md-4 col-form-label text-md-right">{{ __('face_tokens (coma para separar)') }}</label>

                                    <div class="col-md-6">
                                        <input id="facetokens" type="text" class="form-control @error('facetokens') is-invalid @enderror" name="facetokens" value="{{ old('facetokens') }}" required autocomplete="outerid">

                                        @error('facetokens')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Crear') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header">{{ __('mostrar faceset') }}</div>

                        <div class="card-body">
                            <form method="POST" action="faceset-get">
                                @csrf
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Mostrar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header">{{ __('borrar faceset') }}</div>

                        <div class="card-body">
                            <form method="POST" action="faceset-delete">
                                @csrf

                                <div class="form-group row">
                                    <label for="facesettoken" class="col-md-4 col-form-label text-md-right">{{ __('faceset token') }}</label>

                                    <div class="col-md-6">
                                        <input id="facesettoken" type="text" class="form-control @error('facesettoken') is-invalid @enderror" name="facesettoken" value="{{ old('facesettoken') }}" required autocomplete="facesettoken" autofocus>

                                        @error('facesettoken')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('borrar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header">{{ __('borrar face en faceset') }}</div>

                        <div class="card-body">
                            <form method="POST" action="face-delete">
                                @csrf

                                <div class="form-group row">
                                    <label for="outer_id" class="col-md-4 col-form-label text-md-right">{{ __('outer_id') }}</label>

                                    <div class="col-md-6">
                                        <input id="outer_id" type="text" class="form-control @error('outer_id') is-invalid @enderror" name="outer_id" value="{{ old('outer_id') }}" required autocomplete="displayname" autofocus>

                                        @error('outer_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="facetokens" class="col-md-4 col-form-label text-md-right">{{ __('face_tokens (coma para separar)') }}</label>

                                    <div class="col-md-6">
                                        <input id="facetokens" type="text" class="form-control @error('facetokens') is-invalid @enderror" name="facetokens" value="{{ old('facetokens') }}" required autocomplete="outerid">

                                        @error('facetokens')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('borrar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header">{{ __('buscar face') }}</div>

                        <div class="card-body">
                            <form method="POST" action="search-face">
                                @csrf

                                <div class="form-group row">
                                    <label for="facetoken" class="col-md-4 col-form-label text-md-right">{{ __('face_token') }}</label>

                                    <div class="col-md-6">
                                        <input id="facetoken" type="text" class="form-control @error('facetoken') is-invalid @enderror" name="facetoken" value="{{ old('facetoken') }}" required autocomplete="displayname" autofocus>

                                        @error('facetoken')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="outerid" class="col-md-4 col-form-label text-md-right">{{ __('outer_id') }}</label>

                                    <div class="col-md-6">
                                        <input id="outerid" type="text" class="form-control @error('outerid') is-invalid @enderror" name="outerid" value="{{ old('outerid') }}" required autocomplete="outerid">

                                        @error('outerid')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('buscar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>


@endsection
