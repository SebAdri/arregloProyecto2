@extends('layout')

@section('contenido')


{{--   @if (auth()->user()->hasRoles('admin'))
    <a href="{{ route('users.create') }}"><button class="btn btn-success col-md-s col-md-offset-3">Administrar Usuarios</button></a>
    <a href="{{ route('roles.create') }}"><button class="btn btn-success">Administrar Roles</button></a>

  @endif

  <a href="{{ route('roles.create') }}"><button class="btn btn-success">Almacen</button></a>


<a href="{{ route('users.create') }}"><button class="btn btn-success col-md-s col-md-offset-3">Administrar Usuarios</button></a>
<a href="{{ route('') }}"><button class="btn btn-success">Administrar Roles</button></a>  --}}


<form>
  <div class="container">
    <form>
      <div class="x_panel" style="width: 100%; height: 100%">
        <h1>BIENVENIDO</h1>
        {{-- <hr> --}}
        <div class="x_title"></div>
      </div>
      <div class="x_content">
      </div>
    </form>
    {{-- <div class="panel panel-default">
      <div class="row">
        <div class="panel-heading">
          <hr>
        </div>
      </div>
      <div class="panel-body">
      </div>
      <div class="panel-footer">
      </div>
    </div> --}}
  </div>
</form>

<!-- Trigger the modal with a button -->
{{-- button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> --}}

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

