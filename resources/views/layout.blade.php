<!DOCTYPE html>
<meta charset="utf-8">
<title>Filartiga - Cárdenas</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://code.jquery.com/jquery-3.1.1.js">
<link rel="stylesheet" href="https://code.jquery.com/jquery-3.1.1.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{asset("css/style.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("css/AdminLTE.css")}}">
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
<link rel="stylesheet" href="{{asset("css/select2.min.css")}}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{asset("css/dataTables.min.css")}}">
<link rel="stylesheet" href="{{asset("css/select2.min.css")}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset("css/bootstrap-toggle.min.css")}}" rel="stylesheet" />

       @if (auth()->check())
       <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav class="sidebar-menu" data-widget="tree" id="sidebar">
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
            {{-- <li>
              <a href="{{ route('subMant') }}"><i class="fa fa-cube fa-2x"></i> Mantenedores</a>
            </li> --}}
            <li class="treeview">
                <a href="#">
                  <i class="fa fa-cogs"></i>
                  <span>Mantenimiento</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li>Empleados</li>
                  <li><a href="{{ route('rubros.create') }}"><i class="fa fa-gear"></i>Rubros</a></li>
                  <li><a href="{{ route('materiales.create') }}"><i class="fa fa-cube"></i>Materiales</a></li>
                  <li><a href="{{ route('maquinarias.create') }}"><i class="fa fa-truck"></i>Maquinarias</a></li>
                  <li><a href="{{ route('herramientas.create') }}"><i class="fa fa-wrench"></i>Herramientas</a></li>
                </ul>
              </li>
            @endif
            @if (auth()->user()->hasPermission(['sec']))
            {{-- <li>
              <a href="{{ route('userRole') }}"><i class="fa fa-gear fa-2x"></i> Seguridad</a>
            </li> --}}
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-users"></i>
                  <span>Seguridad</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{ route('users.create') }}"><i class="fa fa-user"></i>Usuarios</a></li>
                  <li><a href="{{ route('roles.index') }}"><i class="fa fa-flag"></i>Roles</a></li>
                </ul>
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
      <script src="{{ asset('js/adminlte.min.js') }}"></script>
      <script src="{{ asset('js/bootstrap-toggle.min.js') }}"></script>
      <script src="{{ asset('js/select2.min.js') }}"></script>

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

       function myFunction(){
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("tablaRubros");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }       
          }       
       }
     </script>
     @stack('scripts')