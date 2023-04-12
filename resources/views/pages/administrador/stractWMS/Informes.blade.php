@extends('layouts.app')

@section('tittle', 'Lista Conteos')
    
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            
            <div class=" col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                       <h2>Informe Conteos</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up text-dark"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row" style="width: 100%">
                            <div class="col-sm-12">

                                
                                <h1 class="text-center text-danger py-3">Informes </h1>
                                
                                {{-- <a href="{{route('export')}}" class="btn btn-success mb-4"><i class="fa fa-download"></i> Excel</a> --}}
                                <!-- Button trigger modal -->
                               
                                <button type="button" class="btn btn-success mb-4" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-download"></i> Excel</button>

                                <div class="card-box table-responsive" style="width:100%">  
                                    <table class="table table-striped table-hover table-bordered nowrap tbl" cellspacing="0" width="100%">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Tipo Conteo</th>
                                                <th>Codigo</th>
                                                <th>Nombre</th>
                                                <th>Lote</th>
                                                <th>Fecha vencimiento</th>
                                                <th>Cantidad actual</th>
                                                <th>Ubicación</th>
                                                <th>Nuevo</th>

                                                <th class="table-danger">Codigo 1</th>
                                                <th class="table-danger">Contador 1</th>
                                                <th class="table-danger">Lote 1</th>
                                                <th class="table-danger">Vencimiento 1</th>
                                                <th class="table-danger">Cantidad 1</th>
                                                <th class="table-danger">comentarios 1</th>

                                                <th class="table-warning">Codigo 2</th>
                                                <th class="table-warning">Contador 2</th>
                                                <th class="table-warning">Lote 2</th>
                                                <th class="table-warning">Vencimiento 2</th>
                                                <th class="table-warning">Cantidad 2</th>
                                                <th class="table-warning">comentarios 2</th>


                                                <th class="table-info">Codigo 3</th>
                                                <th class="table-info">Contador 3</th>
                                                <th class="table-info">Lote 3</th>
                                                <th class="table-info">Vencimiento 3</th>
                                                <th class="table-info">Cantidad 3</th>
                                                <th class="table-info">comentarios 3</th>
                                                
                                                <th>Diferencia inventario</th>
                                                <th>Ubicación final</th>
                                                <th>Articulo final</th>
                                                <th>Lote final</th>
                                                <th>F. Vencimiento final</th>
                                                <th>Inventario final</th>

                                                <th>Fecha del Conteo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($informe as $key => $val)
                                                <tr>

                                                    {{-- -----------------------------------------Cabecera----------------------------------- --}}

                                                    <td>{{$val['ConteoId']}}</td>
                                                    <td>{{$val['Modelo']}}</td>
                                                    <td>{{$val['CodigoArticulo']}}</td>
                                                    <td>{{$val['Articulo']}}</td>
                                                    <td>{{$val['Lote']}}</td>
                                                    <td>{{$val['FechaVencimiento']}}</td>
                                                    <td>{{round($val['CantidadActual'])}}</td>
                                                    <td>{{$val['Ubicación']}}</td>
                                                    <td>{{$val['Nuevo']}}</td>

                                                    {{-- ------------------------------------------Conteo 1----------------------------------- --}}

                                                        <td class="table-danger">
                                                            @if ($val['CodigoConeto1'] !== null)
                                                                {{$val['CodigoConeto1']}}
                                                            @else
                                                                Sin contar
                                                            @endif
                                                        </td>
                                                        <td class="table-danger">
                                                            @if ($val['Contador1'] !== null)
                                                                {{$val['Contador1']}}
                                                            @else
                                                                Sin contar
                                                            @endif
                                                        </td>
                                                        <td class="table-danger">
                                                            @if ($val['LoteConteo1'] !== null)
                                                                {{$val['LoteConteo1']}}
                                                            @else
                                                                Sin contar
                                                            @endif
                                                        </td>
                                                        <td class="table-danger">
                                                            @if ($val['VencimientoConeto1'] !== null)
                                                                {{$val['VencimientoConeto1']}}
                                                            @else
                                                                Sin contar
                                                            @endif
                                                        </td>
                                                        <td class="table-danger">
                                                            @if ($val['CantidadConteo1'] !== null)
                                                                {{round($val['CantidadConteo1'])}}
                                                            @else
                                                                Sin contar
                                                            @endif
                                                        </td>
                                                        <td class="table-danger">
                                                            @if ($val['ComentariosConteo1'] !== null)
                                                                {{round($val['ComentariosConteo1'])}}
                                                            @else
                                                            Sin comentarios
                                                            @endif
                                                        </td>

                                                    {{-- ------------------------------------------Conteo 2----------------------------------- --}}
                                                    
                                                        <td class="table-warning">
                                                            @if ($val['CodigoConeto2'] !== null)
                                                                {{$val['CodigoConeto2']}}
                                                            @else
                                                                Sin contar
                                                            @endif
                                                        </td>
                                                        <td class="table-warning">
                                                            @if ($val['Contador2'] !== null)
                                                                {{$val['Contador2']}}
                                                            @else
                                                                Sin contar
                                                            @endif
                                                        </td>
                                                        <td class="table-warning">
                                                            @if ($val['LoteConteo2'] !== null)
                                                                {{$val['LoteConteo2']}}
                                                            @else
                                                                Sin contar
                                                            @endif
                                                        </td>
                                                        <td class="table-warning">
                                                            @if ($val['VencimientoConeto2'] !== null)
                                                                {{$val['VencimientoConeto2']}}
                                                            @else
                                                                Sin contar
                                                            @endif
                                                        </td>
                                                        <td class="table-warning">
                                                            @if ($val['CantidadConteo2'] !== null)
                                                                {{round($val['CantidadConteo2'])}}
                                                            @else
                                                                Sin contar
                                                            @endif
                                                        </td>
                                                        <td class="table-warning">
                                                            @if ($val['ComentariosConteo2'] !== null)
                                                                {{round($val['ComentariosConteo2'])}}
                                                            @else
                                                            Sin comentarios
                                                            @endif
                                                        </td>

                                                    {{-- ------------------------------------------Conteo 3---------------------------------- --}}
                                                    
                                                        @if($val['Contador3'] !== null)
                                                            <td class="table-info">
                                                                @if ($val['CodigoConeto3'] !== null)
                                                                    {{$val['CodigoConeto3']}}
                                                                @else
                                                                    Sin contar
                                                                @endif
                                                            </td>
                                                            <td class="table-info">
                                                                @if ($val['Contador3'] !== null)
                                                                    {{$val['Contador3']}}
                                                                @else
                                                                    Sin contar
                                                                @endif
                                                            </td>
                                                            <td class="table-info">
                                                                @if ($val['LoteConteo3'] !== null)
                                                                    {{$val['LoteConteo3']}}
                                                                @else
                                                                    Sin contar
                                                                @endif
                                                            </td>
                                                            <td class="table-info">
                                                                @if ($val['VencimientoConeto3'] !== null)
                                                                    {{$val['VencimientoConeto3']}}
                                                                @else
                                                                    Sin contar
                                                                @endif
                                                            </td>
                                                            <td class="table-info">
                                                                @if ($val['CantidadConteo3'] !== null)
                                                                    {{round($val['CantidadConteo3'])}}
                                                                @else
                                                                    Sin contar
                                                                @endif
                                                            </td>
                                                            <td class="table-info">
                                                                @if ($val['ComentariosConteo3'] !== null)
                                                                    {{round($val['ComentariosConteo3'])}}
                                                                @else
                                                                    Sin comentarios
                                                                @endif
                                                            </td>
                                                        @else
                                                            <td class="table-info text-center text-danger"  colspan="6">Sin asignar</td>
                                                        @endif

                                                    {{-- -----------------------------------------
                                                        Resumen conteos----------------------------------- --}}
                                                    
                                                        <td>{{round($val['Diferencia']) != 0 ? round($val['Diferencia']) * -1 :  round($val['Diferencia'])}}</td>

                                                        <td>{{$val['Ubicación']}}</td>

                                                        <td>{{$val['ARTICULO FINAL'] == NULL ? "Sin coincidencias en conteos." : $val['ARTICULO FINAL']}}</td>

                                                        <td>{{$val['LOTE FINAL'] == NULL ? "Sin coincidencias en conteos." : $val['LOTE FINAL']}}</td>

                                                        <td>{{$val['VENCIMIENTO FINAL'] == NULL ? "Sin coincidencias en conteos." : $val['VENCIMIENTO FINAL']}}</td>

                                                        <td>{{round($val['INVENTARIO FINAL']) == NULL ? "Sin coincidencias en conteos." : round($val['INVENTARIO FINAL'])}}</td>


                                                        <td class="">{{$val['Fecha']}}</td>
                                                    {{-- ------------------------------------------Fin----------------------------------------- --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Small modal -->

                                <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel2">Descargar informe</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-close "></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('export')}}" method="post">
                                                    @csrf
                                                    <div class="item form-group">
                                                        <label class="col-form-label col-md-4 col-12 label-align">Fecha de informe <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-8 col-12 ">
                                                            <input id="finfo" name="F_Informe" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                                            <script>
                                                                function timeFunctionLong(input) {
                                                                    setTimeout(function() {
                                                                        input.type = 'text'
                                                                    }, 60000);
                                                                }
                                                            </script>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban"></i></button>
                                                <button type="submit" class="btn btn-success"><i class="fa fa-download"></i></button>
                                            </div>

                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
