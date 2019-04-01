@extends('layout')

@section('contenido')
<br>
<br>
<br>
<br>
  <div class="container" id="login">
    <div class=''col-md-3 col-md-offset-4">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel-body">
          <div class="well" id="fondo">   
            <form method="POST" action="login" >          
               {!! csrf_field() !!}  
               <div class="row">
                  <div class="col-md-6 col-md-offset-3"> 
                    <br>
                     <label for="email">Email</label>
                        <div class="input-group" style="margin-bottom: 10px">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Correo Electrónico">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback errors error" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                
                         </div>
                  </div>
               </div>
            
            <div class="row">    
               <div class="col-md-6 col-md-offset-3">
                  <div class="form-group">            
                     <label for="password">Contraseña</label>
                        <div class="input-group" style="margin-bottom: 20px">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                           <input type="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Contraseña" required>

                            @if ($errors->has('password'))
                                    <span class="invalid-feedback errors error" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif  
                        </div>
                  </div>
               </div>
            </div>

            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                      <label class="form-check-label" for="remember" style="margin-bottom: 10px">
                          {{ __('Recordar Contraseña') }}
                      </label>
                </div>
              </div>
           </div>

          <div class="form-group row mb-0">
            <div class="col-md-8 col-md-offset-3">
              <input type="submit" class="btn button-primary" value="Iniciar Sesión"></input>
              <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('¿Olvidaste tu contraseña?') }}
              </a> 
            </div>
          </div>

         </form>
      </div>
        </div>  

    </div>
  </div>
</div>

@stop



