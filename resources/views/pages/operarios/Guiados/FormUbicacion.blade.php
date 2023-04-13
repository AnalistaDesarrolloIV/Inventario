@extends('layouts.app')

@section('tittle', 'Formulario ubicaciones')
    
@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        @if($NR !== 0)
                            <a class="btn btn-sm btn-outline-dark" href="{{url('/')}}/lista/{{$id}}">Ver lista</a>
                        @endif
                        Guiado {{$id}}
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up text-dark"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form method="post" action="{{url('/')}}/searchubi/{{$id}}" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Zonas <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <select class="form-control" name="Zone">
                                    <option>Seleccionar</option>
                                    @foreach($zonas as $key => $zone)
                                        <option value="{{$zone}}">{{$zone}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Pasillos <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <select class="form-control" name="Hallway">
                                    <option>Seleccionar</option>
                                    @foreach($pasillos as $key => $hallway)
                                        <option value="{{$hallway}}">{{$hallway}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Ubicaciones <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                                <select class="form-control  @error('Location') is-invalid @enderror" name="Location">
                                    <option>Seleccionar</option>
                                    @foreach($ubi as $key => $ubication)
                                        <option value="{{$ubication}}">{{$ubication}}</option>
                                    @endforeach
                                </select>
                                
                                @error('Location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="location">Confirmación Codigo Ubicación <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="location" class="form-control " value="" name="Location_confirmation">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class=" row">
                            <div class="col-md-6 col-sm-6 offset-md-3 pt-3">
                                <a href="{{route('conteos.index')}}" class="btn btn-primary botones" type="button">Volver</a>
                                <button type="submit" class="btn btn-success botones">Consulltar</button>
                                @if($NR == 0)
                                    <a href="{{route('changestate', $id)}}" class="btn btn-success">Finalizar</a>
                                @endif
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
        let n_prod = <?php echo $NR?>;

        if (n_prod == 0) {
            $('.botones').addClass('d-none');
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Conteo finalizado exitosamente por favor precionar finalizar',
                showConfirmButton: false,
                timer: 1500
            }); 
        }
    </script>

@endsection
