@extends('layout')

@section('contenido')

{{--  <a href="{{ route('users.create') }}"><button class="btn btn-success col-md-s col-md-offset-3">Administrar Usuarios</button></a> --}}
  {{-- <a href="{{ route('') }}"><button class="btn btn-success">Administrar Roles</button></a> --}}

<div class="container">
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-7 col-md-offset-3">
          <h2>SELECCIONE LA ACCIÓN A REALIZAR</h2>
        </div>
      </div>
      <hr>
      <div class="row">
        @if (auth()->user()->hasPermission(['empl']))

          <div class="col-md-4">
           <div class="card bg-primary text-white" id="empl">
              <div class="card-body">
                <h3 class="card-title text-center">Empleados</h3>
                <p class="card-text text-center"><i class="fa fa-user fa-5x"></i></p>
              </div>
            </div>
          </div>
        @endif
        @if (auth()->user()->hasPermission(['obras']))
          <div class="col-md-4">
           <div class="card bg-primary text-white" id="maq">
              <div class="card-body">
                <h3 class="card-title text-center">Maquinarias</h3>
                <p class="card-text text-center"><i class="fa fa-truck fa-5x"></i></p>
              </div>
            </div>
          </div>
        
        @endif
        @if (auth()->user()->hasPermission(['obras']))
          <div class="col-md-4">
            <div class="card bg-primary text-white " id="rubro">
              <div class="card-body">
                <h3 class="card-title text-center">Rubros</h3>
                <p class="card-text text-center"><i class="fa fa-gear fa-5x"></i></p>
              </div>
            </div>
          </div>
        @endif
        @if (auth()->user()->hasPermission(['obras']))
          <div class="col-md-4">
            <div class="card bg-primary text-white " id="materiales">
              <div class="card-body">
                <h3 class="card-title text-center">Materiales</h3>
                <p class="card-text text-center"><i class="fa fa-cube fa-5x"></i></p>
              </div>
            </div>
          </div>
        @endif
         @if (auth()->user()->hasPermission(['mant']))
          <div class="col-md-4">
            <div class="card bg-primary text-white " id="herramientas">
              <div class="card-body">
                <h3 class="card-title text-center">Herramientas</h3>
                <p class="card-text text-center"><i class="fa fa-wrench fa-5x"></i></p>
              </div>
            </div>
          </div>
        @endif
      @if (auth()->user()->hasPermission(['mant']))
          <div class="col-md-4">
            <div class="card bg-primary text-white " id="clientes">
              <div class="card-body">
                <h3 class="card-title text-center">Clientes</h3>
                <p class="card-text text-center"><i class="fa fa-users fa-5x"></i></p>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
    <div class="panel-footer">
      <footer>Copyright ® {{ date('Y') }}</footer>
    </div>
  </div>
</div>
@push('scripts')
  {{-- expr --}}
  <script type="text/javascript">
    $("#empl").click(function(){
      $.ajax({
        url: "{{url()->current()}}",
        success: function(){
          window.location.replace("{{ route('empleados.create') }}");
        }
      })
    });
    $("#maq").click(function(){
      $.ajax({
        url: "{{url()->current()}}",
        success: function(){
          window.location.replace("{{ route('maquinarias.create') }}");
        }
      })
    });
    $("#rubro").click(function(){
      $.ajax({
        url: "{{url()->current()}}",
        success: function(){
          window.location.replace("{{ route('rubros.create') }}");
        }
      })
    });
     $("#clientes").click(function(){
      $.ajax({
        url: "{{url()->current()}}",
        success: function(){
          window.location.replace("{{ route('clientes.create') }}");
        }
      })
    });
   // $( ".card" ).hover(
   //    function() {
   //      $( this ).append( $( "<span> ***</span>" ) );
   //    }, function() {
   //      $( this ).find( "span:last" ).remove();
   //    }
   //  );
    $("#materiales").click(function(){
      $.ajax({
        url: "{{url()->current()}}",
        success: function(){
          window.location.replace("{{ route('materiales.create') }}");
        }
      })
    });
  </script>
@endpush

@endsection

