@extends('layout')

@section('contenido')


<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-7 col-md-offset-2">
            <h1>Empleados de Obra</h1>
          </div>
          
        </div>
      </div>
     
      <div class="panel-body">
        <div class="row">
            <h4 class="col-md-5 col-md-offset-1"  style="margin-bottom: 20px">Obra: {{$obra->nombre_proyecto}}</h4>
          <div class="col-md-offset-10">
            <a href="{{ route('empleados.create') }}"> <button type="button"class="btn button-primary" title="Agregar Empleado"><i class="fa fa-plus" style="font-size:30px;"></i></button></a>


          </div>
        </div>
        <br>

        <table class="table table-responsive">
          <thead>
            <tr>
              <th>Empleado</th>
              <th>Acción</th>
            </tr>
          </thead>

            <tbody>
              @foreach($empleadosObras as $empleado)
                <tr>
                  <td>{{ $empleado->primerNombre .' '.$empleado->primerApellido }}</td>
                  <td>
                    <form style="display: inline" method="GET" action="{{ route('desvincular', array($obra, $empleado->id) ) }}">
                      
                      {!! csrf_field() !!}

                      <button type="submit" title="Desvincular Empleado" class="btn button-primary btn-rounded btn-sm my-0"><i class="fa fa-trash" style="font-size:24px;"></i></button></td>
                    </form>
                  </td>
                </tr>
              @endforeach
          </tbody>
        </table>



      </div>
    </div>    
  </div>
</div>


{{-- @foreach($empleados as $empleado) --}}
{{--   <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;">Asignar empleados a obras</h4>
      </div>
      <div class="modal-body">

        <form method="POST" action="{{ route('empleados.create') }}">
        {!! csrf_field() !!}
        <div class="row">
          <div class="col-md-6 col-md-offset-4">
            <label for="nombre">Empleado</label>
            <div class="form-group">
                <select class="form-control" id="empleado_id" name="empleado_id">
                  @foreach ($empleados as $empleado) 
                    <option value={{$empleado->id}}></option> 
                  @endforeach
                </select>
              </div>

          </div>

          <div class="col-md-4 col-md-offset-4">
            <input class="btn button-primary" value="Asignar" type="submit" style="margin-top: 20px">
            <button type="button" class="btn button-primary" data-dismiss="modal"  name="button" style="margin-top: 20px">Cancelar</button>
          </div>
          
        </div>
        </form>
      </div>

    </div>

  </div>
</div> --}}
{{-- @endforeach --}}


@stop