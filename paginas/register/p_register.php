<div>
	<h1> Estas logueado </h1>
	<?php echo $_SESSION["seudonimo"]; ?>
	
	<div class="container-fluid">
	<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
		<?php include("temas/menu-admin.php"); ?>
	</div>
	
	<div class="contenedor">
	<div class="row">	<h3 class="text-center"> Registro de Inspecciones </h3> 
		<br />
		<br />
		<form id="reg-inspec" name="reg-inspec" action="function/f_inspeccion.php" method="post" data-method="registrar">
	<div class="container">	
		
		<div class="form-group">
		<div class="row text-center">
		<div class="col-lg-5" >
				<label> Razon Social</label>	<input type="text" name="razon" id="razonsocial"  />
				<label> Tipo de Ente</label>	<input type="text" name="ente" id="tipoente"  />
			
		</div>		
			<div class="col-lg-4" align="left">
				<label> Tipo de RIF</label>
				<select class="select-single" id="tipo_rif" name="tipo_rif">
					<option>V</option>
					<option>E</option>
					<option>J</option>
				</select>
				<label> RIF </label> <input type="text" name="rif" id="rif"  />
						
	  </div>	
	   	
	   	<div class="col-lg-12" style="margin: 10px">	
	   			<label> Funcionario </label> <input type="text" name="funcionario" id="funcionario"  />
	      		<label> Observaciones </label> <input type="textarea" name="observacion" id="observacion"  />
			
		</div>
	<div class="col-lg-12"> <button id="register-submit" type="submit" class="btn btn-primary2">Registrar</button></div>	
	</div>		
		</div>	
	</div>		
		</form>
	</div> 
	</div>
</div>
</div>