@extends('layouts.app')

@section('tittle', 'Formulario asignación')
    
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form action="{{route('storeAs3', $id)}}" method="post">
                @csrf
                <div class=" col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            {{-- <a href="{{route('copia.create')}}" class="btn btn-outline-dark">Consultar inventario</a> --}}
                            <h2>Cabecera<small>Asignación</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up text-dark"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content" style="width: 100%;">
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-4 py-4 pl-3">
                                    <label for="user3">Usuario conteo 3 <b style="color: red;"> *</b></label>
                                    <select id="user3" class="form-control selectnormal" name="user3" required>
                                        <option value=""> </option>
                                        @foreach($usuarios as $user3)
                                            <option value="{{$user3['id']}}">{{$user3['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Detalle <small>Asignación</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up text-dark"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content" style="width: 100%;">
                            <div class="row" style="width: 100%">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive" style="width:100%">
                                        <table class="table table-striped table-hover table-bordered nowrap tbl" cellspacing="0" width="100%">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tipo conteo</th>
                                                    <th>Codigo Articulo</th>
                                                    <th>Nombre Articulo</th>
                                                    <th>Lote</th>
                                                    <th>Fecha Vencimiento</th>
                                                    <th>Estado linea</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($detalle as $key => $val)
                                                    <tr>
                                                        <td>{{$key}}</td>
                                                        @foreach($TipoConteo as $TC)
                                                            @if($TC['Id'] == $val['Model_id'])
                                                                <td>{{$TC['Model']}}</td>
                                                            @endif
                                                        @endforeach
                                                        <td>{{$val['ItemCode']}}</td>
                                                        <td>{{$val['Description']}}</td>
                                                        <td>{{$val['Lote']}}</td>
                                                        <td>{{$val['DateExpiration']}}</td>
                                                        <td class="text-center">
                                                            @if($val['StateLine']== 0)
                                                                <span class="badge rounded-pill text-bg-danger">Sin contar</span>
                                                            @else 
                                                                <span class="badge rounded-pill text-bg-success">Contado</span>
                                                            @endif
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
                <div class="row justify-content-end">
                    <div class="col-4">
                        <div class="d-grid gap-2">
                            <button class="btn btn-dark" type="submit">Asignar</button>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="d-grid gap-2">
                            <a href="{{route('asignar.index')}}" class="btn btn-outline-dark">Volver</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <!-- Styles -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />


@endsection

@section('js')
    <!-- Scripts -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

    </script>
@endsection
