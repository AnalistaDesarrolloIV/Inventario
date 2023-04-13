@extends('layouts.app')

@section('tittle', 'Formulario guiados')
    
@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <a href="{{url()->previous()}}" class="btn btn-outline-dark btn-sm" type="button">Volver</a>
                        Formulario de conteo ciego
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up text-dark"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    
                    {{-- <div class="row justify-content-center">
                        <div class="col-md-7">
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="CodeBar"> <i class="fa fa-barcode"></i> </span>
                                <input type="text" class="form-control" placeholder="Codigo de barras" aria-label="Codigo de barras" aria-describedby="CodeBar" id="code_bar" autofocus onchange="lector()">
                            </div>
                        </div>
                    </div> --}}

                    @foreach($response as $key => $artc)
                        <br />
                        <div class="" id="{{$artc['BarCode']}}">
                            <form method="post" action="{{route('conteos.update', $artc['d_id'])}}" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                @csrf
                                <div id="metodo">
                                    @method('put')
                                </div>
                                <h5 class="text-center pb-4 text-danger">Producto N° {{$key+1}} </h5>
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

                                    {{-- --------------------Segunda parte----------- --}}

                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="codebar">cogido de barras <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="codebar" onkeyup="lector()" required="required" class="form-control " value="" name="CodeBar">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="itemCode">Codigo del artículo <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="itemCode" required="required" class="form-control " value="" name="ItemCode">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Nombre del artículo <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="description" required="required" class="form-control " value="" name="Description">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="Lote">Lote <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" id="Lote" required="required" class="form-control " value="" name="Lote">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Fecha de vencimiento <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input id="birthday" class="date-picker form-control" name="fecha" value=""  placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
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
                                            <input type="numeric" id="first-name" required="required" class="form-control " value="" name="Amount">
                                        </div>
                                    </div>
                                    
                                    <div class="item form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Comentarios
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <textarea class="form-control" rows="3" name="Coments" placeholder=""></textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="item form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">Comentarios
                                        </label>
                                        <div class="col-md-6 col-sm-6">
                                            <textarea class="form-control" rows="3" name="Coments" placeholder=""></textarea>
                                        </div> --}}
                                    {{-- </div> --}}



                                <div class=" row">
                                    <div class="col-md-6 col-sm-6 offset-md-3">
                                        <button type="submit" class="btn btn-success">Finalizar</button>
                                    </div>
                                    <div class="col-md-6 col-sm-6 offset-md-3">
                                        <button type="button" id="agre" onclick="saveAgre({{$artc['d_id']}})" class="btn btn-success">finalizar y agregar nuevo</button>
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
        var prods = <?php echo json_encode($productos) ?>;
        $("#code_bar").focus();


        function lector() {

            let barcode = $("#codebar").val();

            let incluye = codigos.includes(barcode);

            if (incluye) {
                $("#itemCode").val('');
                $("#description").val('');
                $("#itemCode").prop('readonly', false);
                $("#description").prop('readonly', false);
                for(let articulo of prods){
                    if (barcode == articulo['CODIGO_BARRAS']) {
                        $("#itemCode").val(articulo['ART_ARTICOLO']);
                        $("#description").val(articulo['Descripcion']);
                        $("#itemCode").prop('readonly', true);
                        $("#description").prop('readonly', true);
                    }
                }
            }
            // if (incluye) {
            //     $("#"+barcode).removeClass('d-none');
            //     $("#code_bar").val('');
            //     $("#code_bar").focus();
            // }else {
            //     codigos.forEach(element => {
            //         $("#"+element).addClass('d-none');
            //     });
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Error',
            //         html: `<b>Producto no encontrado en esta ubicación.</b>`,
            //     })

            //     $("#code_bar").val('');
            //     $("#code_bar").focus();
            // }
        }
        
        function saveAgre(id_det) {
            $("#metodo").html(``);
            let id = id_det;
            let url = "/countAgre/"+id;
            $("#demo-form2").attr('action', url)
            $("#demo-form2").submit();

        }
      
    </script>

@endsection
