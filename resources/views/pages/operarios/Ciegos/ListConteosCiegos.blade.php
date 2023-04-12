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
                        Ciegos
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
                                <th>Zona</th>
                                <th>Pasillo</th>
                                <th>Ubicacion</th>
                                <th>Estado Linea</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($response as $key => $prod)
                                    <tr>
                                        <td>{{$prod['Zone']}}</td>
                                        <td>{{$prod['Hallway']}}</td>
                                        <td>{{$prod['Location']}}</td>
                                        <td class="text-center">
                                            @if($prod['State_line'] == 0)
                                                <span class="badge rounded-pill text-bg-danger">Por contar</span>
                                            @else 
                                                <span class="badge rounded-pill text-bg-success">Contador</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
