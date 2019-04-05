@extends('layout')

@section('contenido')

<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1>Rubros</h1>
      </div>
     
      <div class="panel-body">
        <div class="row">
          <div class="col-md-offset-9">
            <button type="button"class="btn button-primary" data-toggle="modal" data-target="#myModal" style="margin-top: 10px">Agregar Familia de Rubros</button>
          </div>
        </div>
        
       <br>
 

    <table class="table table-responsive">
    <thead>
      <tr>
        <th>Familia de Rubros</th>
        <th>Acciones</th>
      </tr>
    </thead>
          
    <tbody>
      @foreach($fliaRubros as $fliaRubro)
          <tr>
            <td>{{ $fliaRubro->nombre }}</td>
            <td>
              <a class="btn button-primary" href="{{ route('rubros.edit', $fliaRubro->id) }}" title="Agregar Rubros"><i class="fa fa-plus" style="font-size:19px;"></i></button> 
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
          <form method="POST" action="storeFliaRubros">
            {!! csrf_field() !!}

            <div class="panel-heading">
              <h1>Familia de Rubros</h1>
            </div>

            <div class="panel-body">
              <div class="row">
                <div class="col-md-5 col-md-offset-4">
                  <label for="Descripcion">Nombre</label>
                  <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="" placeholder="Nombre" required>
                    @if ($errors->has('nombre'))
                      <span class="invalid-feedback errors" role="alert">
                        <strong>{{ $errors->first('nombre') }}</strong>
                      </span>
                      @endif
                </div>
              </div>
            
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



@stop


      