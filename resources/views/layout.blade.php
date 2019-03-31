<!DOCTYPE html>
<meta charset="utf-8">
<title>Filartiga - Cárdenas</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{asset("css/style.css")}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{asset("css/dataTables.min.css")}}">
       @if (auth()->check())
       <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
          <div class="sidebar-header">
            <h3>Menu de accesos</h3>
          </div>

          <ul class="list-unstyled components">
            {{-- <p>Dummy Heading</p> --}}
            <li class="active">
              <a class="navbar" href="{{ url('home') }}">Constructora Filartiga-Cárdenas</a>
            </li>
            @if (auth()->check())
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ auth()->user()->name }}<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="/logout">Cerrar Sesión</a></li>
              </ul> 
            </li>
            @if (auth()->user()->hasPermission(['obras']))

            <li>
              <a href="{{ route('obras.create') }}"><i class="fa fa-home fa-2x"></i> Obras</a>
            </li>
            @endif
            @if (auth()->user()->hasPermission(['storage']))
            <li>
              <a href="{{ route('storages.create') }}"><i class="fa fa-industry fa-2x"></i> Almacen</a>
            </li>
            
            @endif
            @if (auth()->user()->hasPermission(['fact']))
            <li>
              <a href="{{ route('subMant') }}"><i class="fa fa-address-card fa-2x"></i> Facturas</a>
            </li>
            
            @endif
            @if (auth()->user()->hasPermission(['mant']))
            <li>
              <a href="{{ route('subMant') }}"><i class="fa fa-cube fa-2x"></i> Mantenedores</a>
            </li>
            
            @endif
            @if (auth()->user()->hasPermission(['sec']))
            <li>
              <a href="{{ route('userRole') }}"><i class="fa fa-gear fa-2x"></i> Seguridad</a>
            </li>
            
            @endif
            @endif
          </ul>

        </nav>
        <!-- Page Content Holder -->
        <div id="content">
          <nav class="">
            <div class="">

              <div class="navbar-header">
                <button type="button" id="sidebarCollapse" class="navbar-btn">
                  <span></span>
                  <span></span>
                  <span></span>
                </button>
              </div>

              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              </div>
            </div>
          </nav>

        </div>
      {{-- </body> --}}
      @endif
      @yield('contenido')
      <!-- jQuery CDN -->
      <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
      <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
      <!-- Bootstrap Js CDN -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
      <script type="text/javascript">
       $(document).ready(function () {
         $('#sidebarCollapse').on('click', function () {
           $('#sidebar').toggleClass('active');
           $(this).toggleClass('active');
         });
       });
     </script>
     @stack('scripts')