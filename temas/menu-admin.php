
<div class="text-center"> <img src="images/seniat_2014.png" style="height: 100px; width: auto;" /></div>
<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			  <div class="navbar-header">
			  	<a class="navbar-brand"  href="#"> Bienvenido!</a>
			  </div>
				<ul class="nav navbar-nav">

<?php if($_SESSION["rol"] == 1) { ?>
					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user"></i> Usuarios <span class="caret"></span></a>
					        <ul class="dropdown-menu">
					          <li><a href="createuser.php"><i class="fa fa-user-plus"></i> Agregar</a></li>
					          <li><a href="searchuser.php"><i class="fa fa-search"></i> Buscar</a></li>
					        </ul>
					      </li>
<?php }?>								
<!--
<li> <a href="list.php"><i class="fa fa-list-alt"></i> Listar Inspeccion</a></li>
<li><a href="register.php"><i class="fa fa-plus-circle"></i> Registrar Nueva Inspeccion</a></li>
-->
<li><a href="logout.php"> <i class="fa fa-sign-out"></i> Salir</a></li>

				</ul>
	</div> <!--Fin del container fluid -->
</nav>
