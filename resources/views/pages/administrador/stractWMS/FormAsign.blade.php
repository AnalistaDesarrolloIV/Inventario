@extends('layouts.app')

@section('tittle', 'Formulario asignación')
    
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form action="{{route('asignar.store')}}" method="post">
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
                                                <label for="modeloConteo">Tipo de conteo <b style="color: red;"> *</b></label>
                                                <select id="modeloConteo" class="form-control selectnormal" name="modelo_conteo" required>
                                                    <option value=""> </option>
                                                    @foreach($TipoConteo as $tipo)
                                                        <option value="{{$tipo['Id']}}">{{$tipo['Model']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row justify-content-around">
                                <div class="col-12 col-md-4 py-4 pl-3">
                                    <label for="user1">Usuario conteo 1 <b style="color: red;"> *</b></label>
                                    <select id="user1" class="form-control selectnormal" name="user1" required>
                                        <option value=""> </option>
                                        @foreach($usuarios as $user1)
                                            <option value="{{$user1['id']}}">{{$user1['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-4 py-4 pl-3">
                                    <label for="user2">Usuario conteo 2 <b style="color: red;"> *</b></label>
                                    <select id="user2" class="form-control selectnormal" name="user2" required>
                                        <option value=""> </option>
                                        @foreach($usuarios as $user2)
                                            <option value="{{$user2['id']}}">{{$user2['name']}}</option>
                                        @endforeach
                                    </select>
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


                <div class=" col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            {{-- <a href="{{route('copia.create')}}" class="btn btn-outline-dark">Consultar inventario</a> --}}
                            <h2>Detalle <small>Asignación</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up text-dark"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content" style="width: 100%;">
                            <div class="row" style="width: 100%">
                                <div class="col-sm-12 scroll">
                                    <ul class="nav nav-pills nav-fill flex-column float-md-left pr-3" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active py-2" id="home-tab" data-toggle="tab" href="#panelZonas" role="tab" aria-controls="zonas-tab" aria-selected="true">Zona</a>
                                        </li>
                                        <li class="nav-item py-2">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#panelZonas_pasillos" role="tab" aria-controls="zonas-pasillos-tab" aria-selected="false">Zona y pasillo</a>
                                        </li>
                                        <li class="nav-item py-2">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#panelProductos" role="tab" aria-controls="productos-tab" aria-selected="false">Producto</a>
                                        </li>
                                        <li class="nav-item py-2">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#panelUbicaciones" role="tab" aria-controls="ubicaciones-tab" aria-selected="false">Ubicación</a>
                                        </li>
                                        <li class="nav-item py-2">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#panelRandom" role="tab" aria-controls="random-tab" aria-selected="false">Random</a>
                                        </li>
                                        <li class="nav-item py-2">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#panelTipo" role="tab" aria-controls="tipo-tab" aria-selected="false">Tipo</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="panelZonas" role="tabpanel" aria-labelledby="zonas-tab">
                                            <div class="row justify-content-center">
                                                <div class="col-10 py-3">
                                                    <label for="por_zona" class="form-label">Zonas.</label>
                                                    <select class="form-select multiple-select-field" id="por_zona" name="Zona[]" data-placeholder="Seleccionar Zona" style="width: 100%" multiple>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="panelZonas_pasillos" role="tabpanel" aria-labelledby="zonas-pasillos-tab">
                                            <div class="row justify-content-center">
                                                <div class="col-10 py-3">
                                                    <label for="zona_pasillo" class="form-label">Zonas y pasillos.</label>
                                                    <select class="form-select multiple-select-field" id="zona_pasillo" name="zona_pasillo[]" data-placeholder="Seleccionar Zona-Pasillo" style="width: 100%" multiple>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="panelProductos" role="tabpanel" aria-labelledby="productos-tab">
                                            <div class="row justify-content-center">
                                                <div class="col-10 py-3">
                                                    <label for="productos" class="form-label">Productos.</label>
                                                    <select class="form-select multiple-select-field" id="productos" name="productos[]" data-placeholder="Seleccionar Producto" style="width: 100%" multiple>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="panelUbicaciones" role="tabpanel" aria-labelledby="ubicaciones-tab">
                                            <div class="row justify-content-center">
                                                <div class="col-10 py-3">
                                                    <label for="por_zona" class="form-label">Ubicaciones.</label>
                                                    <select class="form-select multiple-select-field" id="por_ubicacion" name="ubicacion[]" data-placeholder="Seleccionar Zona" style="width: 100%" multiple>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="panelRandom" role="tabpanel" aria-labelledby="random-tab">
                                            <div class="row justify-content-center">
                                                <div class="col-10 py-3">
                                                    <label for="por_zona" class="form-label">random.</label>
                                                    
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="random">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">Enviar conteo radom</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="panelTipo" role="tabpanel" aria-labelledby="tipo-tab">
                                            <div class="row justify-content-center">
                                                <div class="col-10 py-3">
                                                    <label for="por_zona" class="form-label">Ubicaciones.</label>
                                                    <select class="form-select multiple-select-field" id="por_tipo" name="tipo[]" data-placeholder="Seleccionar tipo" style="width: 100%" multiple>
                                                        
                                                        <option value="AA">AA</option>
                                                        <option value="BB">BB</option>
                                                        <option value="cc">CC</option>
                                                        <option value="null">Vasio</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-4">
                        <div class="d-grid gap-2">
                            <button class="btn btn-dark" type="submit">Finalizar</button>
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
        $('.selectnormal' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        } );
        $( '.multiple-select-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );

        let date = new Date();
        let output = date.getFullYear() + '-' + String(date.getMonth() + 1).padStart(2, '0') + '-' +  String(date.getDate()).padStart(2, '0');
        console.log(output);

            let datos = <?php echo json_encode($data)?>;

            
            function zone() {
                let arregloZone = [];
                let cont = 0;
                
                for(let dat of datos) {
                    if (dat['State'] == 0) {
                        if(dat['DateCopy'] == output){
                            let id = dat['id']
                            let zona = dat['Zone'];
                            let incluye = arregloZone.includes(zona);
                            if (!incluye) {
                                arregloZone[cont] = zona, id;
                                cont+=1;
                            }
                        }
                    }
                }
                arregloZone.sort()
                    // console.log(arregloZone);
                for(let zonas of arregloZone) {
                    $("#por_zona").append(`
                        <option value="${zonas}">${zonas}</option>
                            
                    
                    `);
                }
            }
            zone();

            function zonas_pasillos() {
                let arregloZP = [];
                let arregloenv = [];
                let cont2 = 0;
                for(let pas of datos) {
                    if (pas['State'] == 0) {
                        if(pas['DateCopy'] == output){
                            let pasillo = pas['Hallway']
                            let zonaP = pas['Zone'];
                            let incluye = arregloZP.includes(zonaP+"-"+pasillo);
                            if (!incluye) {
                                arregloZP[cont2] = zonaP+"-"+pasillo;
                                cont2+=1;
                            }
                        }
                    }
                }

                arregloZP.sort();

                for(let zonasPasillos of arregloZP) {
                    $("#zona_pasillo").append(`
                        <option value="${zonasPasillos}">${zonasPasillos}</option>
                            
                    `);
                }
            }
            zonas_pasillos();

            function productos() {
                let arregloProd = [];
                let arregloCodes = [];
                let cont3 = 0;
                for(let pas of datos) {
                    if (pas['State'] == 0) {
                        if(pas['DateCopy'] == output){
                            let nombre = pas['Description']
                            let code = pas['ItemCode']
                            let incluye = arregloCodes.includes(code);
                            if (!incluye) {
                                arregloCodes[cont3] = code;
                                arregloProd[cont3] = nombre;
                                cont3+=1;
                            }
                        }
                    }
                }

                let key = 0;


                for(let ProductosL of arregloProd) {
                    $("#productos").append(`
                        <option value="${arregloCodes[key]}">${arregloCodes[key]}--${ProductosL}</option>
                            
                    `);
                    key+=1;
                }
            }
            productos();
            
            function ubicacionesf() {
                let arregloUbi = [];
                let cont4 = 0;
                for(let ubi of datos) {
                    
                    if (ubi['State'] == 0) {
                        if(ubi['DateCopy'] == output){
                            let ubicacion = ubi['Location']
                            let incluye = arregloUbi.includes(ubicacion);
                            if (!incluye) {
                                arregloUbi[cont4] = ubicacion;
                                cont4+=1;
                            }
                        }
                    }
                }

                arregloUbi.sort()

                for(let ubicaciones of arregloUbi) {
                    $("#por_ubicacion").append(`
                        <option value="${ubicaciones}">${ubicaciones}</option>
                    `);
                }
            }
            ubicacionesf();
            
    </script>
@endsection
