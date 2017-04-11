<div>

<div class="container-fluid">
	<div class="">
		<?php include("temas/menu-admin.php"); ?>
	</div>

	<div class="contenedor">
	<div class="row">	<h3 class="text-center"> Nuevo Usuario </h3>
		<br />
		<br />
		<form id="reg-user" class="form-horizontal" name="reg-user" action="function/f_usuarios.php" method="post" data-method="new">
	<div class="container" style="width: 45%;">

		<div class="form-group">
		<div class="row text-center">


				<div class="col-lg-6" >
				<label> Nombre </label>	<input type="text" name="nombre" id="nombre"  class="form-control" style="width: 100%"/>
				</div>
				<div class="col-lg-6">
				<label> Apellido </label>	<input type="text" name="apellido" id="apellido" class="form-control" />
				</div>
        <div class="col-lg-6">
        <label> Cédula </label>	<input type="text" name="cedula" id="cedula" class="form-control" />
        </div>
				<div class="col-lg-6" >
		   			<label> Usuario </label> <input type="text" name="usuario" id="usuario"  class="form-control" />
		     </div>
		</div>

<div class="row text-center">


		    <div class="col-lg-6">
		      		<label> Clave </label> <input type="password" name="clave" id="clave" class="form-control" />
			</div>
      <div class="col-lg-6">
            <label> Cargo </label> <input type="text" name="cargo" id="cargo" class="form-control" />
    </div>
		<div class="col-lg-6">
					<label> Rol </label>
					<select class="select-single form-select" id="rol" name="rol">
						<option value="1">Administrador</option>
						<option value="2">Usuario</option>
					</select>
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
