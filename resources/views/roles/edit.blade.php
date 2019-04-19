@extends('layout')

@section('contenido')
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
          <form method="POST" action="{{ route('roles.update', $role->id) }}">
            {!! csrf_field() !!}
            {!! method_field('PUT') !!}
            @include('roles.partials.permission-part')

          </form>
        </div>
      </div>    

    </div>
  </div>
</div>
</div>
@endsection
