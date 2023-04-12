@extends('layouts.app')

@section('tittle', 'Lista Guiados')
    
@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <a class="btn btn-sm btn-outline-dark" href="{{url()->previous()}}">Volver</a>
                        Guiados
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up text-dark"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <div class="card-box table-responsive" style="width:100%">
                        <table  class="table table-hover tbl">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Zona</th>
                                <th>Pasillo</th>
                                <th>Ubicacion</th>
                                <th>Cantidad</th>
                                <th>Estado Linea</th>
                                <th>Barras</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($response as $key => $prod)
                                    <tr>
                                        <th scope="row">{{$key}}</th>
                                        <td>{{$prod['ItemCode']}}</td>
                                        <td>{{$prod['Description']}}</td>
                                        <td>{{$prod['Zone']}}</td>
                                        <td>{{$prod['Hallway']}}</td>
                                        <td>{{$prod['Location']}}</td>
                                        <td>{{round($prod['Amount'])}}</td>
                                        <td class="text-center">
                                            @if($prod['State_line'] == 0)
                                                <span class="badge rounded-pill text-bg-danger">Por contar</span>
                                            @else 
                                                <span class="badge rounded-pill text-bg-success">Contador</span>
                                            @endif
                                        </td>
                                        <td>{{$prod['BarCode']}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($NR == 0)
                            <div class="ln_solid"></div>
                            <div class=" row">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <a href="{{route('changestate', $prod['id'])}}" class="btn btn-success">Finalizar</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

    <script>
        
      
    </script>

@endsection
