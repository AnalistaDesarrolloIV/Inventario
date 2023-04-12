@extends('layouts.app')

@section('tittle', 'Copia Diaria')
    
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            
            <div class=" col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <a href="{{route('asignar.index')}}" class="btn btn-outline-dark">Volver</a>
                        <a href="{{route('copia.create')}}" class="btn btn-outline-dark">Copiar inventario actual</a>
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
                                                <th>#</th>
                                                <th>Codigo Articulo</th>
                                                <th>Nombre Articulo</th>
                                                <th>Codigo Barras</th>
                                                <th>Lote</th>
                                                <th>Fecha Vencimiento</th>
                                                <th>Cantidad</th>
                                                <th>Ubicacion</th>
                                                <th>Fecha Copia</th>
                                                <th>Hora Copia</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($TableCopy as $key => $val)
                                                <tr>
                                                    <td>{{$key}}</td>
                                                    <td>{{$val['ItemCode']}}</td>
                                                    <td>{{$val['Description']}}</td>
                                                    <td>{{$val['BarCode']}}</td>
                                                    <td>{{$val['Lote']}}</td>
                                                    <td>{{$val['DateExpiration']}}</td>
                                                    <td>{{$val['Amount']}}</td>
                                                    <td>{{$val['Location']}}</td>
                                                    <td>{{$val['DateCopy']}}</td>
                                                    <td>{{$val['HourCopy']}}</td>
                                                    <td>
                                                        @if($val['State']== 0)
                                                            <span class="badge rounded-pill text-bg-secondary">Copiado</span>
                                                        @else
                                                            <span class="badge rounded-pill text-bg-dark">Asignado</span>
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
        </div>
    </div>
@endsection
