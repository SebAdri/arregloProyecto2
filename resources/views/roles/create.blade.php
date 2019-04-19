  @extends('layout')

  @section('contenido')
  <div class="row">
    
      <div class="container">
        <div class="row">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="row">
                <div class="col-md-7 col-md-offset-3">
                  <h1>Administración de Roles</h1>
                </div>

              </div>
            </div>

            <div class="panel-body">
              <form method="POST" action="{{ route('roles.store') }}">
                {!! csrf_field() !!}
                @include('roles.partials.permission-part')
              </form>
            </div>
          </div>    

        </div>
      </div>
    </div>
    </div>
  </div>

@push('scripts')
<script type="text/javascript">
  $("#volver").click(function(){
    $.ajax({
      url: "{{url()->current()}}",
      success: function(){
        window.location.replace("{{ route('userRole') }}");
      }
    })
  })

</script>
@endpush
@endsection