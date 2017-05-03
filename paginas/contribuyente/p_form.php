<?php
$objSite = new site();
$objContribuyente = new contribuyente();


$estados 		= $objSite->getEstados();
$municipios 	= $objSite->getMunicipios();
$parroquias 	= $objSite->getParroquias();
$arrStatus 		= $objContribuyente->getStatus();




if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
	$title = 'Actualizar Contribuyente';
	$id 	= $_REQUEST['id'];
	$data 	= $objContribuyente->getContribuyente($id);
	$data 	= $data[0];

	$dataRp	= $objContribuyente->getRepresentante(null,$id);
	$dataRp = $dataRp[0];

	$dataSites = $objSite->getSities($data['parroquia_id']);

	foreach ($dataSites as $key => $value) {
		$dataSites = $value;
	}

}else{
	$title = 'Nuevo Contribuyente';
	$id = '';
	$data = $dataRp =  array('razon_social' => '','rif' => '','domicilio' => '','telefono' => '','fax' => '','correo' => '','cierre_fiscal' => '','fecha_sujecion'=>'','fecha_notificacion'=>'','actividad' => '','nombre' => '','apellido' => '','rif' => '','correo' => '','telefono' => '');

	$dataSites = array('estado' => '','municipio' => '','parroquia' => '','id_estado' => '','id_parroquia' => '','id_municipio' => '');
}

?>

<div>

