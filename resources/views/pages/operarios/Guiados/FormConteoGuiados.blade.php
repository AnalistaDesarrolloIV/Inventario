@extends('layouts.app')

@section('tittle', 'Formulario Guiados')
    
@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <a href="{{url()->previous()}}" class="btn btn-outline-dark btn-sm" type="button">Volver</a>
                        Formulario de conteo Guiado
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up text-dark"></i></a>
                        </li>
                        {{-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a class="dropdown-item" href="#">Settings 1</a>
                                </li>
                                <li><a class="dropdown-item" href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li> --}}
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <h4 class="text-center">
                                Ubicación: {{$ubicacion}}
                            </h4>
                        </div>
                        <div class="col-md-7">
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="CodeBar"> <i class="fa fa-barcode"></i> </span>
                                <input type="text" class="form-control" placeholder="Codigo de barras" aria-label="Codigo de barras" aria-describedby="CodeBar" id="code_bar" autofocus onchange="lector()">
                            </div>
                        </div>
                        @foreach ($response as $key => $codes)
                            <div class="col-auto">
                                <input type="checkbox" class="d-none" id="StateButton-{{$codes['BarCode']}}">
                                <button type="button" class="btn btn-secondary" id="button{{$codes['BarCode']}}" onclick="Mostrar('{{$codes['BarCode']}}')"> <i class="fa fa-eye"></i></button>
                            </div>
                        @endforeach
                    </div>
                    {{-- <input type="text" id="code_bar" onchange="lector()"> --}}
                    @foreach($response as $key => $artc)
                        <br />
                        <div class="contenedor d-none {{$artc['BarCode']}}" id="{{$artc['BarCode']}}" >
                            <form method="post" action="{{route('conteos.update', $artc['d_id'])}}" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                @csrf
                                <div id="metodo">
                                    @method('put')
                                </div>
                                <h5 class="text-center pb-4 text-danger">Producto N° {{$key+1}}</h5>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Zona <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="first-name" required="required" class="form-control " value="{{$artc['Zone']}}" name="Zone" readonly>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Pasillo <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="first-name" required="required" class="form-control " value="{{$artc['Hallway']}}" name="Hallway" readonly>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Ubicación <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="first-name" required="required" class="form-control " value="{{$artc['Location']}}" name="Location" readonly>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">cogido del artículo <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="first-name" required="required" class="form-control " value="{{$artc['ItemCode']}}" name="ItemCode" readonly>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre del artículo <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="first-name" required="required" class="form-control " value="{{$artc['Description']}}" name="Description" readonly>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Lote <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="first-name" required="required" class="form-control " value="{{$artc['Lote']}}" name="Lote" readonly>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Fecha de vencimiento <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input id="birthday" class="date-picker form-control" name="fecha" value="{{$artc['DateExpiration']}}" readonly  placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                            <script>
                                                function timeFunctionLong(input) {
                                                    setTimeout(function() {
                                                        input.type = 'text';
                                                    }, 60000);
                                                }
                                            </script>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Cantidad <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="numeric" id="first-name" required="required" class="form-control " value="{{round($artc['Amount'])}}" name="Amount">
                                        </div>
                                    </div>
                                    <div class="item form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Comentarios
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <textarea class="form-control" rows="3" name="Coments" placeholder=""></textarea>
                                        </div>
                                    </div>
    
                                <div class=" row pt-3 pt-md-0">
                                    <div class="col-md-6 col-sm-6 offset-md-3">
                                        <button type="submit" class="btn btn-success finali">Finalizar</button>
                                    </div>
                                    <div class="col-md-6 col-sm-6 offset-md-3">
                                        <button type="button" id="agre" onclick="saveAgre()" class="btn btn-success">finalizar y agregar nuevo</button>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
    
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

    <script>
        var codigos = <?php echo json_encode($BarCodes)?>;
            $("#code_bar").focus();


        function lector() {

            let barcode = $("#code_bar").val();

            let incluye = codigos.includes(barcode);

            if (incluye) {
                $("#"+barcode).removeClass('d-none');
                $("#code_bar").val('');
                $("#code_bar").focus();
            }else {
                codigos.forEach(element => {
                    $("#"+element).addClass('d-none');
                });
                
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Producto',
                text: "¡Este producto no es el que corresponde a esta ubicación! primero deberas completar el que corresponde a esta ubicación y agregar el producto encontrado",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Reintentar',
                cancelButtonText: 'Aceptar',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    $("#code_bar").val('');
                    $("#code_bar").focus();
                    $(".finali").removeClass('d-none');
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    
                    $(".contenedor").removeClass('d-none');
                    $(".finali").addClass('d-none');
                }
                })
                

            }
        }

        function Mostrar(barcode) {
            let state = $("#StateButton-"+barcode).prop("checked");
            $(".finali").removeClass('d-none');
            if (!state) {
                $("#"+barcode).removeClass('d-none');
                $("#button"+barcode).removeClass('btn-secondary');
                $("#button"+barcode).addClass('btn-success');
                $("#StateButton-"+barcode).prop("checked", true);
            }else{
                $("#"+barcode).addClass('d-none');
                $("#button"+barcode).removeClass('btn-success');
                $("#button"+barcode).addClass('btn-secondary');
                $("#StateButton-"+barcode).prop("checked", false);
            }

        }

        function saveAgre() {
            $("#metodo").html(``);
            let id = <?php echo $id?>;
            let url = "{{route('countAgre', "${id}")}}";
            $("#demo-form2").attr('action', url)
            $("#demo-form2").submit();

        }
      
    </script>

@endsection
