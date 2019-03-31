
@extends('layout')

@section('contenido')
<br>
<br>
<br>
<br>
    <div class="container" id="email">
        <div class=''col-md-3 col-md-offset-4''>
            <div class="col-md-9 col-md-offset-2">
                <div class="well" id="fondo">  
                    <label class="col-md-offset-1" style="margin-bottom: 25px">
                        Ingrese su dirección de correo electrónico y le enviaremos un link para reestablecer su contraseña
                    </label>
                     
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-offset-3">
                                <label for="email" class="col-md-2">Email</label>
                                    <div class="input-group">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Correo Electrónico" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback errors" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>

                        </div>

                        <div class="form-group row mb-0">
                            <br>
                            <div class="col-md-5 col-md-offset-5">
                                    <button type="submit" class="btn button-primary">
                                        {{ __('Enviar') }}
                                    </button>
                            </div>
                        </div>                       
                    </form>
                    </div>    
                </div>
            </div>
        </div>
    </div>
@endsection
