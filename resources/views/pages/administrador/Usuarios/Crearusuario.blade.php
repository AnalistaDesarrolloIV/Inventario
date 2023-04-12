@extends('layouts.app')

@section('tittle', 'Crear usuario')
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 p-3 rounded-4 bg-col">
            <h3 class="text-center bold">Crear Usuario</h3>
            <form method="POST" action="{{ route('user.store') }}">
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">Nombre <b style="color: red;">*</b> </label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control rounded-1 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">Correo <b style="color: red;">*</b> </label>

                    <div class="col-md-6">
                        <input id="email" type="text" class="form-control rounded-1 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña <b style="color: red;">*</b> </label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control rounded-1 @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirmación de contraseña <b style="color: red;">*</b> </label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control rounded-1" name="password_confirmation" autocomplete="new-password">
                        <div id="passwordHelpBlock" class="">
                           La contraseña debe incluir por lo menos:
                           <ul>
                            <li>Cinco caracteres.</li>
                            <li>Una letra mayuscula.</li>
                            <li>Una letra minuscula.</li>
                            <li>Un numero.</li>
                            <li>Un caracter especial (* - $ # % &).</li>
                           </ul>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="Rol" class="col-md-4 col-form-label text-md-end">Rol <b style="color: red;">*</b> </label>

                    <div class="col-md-6">
                        <select class="form-select @error('Rol_id') is-invalid @enderror" name="Rol_id" id="Rol">
                            <option value="" selected></option>
                            @foreach ($roles as $rol)
                                <option value="{{$rol['Id']}}">{{$rol['Rol']}}</option>
                            @endforeach
                        </select>
                        @error('Rol_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0 justify-content-end">
                    <div class="col-md-5 d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            Crear
                        </button>
                    </div>
                    <div class="col-md-3 d-grid gap-2">
                        <a type="button" href="{{route('user.index')}}" class="btn btn-outline-dark">
                            Volver
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
