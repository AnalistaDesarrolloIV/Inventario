@extends('layouts.app')

@section('tittle', 'Lista conteoas')
    
@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Listas de conteos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up text-dark"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="nav nav-pills nav-fill flex-column float-md-left pr-3" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active py-2" id="home-tab" data-toggle="tab" href="#cont1" role="tab" aria-controls="home" aria-selected="true">Conteo 1</a>
                                </li>
                                <li class="nav-item py-2">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#cont2" role="tab" aria-controls="profile" aria-selected="false">Conteo 2</a>
                                </li>
                                <li class="nav-item py-2">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#cont3" role="tab" aria-controls="contact" aria-selected="false">Conteo 3</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="cont1" role="tabpanel" aria-labelledby="zonas-tab">
                                    <div class="row justify-content-center">
                                        <div class="col-10 py-3">
                                            <div class="list-group">
                                                @if($WMS1 !== [])
                                                    @foreach($WMS1 as $key => $cont1)
                                                        <a href="{{route('Ubicaciones', ['id'=>$cont1['id'],'ncount'=>"c1"] )}}" class="list-group-item list-group-item-action" aria-current="true">
                                                            @foreach ($TipoConteo as $tc)
                                                                @if($cont1['Model_id'] == $tc['Id'])
                                                                    {{$tc['Model']}}
                                                                @endif
                                                            @endforeach
                                                        </a>
                                                    @endforeach
                                                @else
                                                    <div class="alert alert-secondary" role="alert">
                                                        Sin primeros conteos por realizar.
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="cont2" role="tabpanel" aria-labelledby="zonas-pasillos-tab">
                                    <div class="row justify-content-center">
                                        <div class="col-10 py-3">
                                            <div class="list-group">
                                                @if($WMS2 !== [])
                                                    @foreach($WMS2 as $key => $cont2)
                                                        <a href="{{route('Ubicaciones',  ['id'=>$cont2['id'],'ncount'=>"c2"])}}" class="list-group-item list-group-item-action" aria-current="true">
                                                            @foreach ($TipoConteo as $tc)
                                                                @if($cont2['Model_id'] == $tc['Id'])
                                                                    {{$tc['Model']}}
                                                                @endif
                                                            @endforeach
                                                        </a>
                                                    @endforeach
                                                @else
                                                    <div class="alert alert-secondary" role="alert">
                                                        Sin segundos conteos por realizar.
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="cont3" role="tabpanel" aria-labelledby="productos-tab">
                                    <div class="row justify-content-center">
                                        <div class="col-10 py-3">
                                            <div class="list-group">
                                                @if($WMS3 !== [])
                                                    @foreach($WMS3 as $key => $cont3)
                                                        <a href="{{route('Ubicaciones',  ['id'=>$cont3['id'],'ncount'=>"c3"])}}" class="list-group-item list-group-item-action" aria-current="true">
                                                            @foreach ($TipoConteo as $tc)
                                                                @if($cont3['Model_id'] == $tc['Id'])
                                                                    {{$tc['Model']}}
                                                                @endif
                                                            @endforeach
                                                        </a>
                                                    @endforeach
                                                @else
                                                    <div class="alert alert-secondary" role="alert">
                                                        Sin terceros conteos por realizar.
                                                    </div>
                                                @endif
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
    </div>
</div>
@endsection

@section('js')

    <script>
        
        const con1 = <?php echo json_encode($WMS1)?>;
        const con2 = <?php echo json_encode($WMS2)?>;
        const con3 = <?php echo json_encode($WMS3)?>;

        
        function conteo1() {

            if (con1 == '') {
                alert('No Tienes asignados para primer conteo');
            }else{
                $('#titulo').html(`Asignados<small>Conteo 1</small>`);
                $('#tabla').html('');
                for (let cont1 of con1) {
                    $('#tabla').append(`
                        <tr>
                            <td>${cont1['id']}</td>
                            <td>${cont1['Model_id']}</td>
                            <td>${cont1['State']}</td>
                        </tr>
                    `);
                }
            }

        }

        function conteo2() {
            
            if (con2 == '') {
                alert('No Tienes asignados para segundo conteo');
            }else{
                $('#titulo').html(`Asignados<small>Conteo 2</small>`);
                $('#tabla').html('');
                for (let cont2 of con2) {
                    $('#tabla').append(`
                        <tr>
                            <td>${cont2['id']}</td>
                            <td>${cont2['Model_id']}</td>
                            <td>${cont2['State']}</td>
                        </tr>
                    `);
                }
            }
        }

        function conteo3() {
            if (con3 == '') {
                alert('No Tienes asignados para tercer conteo');
            }else{
                $('#titulo').html(`Asignados<small>Conteo 3</small>`);
                $('#tabla').html('');
                for (let cont3 of con3) {
                    $('#tabla').append(`
                        <tr>
                            <td>${cont3['id']}</td>
                            <td>${cont3['Model_id']}</td>
                            <td>${cont3['State']}</td>
                        </tr>
                    `);
                }
            }

        }

        
      
    </script>

@endsection
