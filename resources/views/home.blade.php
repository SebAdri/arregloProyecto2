@extends('layout')

@section('contenido')


{{--   @if (auth()->user()->hasRoles('admin'))
    <a href="{{ route('users.create') }}"><button class="btn btn-success col-md-s col-md-offset-3">Administrar Usuarios</button></a>
    <a href="{{ route('roles.create') }}"><button class="btn btn-success">Administrar Roles</button></a>

  @endif

  <a href="{{ route('roles.create') }}"><button class="btn btn-success">Almacen</button></a>


<a href="{{ route('users.create') }}"><button class="btn btn-success col-md-s col-md-offset-3">Administrar Usuarios</button></a>
	 <a href="{{ route('') }}"><button class="btn btn-success">Administrar Roles</button></a>  --}}


<div class="container">
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
          <div class="panel-heading">
            <h1>BIENVENIDO</h1>
          </div>
      </div>
      <hr>
      {{-- <div class="row">
        @if (auth()->user()->hasPermission(['obras']))
            <div class="col-md-4">
             <div class="card bg-primary text-white " id="obras">
                <div class="card-body">
                  <h3 class="card-title text-center">Obras</h3>
                  <p class="card-text text-center"> </p>
                </div>
              </div>
            </div>
          @endif
          @if (auth()->user()->hasPermission(['sec']))
            <div class="col-md-4">
              <div class="card bg-primary text-white " id="users">
                <div class="card-body">
                  <h3 class="card-title text-center">Seguridad</h3>
                  <p class="card-text text-center"><i class="fa fa-users fa-1x"></i><i class="fa fa-gear fa-1x"></i></p>
                </div>
              </div>
            </div>
          @endif
        @if (auth()->user()->hasPermission(['set']))
          <div class="col-md-4">
            <div class="card bg-primary text-white" id="herramientas">
              <div class="card-body">
                <h3 class="card-title text-center">Herramientas</h3>
                <p class="card-text text-center"><i class="fa fa-wrench fa-5x"></i><i class="fa fa-gavel fa-5x"></i></p>
              </div>
            </div>
          </div>
        @endif
      </div>
      <div class="row">
        @if (auth()->user()->hasPermission(['mant']))
           <div class="col-md-4 col-md-offset-2" id="subMant">
            <div class="card bg-primary text-white ">
              <div class="card-body">
                <h3 class="card-title text-center">Mantenedores</h3>
                <p class="card-text text-center"><i class="fa fa-cube fa-5x"></i></p>
              </div>
            </div>
          </div>
        @endif
        @if (auth()->user()->hasPermission(['em']))
          <div class="col-md-4">
            <div class="card bg-primary text-white">
              <div class="card-body">
                <h3 class="card-title text-center">Empleados</h3>
                <p class="card-text text-center"><i class="fa fa-male fa-5x"></i><i class="fa fa-male fa-5x"></i></p>
              </div>
            </div>
          </div>
        @endif
      </div> --}}
    </div>
    <div class="panel-footer">
      <footer>Copyright ® {{ date('Y') }}</footer>
    </div>
  </div>
</div>
{{-- <script type="text/javascript">
  $("#users").click(function(){
    $.ajax({
      url: "/",
      success: function(){
        window.location.replace("{{ route('userRole') }}");
      }
    })
  });
  $("#obras").click(function(){
    $.ajax({
      url: "/",
      success: function(){
        window.location.replace("{{ route('obras.create') }}");
      }
    })
  });
  $("#subMant").click(function(){
    $.ajax({
      url: "/",
      success: function(){
        window.location.replace("{{ route('subMant') }}");
      }
    })
  });
 $( ".card" ).hover(
  function() {
    $( this ).append( $( "<span> ***</span>" ) );
  }, function() {
    $( this ).find( "span:last" ).remove();
  }
);
</script>
 --}}
@stop

