    @extends('layouts.app')

    @section('tittle', 'Lista Pedidos')
        
    @section('content')
    <div class="container">
        <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="modal_detalle" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_detalleLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal_detalleLabel">Detalle de pedido</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card-box table-responsive" style="width:100%; max-height:400px; min-height:400px" >
                <table class="table table-striped ">
                    <thead class="table-dark">
                        <tr>
                            <th class="column-title">Pedido</th>
                            <th class="column-title">Nombre Articulo</th>
                            <th class="column-title">Lote</th>
                            <th class="column-title">Cantidad a recoger</th>
                            <th class="column-title">Zona</th>
                            <th class="column-title">Ubicación</th>
                            <th class="column-title">Codigo barras</th>
                        </tr>
                    </thead>
                    <tbody id="cont-detalle">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <!-- <button type="button" class="btn btn-primary">Understood</button> -->
        </div>
        </div>
    </div>
    </div>
        
        <div class="row justify-content-center">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <!-- <h2>
                            <a class="btn btn-sm btn-outline-dark" href="{{url()->previous()}}">Volver</a>
                        </h2> -->
                        <!-- <div class="">
                            <input type="text" class="form-control" id="codigo" onchange="lector()"  placeholder="Codigo Barras" autofocus />
                        </div> -->
                        <!-- <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up text-dark"></i></a>
                            </li>

                        </ul> -->
                        <div class="col">

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form action="{{route('emp.guardarL')}}" method="post">
                            @csrf
                            <div class="row justify-content-around">
                                
                                @foreach($pedidos AS $key => $val)
                                    <div class="col-md-4">
                                        <div class="card text-center" style="width: 100%;">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$val->PEDIDO}}</h5>
                                                <input type="hidden" class="form-control" name="pedidos[]" id="pedidos" value="{{$val->PEDIDO}}">
                                                <p class="card-text"><b class="text-danger">Cliente: </b>{{$val->NOMBRE_CLIENTE}}</p>
                                                <p class="card-text"><b class="text-danger">Cantidad de lines: </b>{{$val->CANT_LINEAS}}</p>
                                                <p class="card-text"><b class="text-danger">Cantidad de unidades: </b>{{$val->CANT_UNIDADES}}</p>
                                                <b class="text-danger">Comentarios: </b><small class="card-text">{{$val->COMENTARIOS}}</small>
                                                <br>
                                                <!-- <button type="button" onclick="verDetalle('{{$val->PEDIDO}}')" class="btn btn-warning mt-2">Detalle</button> -->
                                                <button type="button" class="btn btn-warning"  onclick="verDetalle('{{$val->PEDIDO}}')" data-bs-toggle="modal" data-bs-target="#modal_detalle">
                                                    Detalle
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="" id="emp">
                                <div class="row px-5 mt-3" id="1">
                                    <div class="col-12 text-center text-danger">
                                        <h5>Unidades de empaque</h5>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <select class="form-select" id="uni_emp" name="uni_emp[]" aria-label="Default select example" >
                                                <option selected value="" disabled>Unidad de empaque</option>
                                                @foreach($unidades AS $key => $uni)
                                                    <option value="{{$uni->id}}">{{$uni->NOMBRE}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="cant_unidades[]" id="cant_unidades" placeholder="N° unidades">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary" onclick="unidadesMas(1)" type="button">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-4">
                                    <div class="d-grid gap-2 mt-4" >
                                        <button class="btn btn-success" type="submit">Fin Empaque</button>
                                    </div>
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

        <script>
            function verDetalle(ped) {
                // $("#modal_detalle").show();
                
                var detalle = <?php echo json_encode($det_vista)?>;
                // console.log(detalle);
                $("#cont-detalle").html('');
                detalle.forEach(element => {
                    if (element['PEDIDO_ID'] == ped) {
                        $("#cont-detalle").append(`
                            <tr>
                                <td>${element['PEDIDO_ID']}</td>
                                <td>${element['DESCRIPCION_ARTICULO']}</td>
                                <td>${element['LOTE']}</td>
                                <td>${element['CANTIDAD']}</td>
                                <td>${element['NOMBRE_BAHIA']}</td>
                                <td>${element['UBICACION']}</td>
                                <td>${element['CODIGO_BARRAS']}</td>
                            </tr>
                        `);
                    }
                    console.log(element['PEDIDO_ID']);
                });
            }
            function unidadesMas (ant) {
                id = ant + 1;
                $("#emp").append(`
                
                    <div class="row px-5 mt-3" id="${id}">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <select class="form-select" id="uni_emp" name="uni_emp[]" aria-label="Default select example" >
                                    <option selected value="">Unidad de empaque</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="cant_unidades[]" id="cant_unidades" placeholder="N° unidades">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" onclick="unidadesMas(${id})" type="button">+</button>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="d-grid gap-2">
                                <button class="btn btn-danger" onclick="unidadesMenos(${id})" type="button">-</button>
                            </div>
                        </div>
                    </div>
                `);
            }
            function unidadesMenos (id) {
                $("#"+id).remove();
            }
        </script>
    @endsection
