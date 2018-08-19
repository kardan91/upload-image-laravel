    <div class="collapse" id="collapseMap">
      <div id="map" class="map"></div>
    </div>
    <!-- End Map -->
  <div class="row">  
    <div class="row">
      <div class="col-md-12">
          <h2 class="text-center">Editar Perfil</h2>
          <hr>
      </div>
    </div>
    <div  class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-3 col-sm-3 col-xs-3">
            <!-- required for floating -->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs tabs-left">
                <li class="active"><a href="#home" data-toggle="tab">Editar Datos Personales</a></li>
                <li><a href="#profile" data-toggle="tab">Cambiar Password</a></li>
                <li><a href="#messages" data-toggle="tab">Editar Dirección</a></li>
            </ul>
        </div>
        <div class="col-md-9 col-sm-9 col-xs-9">
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane active" id="home" style="height: 410px">
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="text-center">Editar Datos Personales</h4>
                    <hr>
                  </div>
                </div>
                <form id="change-personal" method="POST" url="/actualizardatosturista" enctype="multipart/form-data">
                  <input type="hidden" name="_tokenPersonal" content="{{ csrf_token() }}"/>
                <div class="row">
                  <div class="col-md-3 col-sm-3">
                    <div class="form-inline upload_1">
                      <img width="200px" height="200px" class="img-responsive center-block" src="{{ asset('images/fotos/usuarios/'.$usuario->fotoperfil) }}">
                      <div class="form-group{{ $errors->has('fotoperfil') ? ' has-error' : '' }}"">
                        <!--<span class="btn btn-default btn-file">
                            Elegir Foto <input type="file">
                        </span>-->
                        <input type="file" name="fotoperfil" id="fotoperfil" multiple>
                          @if ($errors->has('fotoperfil'))
                            <span class="help-block">
                              <strong>{{ $errors->first('fotoperfil') }}</strong>
                            </span>
                          @endif
                      </div>
                    </div>                
                  </div>                     
                  
                  <div class="col-md-9 col-sm-9">  
                    <div class="row short-div">                                                                 
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group{{ $errors->has('nombres') ? ' has-error' : '' }}">
                          <label for="nombres">Nombre(s)</label>
                          <input id="nombres" type="text" class="form-control" name="nombres" value="{{ $usuario->nombres }}" autofocus>
                            @if ($errors->has('nombres'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('nombres') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group{{ $errors->has('appaterno') ? ' has-error' : '' }}">
                          <label for="appaterno">Apellido Paterno</label>
                          <input id="appaterno" type="text" class="form-control" name="appaterno" value="{{ $usuario->appaterno }}" autofocus>
                            @if ($errors->has('appaterno'))
                              <span class="help-block">
                                <strong>{{ $errors->first('appaterno') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group{{ $errors->has('apmaterno') ? ' has-error' : '' }}">
                          <label for="apmaterno">Apellido Materno</label>
                          <input id="apmaterno" type="text" class="form-control" name="apmaterno" value="{{ $usuario->apmaterno }}" autofocus>
                          @if ($errors->has('apmaterno'))
                            <span class="help-block">
                                <strong>{{ $errors->first('apmaterno') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div> 
                    </div>
                    <div class="row short-div">
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label for="correo">E-mail:</label>
                          <input id="correo" type="email" class="form-control" name="correo" value="{{ $usuario->email }}" disabled="true">
                          @if ($errors->has('correo'))
                            <span class="help-block">
                              <strong>{{ $errors->first('correo') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>                    
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group{{ $errors->has('nombreusu') ? ' has-error' : '' }}">
                          <label>Username:</label>
                          <input id="nombreusu" type="nombreusu" class="form-control" name="nombreusu" value="{{ $usuario->nombreusu }}">
                          @if ($errors->has('nombreusu'))
                            <span class="help-block">
                              <strong>{{ $errors->first('nombreusu') }}</strong>
                            </span>
                          @else
                            <span id="error-username" class="help-block" style="display: none">
                              <strong>Error</strong>
                            </span>                          
                          @endif
                        </div>
                      </div>              
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group{{ $errors->has('genero') ? ' has-error' : '' }}">
                          <label for="genero">Género:</label></br>
                          <label class="radio-inline"><input id="Masculino" type="radio" name="genero" value="F"  {{ ($usuario->genero == 'F') ? 'checked' :'' }} >Femenino </label>
                          <label class="radio-inline"><input id="Femenino" type="radio" name="genero" value="M" {{ ($usuario->genero == 'M') ? 'checked' :'' }} >Masculino</label>
                            @if ($errors->has('genero'))
                              <span class="help-block">
                                <strong>{{ $errors->first('genero') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>
                    </div>  
                    <div class="row short-div">
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group{{ $errors->has('fechanac') ? ' has-error' : '' }}">
                          <label for="fechanac">Fecha de Nacimiento:</label>
                          <div class="input-group">
                            <input id="datepicker" class="form-control" name="fechanac" value="{{ $usuario->fechanac }}" autofocus />
                              <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                              </div>
                          </div>
                            @if ($errors->has('fechanac'))
                              <span class="help-block">
                                <strong>{{ $errors->first('fechanac') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>    
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                          <label for="telefono">Teléfono:</label>
                          <input id="telefono" type="text" class="form-control" name="telefono" value="{{ $usuario->telefono }}">
                          @if ($errors->has('telefono'))
                            <span class="help-block">
                              <strong>{{ $errors->first('telefono') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>    
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group{{ $errors->has('celular') ? ' has-error' : '' }}">
                          <label for="celular">Celular:</label>
                          <input id="celular" type="text" class="form-control" name="celular" value="{{ $usuario->celular }}">
                          @if ($errors->has('celular'))
                            <span class="help-block">
                              <strong>{{ $errors->first('celular') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>                                                               
                    </div>                    
                  </div>          
                </div>
                  <!-- End row -->   
                <div class="espacio"></div>
                <div class="row">
                  <div class="col-md-3 col-sm-3"></div>
                    <div class="col-md-6 col-sm-6">
                      <a href="#" id="actualizarPersonal" class="btn_1 green form-control">Actualizar Datos</a>
                    </div>
                </div>   
                </form>            
              </div>
                <div class="tab-pane" id="profile" style="height: 410px">                  
                  <div class="row">
                    <div class="col-md-12">
                      <h4 class="text-center">Cambiar Contraseña</h4>
                      <hr>
                    </div>
                  </div>
                  <form id="change-password" method="POST" url="/actualizarpasswordturista">
                  <input type="hidden" name="_tokenPassword" content="{{ csrf_token() }}"/>
                  <div class="row">
                    <div class="col-md-3 col-sm-3"></div>
                    <div class="col-md-6 col-sm-6">
                      <div class="form-group{{ $errors->has('passwordActual') ? ' has-error' : '' }}">
                        <label for="passwordActual">Password Actual:</label>
                        <input id="passwordActual" type="password" class="form-control" name="passwordActual" value="" required  minlength="6" maxlength="32">
                          @if ($errors->has('passwordActual'))
                            <span class="help-block">
                              <strong>{{ $errors->first('passwordActual') }}</strong>
                            </span>
                          @else
                            <span id="error-passwordA" class="help-block" style="display: none">
                              <strong>Error</strong>
                            </span>                             
                          @endif
                      </div>                     
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 col-sm-3"></div>
                    <div class="col-md-6 col-sm-6">
                      <div class="form-group{{ $errors->has('passwordnueva') ? ' has-error' : '' }}">
                        <label for="passwordnueva">Password Nuevo:</label>
                        <input id="passwordnueva" type="password" class="form-control" name="passwordnueva" value="" required min="6" minlength="6" maxlength="32">
                          @if ($errors->has('passwordnueva'))
                            <span class="help-block">
                              <strong>{{ $errors->first('passwordnueva') }}</strong>
                            </span>
                          @endif
                      </div>                     
                    </div>
                  </div> 
                  <div class="row">
                    <div class="col-md-3 col-sm-3"></div>
                    <div class="col-md-6 col-sm-6">
                      <div class="form-group{{ $errors->has('passwordConfirm') ? ' has-error' : '' }}">
                        <label for="passwordConfirm">Repetir Password:</label>
                        <input id="passwordConfirm" type="password" class="form-control" name="passwordConfirm" required minlength="6" maxlength="32">
                        @if ($errors->has('passwordnueva'))
                            <span class="help-block">
                              <strong>{{ $errors->first('passwordConfirm') }}</strong>
                            </span>
                          @endif
                      </div>
                    </div>                    
                  </div>   
                  <div class="espacio"></div>
                  <div class="row">
                    <div class="col-md-3 col-sm-3"></div>
                      <div class="col-md-6 col-sm-6">
                        <a href="#" id="actualizarPassword" class="btn_1 green form-control" disabled="true">Actualizar Password</a>
                      </div>
                  </div>  
                  </form>              
                </div>
                <div class="tab-pane" id="messages" style="height: 410px">
                  <form id="change-direccion" method="POST" url="/actualizardireccionturista">
                  <input type="hidden" name="_tokenDireccion" content="{{ csrf_token() }}"/>            
                  <div class="row">
                    <div class="col-md-12">
                      <h4 class="text-center">Editar Datos Dirección</h4>
                      <hr>
                    </div>
                  </div>
                  @if(isset($usuario->direccion))
                    <div class="row">
                      <div class="col-md-1 col-sm-1"></div>
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group{{ $errors->has('calle') ? ' has-error' : '' }}">
                          <label for="calle">Calle</label>
                          <input id="calle" type="text" class="form-control" name="calle" value="{{ $usuario->direccion->calle }}" autofocus>
                            @if ($errors->has('calle'))
                              <span class="help-block">
                                <strong>{{ $errors->first('calle') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-2">
                        <div class="form-group{{ $errors->has('numeroexterior') ? ' has-error' : '' }}">
                          <label>No. Exterior</label>
                          <input id="numeroexterior" type="number" class="form-control" name="numeroexterior" value="{{ $usuario->direccion->numeroexterior }}" autofocus>
                            @if ($errors->has('numeroexterior'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('numeroexterior') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-2">
                        <div class="form-group{{ $errors->has('numerointerior') ? ' has-error' : '' }}">
                          <label>No. Interior</label>
                          <input id="numerointerior" type="number" class="form-control" name="numerointerior" value="{{ $usuario->direccion->numerointerior }}">
                            @if ($errors->has('numerointerior'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('numerointerior') }}</strong>
                              </span>
                           |@endif
                        </div>
                      </div>
                    </div>
                    <!-- End row -->                  
                    <div class="row">
                      <div class="col-md-1 col-sm-1"></div>
                      <div class="col-md-3 col-sm-3">
                        <div class="form-group{{ $errors->has('colonia') ? ' has-error' : '' }}">
                          <label>Colonia</label>
                          <input id="colonia" type="text" class="form-control" name="colonia" value="{{ $usuario->direccion->colonia }}">
                            @if ($errors->has('colonia'))
                              <span class="help-block">
                                <strong>{{ $errors->first('colonia') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3">
                        <div class="form-group{{ $errors->has('codigopostal') ? ' has-error' : '' }}">
                          <label>Código Postal</label>
                          <input id="codigopostal" type="number" class="form-control" name="codigopostal" value="{{ $usuario->direccion->codigopostal }}">
                            @if ($errors->has('codigopostal'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('codigopostal') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>                        
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group{{ $errors->has('pais') ? ' has-error' : '' }}">
                          <label for="pais">País</label>
                          <select name="pais" id="pais" class="form-control" value="{{ $usuario->direccion->idpais }}" required autofocus>
                            <option value="">Selecciona un país</option>
                            @foreach($paises as $pais)
                              <option value="{{ $pais['idpais'] }}" {{ ($usuario->direccion->idpais == $pais['idpais']) ? 'selected' :'' }} >{{ $pais['nombre'] }}
                              </option>
                            @endforeach
                          </select>
                            @if ($errors->has('pais'))
                              <span class="help-block">
                                <strong>{{ $errors->first('pais') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>
                    </div>
                    <div id="row-direccion" class="row" {{ ($usuario->direccion->idpais == 'MX') ? '' : 'style="display : none;"' }}>
                      <div class="col-md-1 col-sm-1"></div>
                      <div class="col-md-3 col-sm-3">
                        <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                          <label for="estado">Estado</label>
                          <select name="estado" id="estado" class="form-control" value="{{ $usuario->direccion->idestado }}" {{ ($usuario->direccion->idpais == 'MX') ? 'disabled' : 'disabled' }} autofocus>
                            <option value="">Selecciona un estado</option>
                              @foreach($estados as $estado)
                                <option value="{{ $estado['idestado'] }}" {{ ($usuario->direccion->idestado == $estado['idestado']) ? 'selected' :'' }} >{{ $estado['nombre'] }}</option>
                              @endforeach
                          </select>
                            @if ($errors->has('estado'))
                              <span class="help-block">
                                <strong>{{ $errors->first('estado') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3">
                        <div class="form-group{{ $errors->has('municipio') ? ' has-error' : '' }}">
                          <label for="municipio">Municipio</label>
                          <select name="municipio" id="municipio" class="form-control" value="{{ $usuario->direccion->idmunicipio }}" required autofocus>
                            <option value="">Selecciona un municipio</option>
                            @foreach($municipios as $municipio)
                              <option value="{{ $municipio['idmunicipio'] }}" {{ ($usuario->direccion->idmunicipio == $municipio['idmunicipio']) ? 'selected' :'' }} >{{ $municipio['nombre'] }}</option>
                            @endforeach
                          </select>
                            @if ($errors->has('municipio'))
                              <span class="help-block">
                                <strong>{{ $errors->first('municipio') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group{{ $errors->has('ciudad') ? ' has-error' : '' }}">
                          <label>Ciudad</label>
                          <select name="ciudad" id="ciudad" class="form-control" value="{{ $usuario->direccion->idciudad }}" required autofocus>
                            <option value="">Selecciona una ciudad</option>
                            @foreach($ciudades as $ciudad)
                              <option value="{{ $ciudad['idciudad'] }}" {{ ($usuario->direccion->idciudad == $ciudad['idciudad']) ? 'selected' :'' }} >{{ $ciudad['nombre'] }}</option>
                            @endforeach
                          </select>
                            @if ($errors->has('ciudad'))
                              <span class="help-block">
                                <strong>{{ $errors->first('ciudad') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>                                        
                    </div>
                  @else
                    <div class="row">
                      <div class="col-md-1 col-sm-1"></div>
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group{{ $errors->has('calle') ? ' has-error' : '' }}">
                          <label for="calle">Calle</label>
                          <input id="calle" type="text" class="form-control" name="calle" value="" required autofocus>
                            @if ($errors->has('calle'))
                              <span class="help-block">
                                <strong>{{ $errors->first('calle') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-2">
                        <div class="form-group{{ $errors->has('numeroexterior') ? ' has-error' : '' }}">
                          <label>No. Exterior</label>
                          <input id="numeroexterior" type="number" class="form-control" name="numeroexterior" value="" required autofocus>
                            @if ($errors->has('numeroexterior'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('numeroexterior') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-2">
                        <div class="form-group{{ $errors->has('numerointerior') ? ' has-error' : '' }}">
                          <label>No. Interior</label>
                          <input id="numerointerior" type="number" class="form-control" name="numerointerior" value="">
                            @if ($errors->has('numerointerior'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('numerointerior') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>
                    </div>
                    <!-- End row -->                  
                    <div class="row">
                      <div class="col-md-1 col-sm-1"></div>
                      <div class="col-md-3 col-sm-3">
                        <div class="form-group{{ $errors->has('colonia') ? ' has-error' : '' }}">
                          <label>Colonia</label>
                          <input id="colonia" type="text" class="form-control" name="colonia" value="">
                            @if ($errors->has('colonia'))
                              <span class="help-block">
                                <strong>{{ $errors->first('colonia') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3">
                        <div class="form-group{{ $errors->has('codigopostal') ? ' has-error' : '' }}">
                          <label>Código Postal</label>
                          <input id="codigopostal" type="number" class="form-control" name="codigopostal" value="">
                            @if ($errors->has('codigopostal'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('codigopostal') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>                        
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group{{ $errors->has('pais') ? ' has-error' : '' }}">
                          <label for="pais">País</label>
                          <select name="pais" id="pais" class="form-control" value="" required autofocus>
                            <option value="">Selecciona un país</option>
                            @foreach($paises as $pais)
                              <option value="{{ $pais['idpais'] }}" >{{ $pais['nombre'] }}
                              </option>
                            @endforeach
                          </select>
                            @if ($errors->has('pais'))
                              <span class="help-block">
                                <strong>{{ $errors->first('pais') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>
                    </div>
                    <div id="row-direccion" class="row">
                      <div class="col-md-1 col-sm-1"></div>
                      <div class="col-md-3 col-sm-3">
                        <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                          <label for="estado">Estado</label>
                          <select name="estado" id="estado" class="form-control" value="" required autofocus>
                            <option value="">Selecciona un estado</option>
                              @foreach($estados as $estado)
                                <option value="{{ $estado['idestado'] }}" >{{ $estado['nombre'] }}</option>
                              @endforeach
                          </select>
                            @if ($errors->has('estado'))
                              <span class="help-block">
                                <strong>{{ $errors->first('estado') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3">
                        <div class="form-group{{ $errors->has('municipio') ? ' has-error' : '' }}">
                          <label for="municipio">Municipio</label>
                          <select name="municipio" id="municipio" class="form-control" value="" required autofocus>
                            <option value="">Selecciona un municipio</option>
                          </select>
                            @if ($errors->has('municipio'))
                              <span class="help-block">
                                <strong>{{ $errors->first('municipio') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group{{ $errors->has('ciudad') ? ' has-error' : '' }}">
                          <label>Ciudad</label>
                          <select name="ciudad" id="ciudad" class="form-control" value="" required autofocus>
                            <option value="">Selecciona una ciudad</option>
                          </select>
                            @if ($errors->has('ciudad'))
                              <span class="help-block">
                                <strong>{{ $errors->first('ciudad') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>                                        
                    </div>                           
                  @endif
                    <!-- End row -->
                    <div class="espacio"></div>
                    <div class="row">
                      <div class="col-md-3 col-md-3"></div>
                      <div class="col-md-6 col-md-6">
                        <label></label>
                        <a href="#" id="actualizarDireccion" class="btn_1 green form-control" >Actualizar Dirección</a>
                      </div>
                    </div>              
                  </form>                  
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade bd-example-modal-sm" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding: 1px;">
          <button type="button" class="close" data-dismiss="modal" style="opacity: .8"><p style="margin: 0 0 5px 0;">&times;</p></button>
          <h4 style="color: white;" id="titulo-modal"></h4>
        </div>
        <div class="modal-body" >
          <div  overflow: auto;">
            <div style="text-align: center; width: 100%;">
              <img id="result-img" width="80px" height="80px" style="margin-top: 10%; margin-bottom: 10%;" />
            </div>
            <p id="datoInsercion"></p>
          </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
      
    </div>
  </div> 