@extends('layout')

@section('contenido')
    <br>
<br>
<br>
<br>
    <div class="container" id="email">
        <div class=''col-md-3 col-md-offset-4''>
            <div class="col-md-5 col-md-offset-3">
                <div class="well" id="fondo">  
                    <label class="col-md-offset-3" style="margin-bottom: 25px">
                        Reestablecer contraseña
                    </label>

                    <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf
                        
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row">
                            <div class="col-md-offset-1" style="margin-bottom: 25px">
                                <label for="email" class="col-md-5" >Email</label>
                                    <div class="input-group">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback errors" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                         @endif
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-offset-1" style="margin-bottom: 25px">
                                <label for="password" class="col-md-5">Contraseña</label>
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback errors" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-offset-1" style="margin-bottom: 25px">
                                <label for="password" class="col-md-5">Confirmar Contraseña</label>
                                    <div class="input-group">
                                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <br>
                            <div class="col-md-4 col-md-offset-3">
                                    <button type="submit" class="btn button-primary">
                                        {{ __('Reestablecer Contraseña') }}
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
