<div class="col-xl-12 col-md-12">
   <div class="row">
      <div class="col-lg-12">
         <div class="card text-white bg-secondary">
            <div class="card-header text-right">
               <h6 class="font-weight-light my-1">Nuevo Usuario</h6>
            </div>
            <div class="card-body">
               <form>
                  <div class="form-row">
                     <div class="col-md-3">
                        <div class="form-group">
                        	<img src="public/images/users/tu39hnri84fheg.png" alt="Victor CAxi" class="img-thumbnail mt-4">
                        </div>
                     </div>
                     <div class="col-md-9">
                     	<div class="form-group input-group-sm">
                        	<label class="small mb-0" for="in-document">Documento</label>
                        	<input class="form-control" id="in-document" name="txtdocument" type="text" placeholder="Número de documento"/>
                        </div>
                        <div class="form-group input-group-sm" style="margin-top: -0.7em">
                        	<label class="small mb-0 mt-2" for="in-names">Nombres</label>
                        	<input class="form-control" id="in-names" name="txtnames" type="text" placeholder="Nombres" />
                        </div>
                        <div class="form-row" style="margin-top: -0.7em">
							<div class="form-group input-group-sm col-md-6">
                        		<label class="small mb-0 mt-2" for="in-paterno">Apellido Paterno</label>
                        	<input class="form-control" id="in-paterno" name="txtpaterno" type="text" placeholder="Apellido Paterno"/>
                        	</div>
							<div class="form-group input-group-sm col-md-6">
	                        	<label class="small mb-0 mt-2" for="in-materno">Apellido Materno</label>
                        		<input class="form-control" id="in-materno" name="txtmaterno" type="text" placeholder="Apellido Materno"/>
							</div>
						</div>
                        <div class="form-row" style="margin-top: -0.7em">
							<div class="form-group input-group-sm col-md-6">
                        		<label class="small mb-0 mt-2" for="in-nacimiento">Fecha de Nacimiento</label>
                        		<input class="form-control" id="in-nacimiento" name="txtnacimiento" type="text" placeholder="día/mes/año"/>
                        	</div>
							<div class="form-group input-group-sm col-md-6">
	                        	<label class="small mb-0 mt-2" for="in-sexe">Sexo</label>
	                        	<select class="form-control form-control-sm" id="in-sexe" name="txtsexe">
								  <option>No definido</option>
								  <option>Masculino</option>
								  <option>Femenino</option>
								</select>
							</div>
						</div>
                        </div>
                     </div>
                     <div class="form-row" style="margin-top: -0.7em">
							<div class="form-group input-group-sm col-md-6">
                        		<label class="small mb-0 mt-2" for="in-email">Dirección de correo electrónico</label>
                        		<input class="form-control" id="in-email" name="txtcorreo" type="text" placeholder="Dirección de correo electrónico"/>
                        	</div>
                        	<div class="form-group input-group-sm col-md-6">
                        		<label class="small mb-0 mt-2" for="in-phone">Número de telefono</label>
                        		<input class="form-control" id="in-phone" type="text" placeholder="Número de telefono"/>
                        	</div>
						</div>                
                  	<div class="form-group input-group-sm" style="margin-top: -0.7em">
                       	<label class="small mb-0 mt-2" for="in-address">Dirección de domicilo</label>
                       	<input class="form-control" id="in-address" name="txtaddress" type="text" placeholder="Dirección de domicilo" />
                    </div>
                    <div class="form-row" style="margin-top: -0.7em">							
							<div class="form-group input-group-sm col-md-4">
	                        	<label class="small mb-0 mt-2" for="in-departamento">Departamento</label>
	                        	<select class="form-control form-control-sm" id="in-departamento" name="txtdepartamento">
								  <option>No definido</option>
								  <option>Masculino</option>
								  <option>Femenino</option>
								</select>
							</div>
							<div class="form-group input-group-sm col-md-4">
	                        	<label class="small mb-0 mt-2" for="in-provincia">Provincia</label>
	                        	<select class="form-control form-control-sm" id="in-provincia" name="txtprovincia">
								  <option>No definido</option>
								  <option>Masculino</option>
								  <option>Femenino</option>
								</select>
							</div>
							<div class="form-group input-group-sm col-md-4">
	                        	<label class="small mb-0 mt-2" for="in-distrito">Distrito</label>
	                        	<select class="form-control form-control-sm" id="in-distrito" name="txtdistrito">
								  <option>No definido</option>
								  <option>Masculino</option>
								  <option>Femenino</option>
								</select>
							</div>
					</div>
               </form>
            </div>
            <div class="card-footer text-center">
               <div class="small"><a href="www.google.com">Terminos de uso de éste formulario</a></div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
	$('.card-header').html(arixshell_cargar_boton_simple('btn-guardar'));
</script>