@extends('layouts.app')

@section('tittle', 'Lista Pedidos')
    
@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <a class="btn btn-sm btn-outline-dark" href="{{url()->previous()}}">Volver</a>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up text-dark"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form action="{{route('fac.facturar')}}" method="post">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <input placeholder="Pedido" class="form-control" type="number" onkeyup="search()" id="filtro">
                            </div>
                            <div class="col-md-6">
                                <input placeholder="Cliente" class="form-control" type="text" onkeyup="search2()" id="filtro2">

                            </div>
                        </div>
                        <div class="row justify-content-center" id="fin">
                            <div class="col-6">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-success" type="submit">Facturar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-box table-responsive" style="width:100%; max-height:500px; min-height:500px" >
                            <table class="table table-striped jambo_table bulk_action" id="tabla">
                                <thead>
                                <tr class="headings">
                                    <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                    </th>
                                        <!-- <th class="column-title">#</th> -->
                                        <th class="column-title">Pedido</th>
                                        <th class="column-title">Nombre Cliente</th>
                                        <th class="column-title">Cantidad de lineas</th>
                                        <th class="column-title">Cantidad de unidades</th>
                                        <th class="column-title">Comentarios</th>
                                        <th class="column-title">Estado</th>
                                    </th>
                                    <th class="bulk-actions" colspan="7">
                                    <a class="antoo" style="color:#fff; font-weight:500;">Acción masiva  ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                    
                                    @foreach($pedidos as $key => $ped)
                                    <tr class="odd pointer" id="fila_t">
                                        <td class="a-center ">
                                            <input type="checkbox" class="flat" name="pedidos[]" id="inp-{{$ped->PEDIDO}}" value="{{$ped->PEDIDO}}">
                                        </td>
                                        <!-- <td scope="row">{{$key}}</td> -->
                                        <td>{{$ped->PEDIDO}}</td>
                                        <td>{{$ped->NOMBRE_CLIENTE}}</td>
                                        <td>{{$ped->CANT_LINEAS}}</td>
                                        <td>{{$ped->CANT_UNIDADES}}</td>
                                        <td>{{$ped->COMENTARIOS}}</td>
                                        <td class="text-center">
                                            <p class="">{{$ped->Estado->Nombre}}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

    <script>
        function search(){
            let filtro = $("#filtro").val().trim();
            console.log(filtro);

            if (filtro) {
                $("#tabla").find('tbody tr').hide();
                $("#tabla tbody tr").each(function(){
                    let pedido = $(this).children().eq(1);
                    if (pedido.text().toUpperCase().includes(filtro.toUpperCase())) {
                        $(this).show();
                    }
                })
            }else {
                $("#tabla").find('tbody tr').show();
            }
        }
        function search2(){
            let filtro = $("#filtro2").val().trim();
            console.log(filtro);

            if (filtro) {
                $("#tabla").find('tbody tr').hide();
                $("#tabla tbody tr").each(function(){
                    let pedido = $(this).children().eq(2);
                    if (pedido.text().toUpperCase().includes(filtro.toUpperCase())) {
                        $(this).show();
                    }
                })
            }else {
                $("#tabla").find('tbody tr').show();
            }
        }

        
      
    </script>

@endsection
