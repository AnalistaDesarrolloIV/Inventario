<?php 
header("Pragma: public");
header("Expires: 0");
$filename = "InformeInventario-$fecha.xls";
header("Content-type: application/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");


?>

<table border="1">
    <thead>
        <tr>
            <th  style="background-color: rgb(32, 32, 32); color: white">#</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Tipo Conteo</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Codigo</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Nombre</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Lote</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Fecha vencimiento</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Cantidad actual</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Ubicación</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Nuevo</th>

            <th  style="background-color: rgb(32, 32, 32); color: white" >Codigo 1</th>
            <th  style="background-color: rgb(32, 32, 32); color: white" >Contador 1</th>
            <th  style="background-color: rgb(32, 32, 32); color: white" >Lote 1</th>
            <th  style="background-color: rgb(32, 32, 32); color: white" >Vencimiento 1</th>
            <th  style="background-color: rgb(32, 32, 32); color: white" >Cantidad 1</th>
            <th  style="background-color: rgb(32, 32, 32); color: white" >comentarios 1</th>

            <th  style="background-color: rgb(32, 32, 32); color: white">Codigo 2</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Contador 2</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Lote 2</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Vencimiento 2</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Cantidad 2</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">comentarios 2</th>


            <th  style="background-color: rgb(32, 32, 32); color: white">Codigo 3</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Contador 3</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Lote 3</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Vencimiento 3</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Cantidad 3</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">comentarios 3</th>
            
            <th  style="background-color: rgb(32, 32, 32); color: white">Diferencia inventario</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Ubicación final</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Articulo final</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Lote final</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">F. Vencimiento final</th>
            <th  style="background-color: rgb(32, 32, 32); color: white">Inventario final</th>

            <th  style="background-color: rgb(32, 32, 32); color: white">Fecha del Conteo</th>
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