<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="shortcut icon" href="{{url('/')}}/images/LogoInd.png" type="image/x-ico" />
    {{-- <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> --}}

    <title>@yield('tittle')</title>

    <!-- Bootstrap -->
    <link href="{{url('/')}}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{url('/')}}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{url('/')}}/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{url('/')}}/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{url('/')}}/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{url('/')}}/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{url('/')}}/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{url('/')}}/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link href="{{url('/')}}/css/custom.css" rel="stylesheet">
    
    <style>
      
     body{
        background-image: url("{{url('/')}}/img/fondologin.jpg") !important;
        width: 100%;
        height: 100%;
        background-attachment: fixed;
      }
      .nav_menu2{
        background-image: url("{{url('/')}}/img/sidebar.png")
      }
    </style>
    
    @yield('css')
  </head>

  <body class="nav-md footer_fixed">
    <div class=" container-l body">
      <div class="main_container-l">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{route('home')}}" class="site_title"><img src="{{url('/')}}/images/LogoInd.png" alt="LogoIvanAgro"> <span>IVANagro</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_info">
                <span>Bienvenid@,</span>
                <h2>{{ Auth::user()->name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br/>

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                @if(auth()->user()->Rol_id == 1)
                  <h3>Administrador</h3>
                  <ul class="nav side-menu">
                    <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</span></a>
                    <li><a href="{{route('user.index')}}"><i class="fa fa-male"></i> Usuarios</span></a>
                    <li><a href="{{route('asignar.index')}}"><i class="fa fa-pencil"></i> Asignación</span></a>
                      <li><a href="{{route('informes')}}"><i class="fa fa-line-chart"></i> Informes</span></a>
                    <li><a href="{{route('conteos.index')}}"><i class="fa fa-binoculars"></i> Conteos</span></a>
                    </li>
                  </ul>
                @else
                  <h3>General</h3>
                  <ul class="nav side-menu">
                    <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</span></a>
                    <li><a href="{{route('conteos.index')}}"><i class="fa fa-binoculars"></i> conteos</span></a>
                    </li>
                  </ul>
                @endif
              </div>
            </div>
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                <span class="text-light glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu nav_menu2 menu_fixed">
                <div class="nav toggle">
                  <a id="menu_toggle" style="color:white;"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open text-light" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right text-light" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="{{route('edit', Auth::user()->id)}}"> Perfil </a>
                      <a class="dropdown-item"  href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                  <i class="fa fa-sign-out pull-right"></i> Cerrar sección
                        </a>
                    </div>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            IVANagro S.A {{-- <a href="https://colorlib.com">Colorlib</a> --}}
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

  

    <!-- jQuery -->
    <script src="{{url('/')}}/vendors/jquery/dist/jquery.min.js"></script>
    
    <!-- Bootstrap -->
   <script src="{{url('/')}}/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="{{url('/')}}/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{url('/')}}/vendors/nprogress/nprogress.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="{{url('/')}}/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

    {{-- sweetalert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')
    
    <!-- iCheck -->
    <script src="{{url('/')}}/vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="{{url('/')}}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{url('/')}}/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{url('/')}}/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{url('/')}}/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="{{url('/')}}/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{url('/')}}/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{url('/')}}/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{url('/')}}/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{url('/')}}/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{url('/')}}/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{url('/')}}/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="{{url('/')}}/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="{{url('/')}}/vendors/jszip/dist/jszip.min.js"></script>
    <script src="{{url('/')}}/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{url('/')}}/vendors/pdfmake/build/vfs_fonts.js"></script>

    <script>
      
      $(document).ready(function() {
        var table = $('.tbl').DataTable({
            "responsive": false,
            "language": {
                "lengthMenu": "Mostrar"+ `
                    <select class="custom-select custom-select-sm form-select form-select-sm">
                        <option value="10" selected>10</option>    
                        <option value="25">25</option>    
                        <option value="50">50</option>    
                        <option value="100">100</option>    
                        <option value="-1">Todos</option>
                    </select>
                ` +"registros por página",
                "zeroRecords": "No hay registros por mostrar",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate": {
                    'next': 'Siguiente',
                    'previous': 'Anterior'
                }
            }
        });
      });
    </script>

    @yield('js')
    <!-- Custom Theme Scripts -->
    <script src="{{url('/')}}/js/custom.min.js"></script>

  </body>
</html>
