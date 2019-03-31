@extends('layout')

@section('contenido')

<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1>Obras</h1>
      </div>
     
      <div class="panel-body">
        <div class="row">
          <div class="col-md-offset-11">
            <button type="button"class="btn button-primary" title="Agregar Nuevo" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" style="font-size:30px;"></i></button>
          </div>
        </div>
        
       <br>
 

    <table class="table table-responsive">
    <thead>
      <tr>
        <th>Proyecto</th>
        <th>Cliente</th>
        <th>Fecha de Inicio</th>
        {{-- <th>Fecha Fin</th> --}}
        <th>Acción</th>
        {{-- <th>Opciones</th> --}}
      </tr>
    </thead>
          
    <tbody>
      @foreach($obras as $obra)
          <tr>
            <td>{{ $obra->nombre_proyecto }}</td>
            <td>{{ $obra->cliente->nombre }}</td>
            <td>{{ $obra->fecha_inicio }}</td>
           {{--  <td>{{ $obra->fecha_fin }}</td>
            <td> --}}
              
            <td>
              <a ><button type="button" title="Editar"  data-toggle="modal" data-target="#editar{{ $obra->id }}" href="{{ route('obras.edit', $obra->id) }}" class="btn button-primary btn-rounded btn-sm my-0"><i class="fa fa-edit" style="font-size:20px;"></i></button></a>



                <a href="{{ route('documentos.show', $obra->id) }}">
                <button type="button" title="Documentos" class="btn button-primary btn-rounded btn-sm my-0"><i class="fa fa-file" style="font-size:20px"></i></button></a><a href="{{ route('obras.show', $obra->id) }}"> <button type="button" title="Empleados" class="btn button-primary btn-rounded btn-sm my-0"><i class="fa fa-users" style="font-size:20px;"></i></button></a><a href=""> <button type="button" title="Almacen de la obra" class="btn button-primary btn-rounded btn-sm my-0"><i class="fa fa-wrench" style="font-size:20px;"></i></button></a>
            </td>
          </tr>

      @endforeach

    </tbody>
  </table>

    </div>
  </div>
</div>
</div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="panel panel-default">
          <form method="POST" action="{{ route('obras.store') }}">
            {!! csrf_field() !!}

            <div class="panel-heading">
              <h1>Nuevo Proyecto</h1>
            </div>

            <div class="panel-body">
              <div class="row">
                <div class="col-md-5 col-md-offset-4">
                  <label for="Descripcion">Nombre Proyecto</label>
                  <input type="text" class="form-control{{ $errors->has('nombre_proyecto') ? ' is-invalid' : '' }}" name="nombre_proyecto" value="" placeholder="Nombre del Proyecto" required>
                    @if ($errors->has('nombre_proyecto'))
                      <span class="invalid-feedback errors" role="alert">
                        <strong>{{ $errors->first('nombre_proyecto') }}</strong>
                      </span>
                      @endif
                </div>
              </div>

              <div class="row">
                <div class="col-md-5 col-md-offset-4">
                  <label for="Coste" style="margin-top: 10px">Cliente</label>
                  <div class="form-group">
                  <select class="form-control" id="cliente_id" name="cliente_id">
                      @foreach ($clientes as $cliente) 
                        @if($cliente->estado == 1)
                          <option value={{$cliente->id}}>{{$cliente->nombre}}</option> 
                        @endif
                      @endforeach
                  </select>
                </div>


                </div>
              </div>

              <div class="row">
                <div class="col-md-5 col-md-offset-4">
                  <label for="minimo" style="margin-top: 10px">Fecha Inicio</label>
                  <input type="date"class="form-control {{ $errors->has('fecha_inicio') ? ' is-invalid' : '' }}" name="fecha_inicio" value="" required>
                    @if ($errors->has('fecha_inicio'))
                      <span class="invalid-feedback errors" role="alert">
                        <strong>{{ $errors->first('fecha_inicio') }}</strong>
                      </span>
                      @endif
                </div>
              </div>

{{--               <div class="row">
                <div class="col-md-5 col-md-offset-4">
                  <label for="minimo" style="margin-top: 10px">Fecha Fin</label>
                  <input type="date"class="form-control" name="fecha_fin" value="">
                </div>
              </div>
 --}}
              <div class="row">
                <div class="col-md-5 col-md-offset-4">
                  <input class="btn button-primary" value="Guardar" type="submit" style="margin-top: 20px">
                  <button type="button" class="btn button-primary" data-dismiss="modal"  name="button" style="margin-top: 20px">Cancelar</button>
                </div>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>


@foreach($obras as $obra)
<form method="POST" action="{{ route('obras.update', $obra->id) }}">
    {!! csrf_field() !!}
    {!! method_field('PUT') !!}

  <div id="editar{{ $obra->id }}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="panel panel-default">
            <div class="panel-heading">
              <h1>Proyecto</h1>
            </div>

            <div class="panel-body">
              <div class="row">
                <div class="col-md-5 col-md-offset-4">
                  <label for="Descripcion">Nombre Proyecto</label>
                  <input type="text" class="form-control{{ $errors->has('nombre_proyecto') ? ' is-invalid' : '' }}" name="nombre_proyecto" value="{{$obra->nombre_proyecto}}" placeholder="Nombre del Proyecto" required>
                    @if ($errors->has('nombre_proyecto'))
                      <span class="invalid-feedback errors" role="alert">
                        <strong>{{ $errors->first('nombre_proyecto') }}</strong>
                      </span>
                      @endif
                </div>
              </div>

              <div class="row">
                <div class="col-md-5 col-md-offset-4">
                  <label for="Coste" style="margin-top: 10px">Cliente</label>
                  <div class="form-group">
                  <select class="form-control" id="cliente_id" name="cliente_id">
                      @foreach ($clientes as $cliente) 
                        @if($cliente->estado == 1)
                          <option value={{$cliente->id}}>{{$cliente->nombre}}</option> 
                        @endif
                      @endforeach
                  </select>
                </div>


                </div>
              </div>

              <div class="row">
                <div class="col-md-5 col-md-offset-4">
                  <label for="minimo" style="margin-top: 10px">Fecha Inicio</label>
                  <input type="date"class="form-control {{ $errors->has('fecha_inicio') ? ' is-invalid' : '' }}" name="fecha_inicio" value="{{$obra->fecha_inicio}}" required>
                    @if ($errors->has('fecha_inicio'))
                      <span class="invalid-feedback errors" role="alert">
                        <strong>{{ $errors->first('fecha_inicio') }}</strong>
                      </span>
                      @endif
                </div>
              </div>

{{--               <div class="row">
                <div class="col-md-5 col-md-offset-4">
                  <label for="minimo" style="margin-top: 10px">Fecha Fin</label>
                  <input type="date"class="form-control" name="fecha_fin" value="">
                </div>
              </div> --}}

              <div class="row">
                <div class="col-md-5 col-md-offset-4">
                  <input class="btn button-primary" value="Guardar" type="submit" style="margin-top: 20px">
                  <button type="button" class="btn button-primary" data-dismiss="modal"  name="button" style="margin-top: 20px">Cancelar</button>
                </div>
              </div>

            </div>
</div>
</div>
</div>
</div>
</div>
</form>
@endforeach

@stop


      