<div class="container-fluid">
	<div class="">
		<?php include("temas/menu-admin.php"); ?>
	</div>

	<div class="contenedor">
	<div class="row">	<h3 class="text-center"><?php echo $title;?></h3>
		<br />
		<br />
		<form id="reg-contribuyente" class="form-horizontal" name="reg-contribuyente" action="function/f_contribuyente.php" method="post" data-method="new">
			<input type="hidden" name="contribuyente_id" value='<?php echo $id;?>'>
			<div class="container" style="width: 45%;">
				<div class="form-group">
				<div class="row text-center">
					<div class="col-lg-6" >
						<label> Nombre o Razon Social </label>
						<input value='<?php echo $data["razon_social"];?>' type="text" name="razon_social" id="razon_social"  class="form-control" style="width: 100%"/>
					</div>
					<div class="col-lg-6">
						<label> Rif </label>
						<input value='<?php echo $data["rif"];?>' type="text" name="rif" maxlength="12"  id="rif" class="form-control" />
					</div>
			        <div class="col-lg-6">
			        	<label> Domicilio </label>	<input value='<?php echo $data["domicilio"];?>' type="text" name="domicilio" id="domicilio" class="form-control" />
			        </div>
			        <div class="col-lg-6">
			        	<label> Estado </label>
			        	<select name="estado" id="estado" class="form-control doAjax" data-method='getMunicipios' data-func='f_contribuyente.php'>
						  <option>Seleccione</option>
						  <?php
						    foreach($estados as $estado) {
						    	if ($estado['id_estado']==$dataSites["id_estado"]) {
						    		$select='selected="selected"';
						    	}else{
						    		$select='';
						    	}
						    	?>
						      <option value="<?php echo $estado['id_estado'] ?>" <?php echo $select;?> ><?php echo $estado['estado'] ?></option>
						  <?php
						    } ?>
						</select>
			        </div>
			        <div class="col-lg-6">
			        	<label> Municipio </label>
			        	<select name="municipio" id="municipio" class="form-control doAjax" data-method='getParroquias' data-func='f_contribuyente.php'>
						  <option>Seleccione</option>
						  <?php
						    foreach($municipios as $municipio) {
						    	if ($municipio['id_municipio']==$dataSites["id_municipio"]) {
						    		$select='selected="selected"';
						    	}else{
						    		$select='';
						    	}
						    	?>
						      <option value="<?php echo $municipio['id_municipio'] ?>" <?php echo $select;?> ><?php echo $municipio['municipio'] ?></option>
						  <?php
						    } ?>
						</select>
			        </div>
			        <div class="col-lg-6">
			        	<label> Parroquia </label>
			        	<select name="parroquia" id="parroquia" class="form-control" >
						  <option>Seleccione</option>
						  <?php
						    foreach($parroquias as $parroquia) {
						    	if ($parroquia['id_parroquia']==$dataSites["id_parroquia"]) {
						    		$select='selected="selected"';
						    	}else{
						    		$select='';
						    	}
						    	?>
						      <option value="<?php echo $parroquia['id_parroquia'] ?>" <?php echo $select;?> ><?php echo $parroquia['parroquia'] ?></option>
						  <?php
						    } ?>
						</select>
			        </div>

			        <div class="col-lg-6">
			        	<label> Telefono </label>	<input value='<?php echo $data["telefono"];?>' type="number" name="telefono" id="telefono" class="form-control" />
			        </div>

			        <div class="col-lg-6">
			        	<label> FAX </label>	<input value='<?php echo $data["fax"];?>' type="number" name="fax" id="fax" class="form-control" />
			        </div>

			        <div class="col-lg-6">
			        	<label> Correo Electronico </label>	<input value='<?php echo $data["correo"];?>' type="text" name="correo" id="correo" class="form-control" />
			        </div>

			        <div class="col-lg-6">
			        	<label> Cierre Fiscal </label>	<input value='<?php echo $data["cierre_fiscal"];?>' type="text" name="cierre_fiscal" id="cierre_fiscal" class="form-control datepicker" />
			        </div>

							<div class="col-lg-6">
								<label>Fecha de Sujeción </label>	<input value='<?php echo $data["fecha_sujecion"];?>' type="text" name="fecha_sujecion" id="fecha_sujecion" class="form-control datepicker" />
							</div>

							<div class="col-lg-6">
			        	<label> Fecha de Notificación</label>	<input value='<?php echo $data["fecha_notificacion"];?>' type="text" name="fecha_notificacion" id="fecha_notificacion" class="form-control datepicker" />
			        </div>

					<div class="col-lg-6" >
				   		<label> Actividad Economica </label> <input value='<?php echo $data["actividad"];?>' type="text" name="actividad" id="actividad"  class="form-control" />
				    </div>

				    <div class="col-lg-6">
			        	<label> Estatus </label>
			        	<select name="estatus_id" id="estatus_id" class="form-control" >
						  <option>Seleccione</option>
						  <?php
						    foreach($arrStatus as $status) {
						    	if ($status['estatus_id']==$data["estatus_id"]) {
						    		$select='selected="selected"';
						    	}else{
						    		$select='';
						    	}
						    	?>
						      <option value="<?php echo $status['estatus_id'] ?>" <?php echo $select;?> ><?php echo $status['estatus'] ?></option>
						  <?php
						    } ?>
						</select>
			        </div>
				    <div class='col-sm-12'>
				    	<hr>
				    </div>
				    <div class='col-sm-12'>
				    	<label> <h4>Datos del representante</h4> </label>
				    </div>

				    <div class="col-lg-6" >
				   		<label> Nombre </label> <input value='<?php echo $dataRp["nombre"];?>' type="text" name="nombre" id="nombre"  class="form-control" />
				    </div>
				    <div class="col-lg-6" >
				   		<label> Apellido </label> <input value='<?php echo $dataRp["apellido"];?>' type="text" name="apellido" id="apellido"  class="form-control" />
				    </div>
				    <div class="col-lg-6" >
				   		<label> RIF </label> <input value='<?php echo $dataRp["rif"];?>' type="text" name="rif_representante" id="rif_representante"  class="form-control" />
				    </div>
				    <div class="col-lg-6" >
				   		<label> Correo Electronico </label> <input value='<?php echo $dataRp["correo"];?>' type="text" name="correo_representante" id="correo_representante"  class="form-control" />
				    </div>
				    <div class="col-lg-6" >
				   		<label> Telefono </label> <input value='<?php echo $dataRp["telefono"];?>' type="text" name="telefono_representante" id="telefono_representante"  class="form-control" />
				    </div>

				</div>
				<div class="alert success" style="display: none;">
				  <span class="closebtn">×</span>
				  <strong>¡Exito!</strong> Los datos han sido guardados
				</div>
				<div class="row text-center" style="margin-top: 20px;">
					<div class="col-lg-12">
						<a href="?view=list" class="btn btn-default">Regresar</a href="?view=list">
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
