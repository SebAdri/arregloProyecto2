            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#home">Datos</a></li>
              <li><a data-toggle="tab" href="#menu1">Permisos</a></li>
              {{-- <li><a data-toggle="pill" href="#menu2">Menu 2</a></li> --}}
            </ul> 

            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">
                <div class="row">
                  <div class="col-sm-12">
                    <label for="func">Rol</label>
                    <div class="input-group">
                      <input type="text" name="rol" class="form-control"  value="@isset ($role) {{$role->role}}
                      
                      @endisset" placeholder="Rol">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8">
                    <label for="func">Nombre</label>
                    <div class="input-group">
                      <input type="text" name="nombre_rol" class="form-control" value="@isset ($role) {{$role->role_name}}
                      
                      @endisset" placeholder="Nombre del rol">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8">
                    <label for="func">Descripción</label>
                    <div class="input-group">
                      <input type="text" name="desc" class="form-control" value="@isset ($role) {{$role->role_description}}
                      
                      @endisset" placeholder="Breve descripción">
                    </div>
                  </div>  
                </div>
              </div>
              <div id="menu1" class="tab-pane fade">
                @foreach ($permissions as $permission => $primer_nivel)
                @if ($primer_nivel->permission_level ==1)

                <div class="row">
                 <div class="col-md-6">
                  <h3 class="pull-left">{{ucfirst($primer_nivel->permission_description)}}</h4>
                  </div>
                </div>
                <hr>
                @endif
                <div class="row">
                  @foreach ($permissions as $segundo_nivel)
                  @if ($segundo_nivel->permission_level==2 && $segundo_nivel->id_padre == $primer_nivel->id)
                  <div class="row permission">
                    <div class="col-sm-3 col-sm-offset-1">
                      <div class="visible-sm-block visible-md-block visible-lg-block">
                        {{-- <label class="control-label text-center" style="display: block">{{ $segundo_nivel->permission_description }}</label> --}}
                        <h5 class="pull-left">{{ $segundo_nivel->permission_description }}</h5>
                      </div>
                    </div>
                  </div>

                  <div class="row"> 
                   @foreach ($permissions as $tercer_nivel)
                   @if ($tercer_nivel->permission_level==3 && $tercer_nivel->id_padre == $segundo_nivel->id)
                   <div class="row permission">
                    <input type="checkbox" name="per[]"  @isset ($per)
                    @if(in_array($tercer_nivel->permission_name, $per)) {{'checked'}} @endif 
                    @endisset value="{{$tercer_nivel->permission_name}}" data-toggle="toggle">
                    <div class="col-sm-3 col-sm-offset-1">
                      <div class="visible-sm-block visible-md-block visible-lg-block">
                        <label class="control-label text-right" style="display: block">{{ $tercer_nivel->permission_description }}</label>
                      </div>
                    </div>
                  </div>
                  <br>

                  @endif
                  @endforeach

                </div>
                @endif
                @endforeach
                <div class="col-md-12">
                </div>
              </div>
              @endforeach
            </div>
              {{-- <div id="menu2" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Some content in menu 2.</p>
              </div> --}}
            </div>



            
          </div>
          <br>
          <div class="row">
            <div class="col-md-3 col-md-offset-5">
              <input type="submit" class="btn button-primary" value="Guardar">
              <button type="button" class="btn button-primary" id="btnCancel" name="button">Cancelar</button>
              {{-- <button type="button" class="btn button-primary" id="volver" name="button">Volver</button> --}}
            </div>
          </div>
          <hr>


          