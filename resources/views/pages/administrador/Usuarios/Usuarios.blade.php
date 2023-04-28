@extends('layouts.app')

@section('tittle', 'Lista usuarios')
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class=" col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <a href="{{route('user.create')}}" class="btn btn-outline-dark">Crear usuario</a>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up text-dark"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row" style="width: 100%">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive" style="width:100%">
                                <table class="table table-striped table-hover table-bordered nowrap tbl" cellspacing="0" width="100%">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Correo</th>
                                            <th scope="col">Rol</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Acciones</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($usuarios as $user)
                                            <tr>
                                                <th scope="row">{{$user->id}}</th>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->Rol->Rol}}
                                                </td>
                                                <td class="text-center">
                                                    @if ($user->State = 0)
                                                        <span class="badge text-bg-success">Activo</span>
                                                    @else
                                                        <span class="badge text-bg-danger">Inactivo</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex justify-content-around">
                                                    <a href="{{route('user.edit', $user['id'])}}" class=""><i class="fa fa-edit text-dark" style="font-size: x-large; font-weight"></i></a>
                                                    <a href="" class=""><i class="fa fa-trash-o text-danger" aria-hidden="true" style="font-size: x-large; font-weight"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
