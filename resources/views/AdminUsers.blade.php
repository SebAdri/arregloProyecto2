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
        <div class="col-md-4 col-md-offset-2">
         <div class="card bg-primary text-white" id="users">
            <div class="card-body">
              <h3 class="card-title text-center">Usuarios</h3>
              <p class="card-text text-center"><i class="fa fa-users fa-5x"></i></p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card bg-primary text-white " id="roles">
            <div class="card-body">
              <h3 class="card-title text-center">Roles</h3>
              <p class="card-text text-center"><i class="fa fa-gear fa-5x"></i></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <footer>Copyright ® {{ date('Y') }}</footer>
    </div>
  </div>
</div>
@push('scripts')
  <script type="text/javascript">
    $("#users").click(function(){
      $.ajax({
        url: "{{url()->current()}}",
        success: function(){
          window.location.replace("{{ route('users.create') }}");
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
    $("#roles").click(function(){
      $.ajax({
        url: "{{url()->current()}}",
        success: function(){
          window.location.replace("{{ route('roles.create') }}");
        }
      })
    });
  </script>
  {{-- expr --}}
@endpush

@endsection

