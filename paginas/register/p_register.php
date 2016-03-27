<div>
	
<div class="container-fluid">
	<div class="">
		<?php include("temas/menu-admin.php"); ?>
	</div>
	
	<div class="contenedor">
	<div class="row">	<h3 class="text-center"> Registro de Inspecciones </h3> 
		<br />
		<br />
		<form id="reg-inspec" class="form-horizontal" name="reg-inspec" action="function/f_inspeccion.php" method="post" data-method="registrar">
	<div class="container" style="width: 45%;">	
		
		<div class="form-group">
		<div class="row text-center">
			
				
				<div class="col-lg-6" >
				<label> Razon Social</label>	<input type="text" name="razon" id="razonsocial"  class="form-control" style="width: 100%"/>
				</div>	
				<div class="col-lg-6">
				<label> Tipo de Ente</label>	<input type="text" name="ente" id="tipoente" class="form-control" />
				</div>
		</div>	
		
	<div class="row text-center">  
			<div class="col-lg-6">
				<label> Tipo de RIF </label>
				<select class="select-single form-select" id="tipo_rif" name="tipo_rif">
					<option>V</option>
					<option>E</option>
					<option>J</option>
				</select>
			</div>	
	  <div class="col-lg-6">	
				<label> RIF </label> <input type="text" name="rif" id="rif" class="form-control" />
						
	  </div>		
			
	</div>		
	
<div class="row text-center">  
			
		   	<div class="col-lg-6" >	
		   			<label> Funcionario </label> <input type="text" name="funcionario" id="funcionario"  class="form-control" />
		     </div>
		    <div class="col-lg-6">	 
		      		<label> Observaciones </label> <input type="textarea" name="observacion" id="observacion" class="form-control" />	
			</div>
			
	</div>	
			
<div class="row text-center" style="margin-top: 20px;">
		<div class="col-lg-12"> <button id="register-submit" type="submit" class="btn btn-primary2">Registrar</button></div>
	</div>

	
			
		</div>	
	</div>		
		</form>
	</div> 
	</div>
</div>
</div>