<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/ico" />
    {{-- del layout antiguo --}}
    <link rel="stylesheet" type="text/css" href="{{asset("css/style.css")}}">
    <link rel="stylesheet" href="{{asset("/css/select2.min.css")}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset("css/dataTables.min.css")}}">
    <script src="https://kit.fontawesome.com/31dfeb78b4.js"></script>

    {{-- del layout antiguo --}}

    <title>F&C! | Asociados</title>

    <!-- Bootstrap -->
    <link href="{{asset('bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('iCheck/skins/flat/green.css')}}" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{asset('bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('css2/custom.min.css')}}" rel="stylesheet">
  </head>

  @if (auth()->check())
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span style="font-size: 80%">Filártiga&Cárdenas!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                {{-- <img src="images/img.jpg" alt="..." class="img-circle profile_img"> --}}
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                  <h2>{{ auth()->user()->name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  @if (auth()->user()->hasPermission(['obras']))
                  <li><a><i class="fa fa-home"></i> Inicio <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('proyectos.create') }}"><i class="fas fa-drafting-compass fa-2x"></i> Proyectos</a></li>
                      <li><a href="{{ route('obras.create') }}"><i class="fa fa-home fa-2x"></i> Obras</a></li>
                    </ul>
                  </li>
                  @endif
                  @if (auth()->user()->hasPermission(['storage']))
                  <li><a><i class="fa fa-edit"></i> Almacen <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('almacenGeneral.create') }}"><i class="fa fa-industry fa-2x"></i> General o Principal</a></li>
                    </ul>
                  </li>
                  @endif
                  {{-- falta autenticacion --}}
                  <li><a><i class="fas fa-dollar-sign"></i> Pagos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('pagos.index') }}"><i class="fa fa-table fa-2x"></i> Lista de Pagos</a></li>
                    </ul>
                  </li>
                  {{-- falta autenticacion --}}
                  <li><a><i class="fas fa-dollar-sign"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('mostrarAvance') }}"><i class="fa fa-table fa-2x"></i> Reportes</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Mantenimiento</h3>
                <ul class="nav side-menu">
                  @if (auth()->user()->hasPermission(['mant']))
                  <li><a><i class="fa fa-windows"></i> Parámetros del Sistema <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('rubros.create') }}"><i class="fa fa-gear"></i>Rubros</a></li>
                      <li><a href="{{ route('materiales.create') }}"><i class="fa fa-cube"></i>Materiales</a></li>
                      <li><a href="{{ route('maquinarias.create') }}"><i class="fa fa-truck"></i>Maquinarias</a></li>
                      <li><a href="{{ route('herramientas.create') }}"><i class="fa fa-wrench"></i>Herramientas</a></li>
                      <li><a href="{{ route('clientes.create') }}"><i class="fa fa-user"></i>Clientes</a></li>
                      <li><a href="{{ route('profesiones.create') }}"><i class="fa fa-user"></i>Profesiones</a></li>
                      <li><a href="{{ route('empleados.create') }}"><i class="fa fa-user"></i>Empleados</a></li>
                      {{-- <li><a href="{{ route('empleados.create') }}"><i class="fa fa-user"></i>Famili</a></li> --}}
                    </ul>
                  </li>
                  @endif
                </ul>
              </div>
              <div class="menu_section">
                <h3>Seguridad</h3>
                <ul class="nav side-menu">
                  @if (auth()->user()->hasPermission(['sec']))
                  <li><a><i class="fa fa-bug"></i> Permisos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('users.create') }}"><i class="fa fa-user"></i>Usuarios</a></li>
                      <li><a href="{{ route('roles.index') }}"><i class="fa fa-flag"></i>Roles</a></li>
                    </ul>
                  </li>
                  @endif
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="#" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt="">{{ auth()->user()->name }} <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    {{-- <li><a href="#"> Profile</a></li>
                    <li><a href="#"><span class="badge bg-red pull-right">50%</span><span>Settings</span></a></li>
                    <li><a href="#">Help</a></li> --}}
                    <li><a href="/logout"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        @endif

        <!-- page content -->
        <div class="right_col" role="main">
		    
        @yield('contenido')

          
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Filártiga&Cárdenas - Construyendo el futuro de su <a href="https://colorlib.com">vivienda</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('nprogress/nprogress.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset('bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{asset('skycons/skycons.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{asset('jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('moment/min/moment.min.js')}}"></script>
    <script src="{{asset('bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{asset('js2/custom.min.js')}}"></script>

    {{-- del layput antiguo --}}
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}

    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

      <script src="{{ asset('js/select2.min.js') }}"></script>
      <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
      {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}

    {{-- jquery para exportar a pdf --}}
    {{-- <script src="{{ asset('DataTables') }}"></script> --}}

    {{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.19/js/  jquery.dataTables.min.js"></script> --}}
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

    {{-- del layput antiguo --}}
     @stack('scripts')
	 
  </body>
</html>
