
<div class="text-center"> <img src="images/seniat_2014.png" style="height: 100px; width: auto;" /></div>
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header pull-right">
			<a class="navbar-brand"  href="#"> Bienvenido   <?php echo $_SESSION['nombre'];?>!</a>
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
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user"></i> Contribuyente <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<?php if($_SESSION["rol"] == 1) { ?>
							<li><a href="contribuyente.php?view=form"><i class="fa fa-user-plus"></i> Agregar</a></li>
						<?php }?>
						<li><a href="contribuyente.php?view=list"><i class="fa fa-search"></i> Buscar</a></li>
					</ul>
				</li>
			<li><a href="logout.php"> <i class="fa fa-sign-out"></i> Salir</a></li>

		</ul>
	</div> <!--Fin del container fluid -->
</nav>
