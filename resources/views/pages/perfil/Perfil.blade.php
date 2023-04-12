@extends('layouts.app')

@section('tittle', 'Inicio')
    
@section('content')
<div class="container">
{{--     
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Información personal de {{$usuario['name']}}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up text-dark"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <form action="{{route('user.update', $usuario['id'])}}" method="post">
                            
                            <div class="col-4 float-left">
                                <b class="mb-3">Editar informacion personal.</b>
                                <p class="pt-2"> Es importante mantener tu información personal actualizada dentro del sistema.</p>
                            </div>

                            <div class="col-12">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="first-name" value="{{$usuario['name']}}" class="form-control ">
                                    </div>
                                </div>
                            </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
     --}}
    <div class="row">


        <div class="col-md-6 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Información personal <small>{{$usuario['name']}}</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link text-dark"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link text-dark"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="{{route('user.update', $usuario['id'])}}" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        @method('put')
                        @csrf
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="text" id="name" value="{{$usuario['name']}}" name="name" class="form-control @error('name') is-invalid @enderror">
                            </div>
                        </div>
                        @error('name')
                            <div class="alert alert-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Correo <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="text" id="email" name="email" value="{{$usuario['email']}}" class="form-control @error('email') is-invalid @enderror">
                            </div>
                        </div>
                        @error('email')
                            <div class="alert alert-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        @if ( Auth::user()->Rol_id == 1)
                            
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Zonas <span class="required">*</span></label>
                                <div class="col-md-9 col-sm-9  ">
                                    <select class="form-control" name="rol">
                                        <option>Seleccionar</option>
                                        @foreach($roles as $key => $rol)
                                            <option value="{{$rol['Id']}}">{{$rol['Rol']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @else 
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="rol">Rol <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" id="rol" disabled name="rol" value="{{$usuario['Rol_id'] == 1 ? 'Administrado' : 'Operario'}}" class="form-control">
                                </div>
                            </div>
                        @endif
                        <div class="ln_solid"></div>
                        <div class="row pt-4 pt-md-0 justify-content-end">
                            <div class="col-auto offset-md-3">
                                <button type="submit" class="btn btn-success">Editar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        
        <div class="col-md-6 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Cambio contraseña <small>{{$usuario['name']}}</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link text-dark"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link text-dark"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="{{route('updatePass', $usuario['id'])}}" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                        @csrf
                        @error('pass_last')
                            <div class="alert alert-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align" for="newPassword">Nueva contraseña <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 ">
                                <input type="password" id="newPassword" name="newPassword" value="{{old('newPassword')}}" class="form-control  @error('newPassword') is-invalid @enderror">
                            </div>
                        </div>
                        @error('newPassword')
                            <div class="alert alert-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <div class="item form-group">
                            <label for="newPassword_confirmation" class="col-form-label col-md-4 col-sm-4 label-align">Confirmar contraseña<span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 ">
                                <input id="newPassword_confirmation" class="form-control" name="newPassword_confirmation" value="{{old('newPassword_confirmation')}}" type="password">
                                <div id="passwordHelpBlock" class="">
                                    La contraseña debe incluir por lo menos:
                                    <ul>
                                     <li>Cinco caracteres</li>
                                     <li>Una letra mayuscula</li>
                                     <li>Una letra minuscula</li>
                                     <li>Un numero</li>
                                     <li>Un caracter especial (* - $ # % &)</li>
                                    </ul>
                                 </div>
                            </div>
                        </div>
                        
                        <div class="ln_solid"></div>
                        <div class="row pt-4 pt-md-0 justify-content-end">
                            <div class="col-auto  offset-md-3">
                                <button type="submit" class="btn btn-success">Editar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection
