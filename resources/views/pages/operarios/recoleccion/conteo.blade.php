@extends('layouts.app')

@section('tittle', 'Lista Pedidos')
    
@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <!-- <h2>
                        <a class="btn btn-sm btn-outline-dark" href="{{url()->previous()}}">Volver</a>
                    </h2> -->
                    <div class="">
                        <input type="text" class="form-control" id="codigo" onchange="lector()"  placeholder="Codigo Barras" autofocus />
                    </div>
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
                    <form action="{{route('rec.guardarL')}}" method="post">
                        @csrf
                        <div class="row justify-content-center d-none" id="fin">
                            <div class="col-6">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-success">Finalizar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-box table-responsive" style="width:100%; max-height:500px; min-height:500px" >
                            <table class="table table-striped ">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">#</th>
                                    <th class="column-title">Pedido</th>
                                    <th class="column-title">Nombre Articulo</th>
                                    <th class="column-title">Lote</th>
                                    <th class="column-title">Cantidad a recoger</th>
                                    <th class="column-title">Zona</th>
                                    <th class="column-title">Ubicación</th>
                                    <th class="column-title">Codigo barras</th>
                                    <!-- <th class="column-title">Estado</th> -->
                                </tr>
                                </thead>

                                <tbody id="tabla">
                                    
                                    @foreach($det_vista as $key => $line)
                                    <tr class="odd pointer" id="{{$line->id}}">
                                        <td>
                                            <div class="form-check form-switch d-none">
                                                <input  class="form-check-input " type="checkbox" aria-readonly="true" name="productos_listos[]" value="{{$line->id}}" id="id-{{$line->id}}">
                                                <input type="text" name="pedido_lista[]" value="{{$line->PEDIDO_ID}}" id="">
                                            </div>
                                            {{$key}}</td>
                                        <td>{{$line->PEDIDO_ID}}</td>
                                        <td>{{$line->DESCRIPCION_ARTICULO}}</td>
                                        <td>{{$line->LOTE}}</td>
                                        <td>{{$line->CANTIDAD}}</td>
                                        <td>{{$line->NOMBRE_BAHIA}}</td>
                                        <td>{{$line->UBICACION}}</td>
                                        <td>{{$line->CODIGO_BARRAS}}</td>
                                        <!-- <td>
                                            @if($line->ESTADO_ID == 2)
                                                <span class="badge rounded-pill text-bg-warning">En Ejecución</span>
                                            @elseif($line->ESTADO_ID == 5)
                                                <span class="badge rounded-pill text-bg-success">Completo</span>
                                            @elseif($line->ESTADO_ID == 6)
                                                <span class="badge rounded-pill text-bg-danger">Incompleto</span>
                                            @endif
                                        </td> -->
                                        
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
        
      window.onload = function() {
        window.location.hash="no-back-button";
        window.location.hash="Again-No-back-button";//esta linea es necesaria para chrome
        window.onhashchange=function(){
            window.location.hash="no-back-button";
        }
        // console.log(disp);
      };
        
        function lector() {
            let codigo = $('#codigo').val();
            let cont = 0;
            // console.log(codigo);
            
            $("#tabla").find("tr").each(function (idx, row) {
                id = $(this).attr('id');
                if (idx >= 0) {
                    let cod_tbl = $("td:eq(7)", row).text();
                    codigo_tbl = cod_tbl.trim();
                    // console.log(cod_tbl);
                    if (codigo == codigo_tbl) {
                        // console.log(id);
                        cont += 1;
                    }
                }
            });

            console.log(cont);
             
            if (cont == 1) {
                $("#tabla").find("tr").each(function (idx, row) {
                    let id = $(this).attr('id');
                    if (idx >= 0) {
                        let cod_tbl = $("td:eq(7)", row).text();
                        codigo_tbl = cod_tbl.trim();
                        if (codigo == codigo_tbl) {
                            
                            let pedido = $("td:eq(1)", row).text();
                            let nombre = $("td:eq(2)", row).text();
                            let unidad = $("td:eq(4)", row).text();
                            let lote = $("td:eq(3)", row).text();
                            let ubicacion = $("td:eq(5)", row).text();
                            // console.log(id);
                            Swal.fire({
                                html: `
                                    <div class="row justify-content-center" style="width:100%">
                                        <div class="col-auto">
                                            <h3><b>${nombre}</b></h3>
                                        </div>
                                        <div class="col-12 text-start">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><b>Pedido: </b>${pedido}</li>
                                                <li class="list-group-item"><b>Cantidad: </b>${unidad}</li>
                                                <li class="list-group-item"><b>Lote: </b>${lote}</li>
                                                <li class="list-group-item"><b>Ubicación: </b>${ubicacion}</li>
                                            </ul>    
                                        </div>
                                    </div>`,
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Si, continuar',
                                cancelButtonText: 'No, cancelar'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // update(arregloprod);
                                    $("#productos_mas").show();
                                    $('#id-'+id).prop("checked", true);
                                    $(this).addClass('table-success');
                                    
                                    $('#codigo').val('');
                                    $('#codigo').focus();
                                        
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Producto recogido',
                                        html: `
                                            <div class="row justify-content-center" style="width:100%">
                                                <div class="col-auto">
                                                    <p><b>${nombre}</b></p>
                                                </div>
                                                <div class="col-12 text-start">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item"><b>Pedido: </b>${pedido}</li>
                                                        <li class="list-group-item"><b>Cantidad: </b>${unidad}</li>
                                                        <li class="list-group-item"><b>Lote: </b>${lote}</li>
                                                        <li class="list-group-item"><b>Ubicación: </b>${ubicacion}</li>
                                                    </ul>    
                                                </div>
                                            </div>
                                        `,
                                    })
                                }
                            })
                        }
                    }
                });

            }else if(cont > 1) {
                
                Swal.fire({
                    html: `
                        <div class="row justify-content-center" style="width:100%">
                            <div class="col-12">
                                <div class="list-group" id="prods_sel">
                                </div>
                            </div>
                        </div>`,
                    icon: false,
                    showCancelButton: false,
                    showConfirmButton: false,
                });
                $("#tabla").find("tr").each(function (idx, row) {
                    let id = $(this).attr('id');
                    if (idx >= 0) {
                        let cod_tbl = $("td:eq(7)", row).text();
                        codigo_tbl = cod_tbl.trim();
                        if (codigo == codigo_tbl) {
                            if ($('#id-'+id).prop("checked") == false) {
                                let pedido = $("td:eq(1)", row).text();
                                let nombre = $("td:eq(2)", row).text();
                                let unidad = $("td:eq(4)", row).text();
                                let lote = $("td:eq(3)", row).text();
                                let ubicacion = $("td:eq(5)", row).text();
                                $("#prods_sel").append(`
                                    <button onclick="lec2(${id})" class="list-group-item list-group-item-action" aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1 text-danger">${nombre}</h5>
                                        <small>${unidad} unidades</small>
                                        </div>
                                        <p class="mb-1">${lote}</p>
                                        <p class="mb-1">${ubicacion}</p>
                                        <small class="text-muted">${pedido}</small>
                                    </button>
                                `);
                            }
                            
                        }
                    }
                });
                
            }
            finalizar()

        }

        function lec2(id){

            $("#tabla").find("tr").each(function (idx, row) {
                let id_table = $(this).attr('id');
                if (idx >= 0) {
                    if (id_table == id) {
                        let pedido = $("td:eq(1)", row).text();
                        let nombre = $("td:eq(2)", row).text();
                        let unidad = $("td:eq(4)", row).text();
                        let lote = $("td:eq(3)", row).text();
                        let ubicacion = $("td:eq(5)", row).text();
                        
                        Swal.fire({
                            html: `
                                <div class="row justify-content-center" style="width:100%">
                                    <div class="col-auto">
                                        <h3><b>${nombre}</b></h3>
                                    </div>
                                    <div class="col-12 text-start">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><b>Pedido: </b>${pedido}</li>
                                            <li class="list-group-item"><b>Cantidad: </b>${unidad}</li>
                                            <li class="list-group-item"><b>Lote: </b>${lote}</li>
                                            <li class="list-group-item"><b>Ubicación: </b>${ubicacion}</li>
                                        </ul>    
                                    </div>
                                </div>`,
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, continuar',
                            cancelButtonText: 'No, cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // update(arregloprod);
                                $("#productos_mas").show();
                                $('#id-'+id).prop("checked", true);
                                $(this).addClass('table-success');
                                
                                $('#codigo').val('');
                                $('#codigo').focus();
                                    
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Producto recogido',
                                    html: `
                                        <div class="row justify-content-center" style="width:100%">
                                            <div class="col-auto">
                                                <p><b>${nombre}</b></p>
                                            </div>
                                            <div class="col-12 text-start">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><b>Pedido: </b>${pedido}</li>
                                                    <li class="list-group-item"><b>Cantidad: </b>${unidad}</li>
                                                    <li class="list-group-item"><b>Lote: </b>${lote}</li>
                                                    <li class="list-group-item"><b>Ubicación: </b>${ubicacion}</li>
                                                </ul>    
                                            </div>
                                        </div>
                                    `,
                                })
                            }
                        })
                    }
                }
            });
            finalizar()
        }

        function finalizar(){
            let tabla_cont = 1;
            let filas = 0;
            $("#tabla").find("tr").each(function (idx, row) {
                let idt =  $(this).attr('id');
                let estado = $(this).attr('estado');
                if (idx >= 0) {
                    if ($('#id-'+idt).prop("checked") == true) {
                        tabla_cont+=1
                    }
                }
                filas+=1
            });

            console.log(tabla_cont+"---"+filas);
            
            if ((tabla_cont) >= filas) {
                $("#fin").removeClass('d-none');
            }

        }
      
    </script>

@endsection
