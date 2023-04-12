@extends('layouts.app')

@section('tittle', 'Formulario asignación')
    
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form action="{{route('StoreAgre', $id)}}" method="post">
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
                            <div class="row" style="width: 100%">
                                <div class="col-sm-12">
                                    <div class="card-box" style="width:100%">
                                        <div class="row">
                                            <div class="col-12 py-4 pl-3">
                                                @foreach ($detalle as $item)
                                                    <div class="item form-group">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="location">Zona<span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <input type="text" id="Zone" required="required" class="form-control " value="{{$item['Zone']}}" name="Zone" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="item form-group">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="location">Pasillo<span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <input type="text" id="Hallway" required="required" class="form-control " value="{{$item['Hallway']}}" name="Hallway" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="item form-group">
                                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="location">Codigo Ubicación <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <input type="text" id="location" required="required" class="form-control " value="{{$item['Location']}}" name="Location" readonly>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="location">Codigo de barras <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input type="text" id="barcode" required="required" class="form-control " value="" name="barcode" onkeyup="producto()">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="location">codigo del articulo <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input type="text" id="ItemCode" required="required" class="form-control " value="" name="ItemCode">
                                                    </div>
                                                </div>
                                                <div class="item form-group d-none" id="name1">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="location">Nombre del articulo <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input type="text" id="ItemName" required="required" class="form-control " value="" name="Description">
                                                    </div>
                                                </div>
                                                
                                                <div class="item form-group" id="name2">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="location">Nombre del articulo  <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <select class="select2 form-control" id="itemname"  name="ItemName" id="user" onchange="producto2()" style="width: 100%;">
                                                            <option value="" selected></option>
                                                            @foreach($productos as $key => $value)
                                                                <option value="{{$value['Descripcion']}}">{{$value['Descripcion']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="location">Fecha de vencimiento <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input type="text" id="Expiration" required="required" class="form-control " value="" name="Expiration">
                                                    </div>
                                                </div> --}}
                                               
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Fecha de vencimiento <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input id="birthday" class="date-picker form-control" name="Expiration" value=""  placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
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
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="location">Lote <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input type="text" id="Lote" required="required" class="form-control " value="" name="Lote">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="location">Cantidad <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input type="number" id="Amount" required="required" class="form-control " value="" name="Amount">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="item row justify-content-end">
                                            <div class="col-4">
                                                <div class="d-grid gap-2">
                                                    <button class="btn btn-dark" type="submit">Agregar</button>
                                                </div>
                                            </div>
                                            {{-- <div class="col-2">
                                                <div class="d-grid gap-2">
                                                    <a href="{{route('asignar.index')}}" class="btn btn-outline-dark">Volver</a>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                                {{-- <div class="col-12 col-md-4 py-4 pl-3">
                                    <label for="user3">Usuario conteo 3</label>
                                    <select id="user3" class="form-control selectnormal" name="user3">
                                        <option value=""> </option>
                                        @foreach($usuarios as $user3)
                                            <option value="{{$user3['id']}}">{{$user3['name']}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                            </div>
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        
        $( '.select2' ).select2( {
            theme: "bootstrap-5"
        } );

        let prods = <?php echo json_encode($productos)?>;
        console.log(prods);

        function producto() {
            let codigo = $("#barcode").val();
            $("#ItemCode").val('');
            $("#ItemName").val('');
            $("#ItemCode").prop('readonly', false);
            $("#ItemName").prop('readonly', false);
            $("#name1").addClass('d-none');
            $("#name2").removeClass('d-none');
            for(let articulo of prods){
                if (codigo == articulo['CODIGO_BARRAS']) {
                    $("#name2").addClass('d-none');
                    $("#name1").removeClass('d-none');
                    $("#ItemCode").val(articulo['ART_ARTICOLO']);
                    $("#ItemName").val(articulo['Descripcion']);
                    $("#ItemCode").prop('readonly', true);
                    $("#ItemName").prop('readonly', true);
                }
            }
        }

        function producto2() {
            let opcion = $("#itemname option:selected").val();
            $("#ItemCode").val('');
            $("#barcode").val('');
            $("#ItemCode").prop('readonly', false);
            for(let articulo of prods){
                if (opcion == articulo['Descripcion']) {
                    $("#ItemCode").val(articulo['ART_ARTICOLO']);
                    $("#barcode").val(articulo['CODIGO_BARRAS']);
                    $("#ItemCode").prop('readonly', true);
                }
            }
        }
    </script>
@endsection
