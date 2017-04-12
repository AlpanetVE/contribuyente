<?php
$site = new site();

$estados = $site->getEstados();
?>


<div>

<div class="container-fluid">
	<div class="">
		<?php include("temas/menu-admin.php"); ?>
	</div>

	<div class="contenedor">
	<div class="row">	<h3 class="text-center"> Nuevo Contribuyente </h3>
		<br />
		<br />
		<form id="reg-contribuyente" class="form-horizontal" name="reg-contribuyente" action="function/f_contribuyente.php" method="post" data-method="new">
			<div class="container" style="width: 45%;">
				<div class="form-group">
				<div class="row text-center">
					<div class="col-lg-6" >
						<label> Nombre o Razon Social </label>
						<input type="text" name="razon_social" id="razon_social"  class="form-control" style="width: 100%"/>
					</div>
					<div class="col-lg-6">
						<label> Rif </label>
						<input type="text" name="rif" id="rif" class="form-control" />
					</div>
			        <div class="col-lg-6">
			        	<label> Domicilio </label>	<input type="text" name="domicilio" id="domicilio" class="form-control" />
			        </div>
			        <div class="col-lg-6">
			        	<label> Estado </label>
			        	<select name="estado" id="estado" class="form-control doAjax" data-method='getMunicipios' data-func='f_contribuyente.php'>
						  <option selected="selected" >Seleccione</option>
						  <?php
						    foreach($estados as $estado) { ?>
						      <option value="<?php echo $estado['id_estado'] ?>"><?php echo $estado['estado'] ?></option>
						  <?php
						    } ?>
						</select>
			        </div>
			        <div class="col-lg-6">
			        	<label> Municipio </label>
			        	<select name="municipio" id="municipio" class="form-control doAjax" data-method='getParroquias' data-func='f_contribuyente.php'>
						  <option selected="selected" >Seleccione</option>
						</select>
			        </div>
			        <div class="col-lg-6">
			        	<label> Parroquia </label>
			        	<select name="parroquia" id="parroquia" class="form-control" >
						  <option selected="selected" >Seleccione</option>
						</select>
			        </div>

			        <div class="col-lg-6">
			        	<label> Telefono </label>	<input type="text" name="telefono" id="telefono" class="form-control" />
			        </div>

			        <div class="col-lg-6">
			        	<label> FAX </label>	<input type="text" name="fax" id="fax" class="form-control" />
			        </div>

			        <div class="col-lg-6">
			        	<label> Correo Electronico </label>	<input type="text" name="correo" id="correo" class="form-control" />
			        </div>

			        <div class="col-lg-6">
			        	<label> Cierre Fiscal </label>	<input type="text" name="cierre_fiscal" id="cierre_fiscal" class="form-control datepicker" />
			        </div>
			        
					<div class="col-lg-6" >
				   		<label> Actividad Economica </label> <input type="text" name="actividad" id="actividad"  class="form-control" />
				    </div>
				    <div class='col-sm-12'>
				    	<hr>
				    </div>
				    <div class='col-sm-12'>
				    	<label> <h4>Datos del representante</h4> </label>
				    </div>

				    <div class="col-lg-6" >
				   		<label> Nombre </label> <input type="text" name="nombre" id="nombre"  class="form-control" />
				    </div>
				    <div class="col-lg-6" >
				   		<label> Apellido </label> <input type="text" name="apellido" id="apellido"  class="form-control" />
				    </div>
				    <div class="col-lg-6" >
				   		<label> RIF </label> <input type="text" name="rif_representante" id="rif_representante"  class="form-control" />
				    </div>
				    <div class="col-lg-6" >
				   		<label> Correo Electronico </label> <input type="text" name="correo_representante" id="correo_representante"  class="form-control" />
				    </div>
				    <div class="col-lg-6" >
				   		<label> Telefono </label> <input type="text" name="telefono_representante" id="telefono_representante"  class="form-control" />
				    </div>
				    
				</div>

				<div class="row text-center" style="margin-top: 20px;">
					<div class="col-lg-12">
						<button onclick="goBack()" class="btn btn-default">Regresar</button>
						<button id="register-submit" type="submit" class="btn btn-primary2">Guardar</button>
					</div>
				</div>
				</div>
			</div>
		</form>
	</div>
	</div>
</div>
</div>
