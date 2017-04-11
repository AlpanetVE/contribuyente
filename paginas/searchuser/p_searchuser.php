<div>

	<div class="container-fluid">
	<div class="">
		<?php include("temas/menu-admin.php");
			  include("clases/usuarios.php"); ?>
	</div>

	<h3 class="text-center"> Buscar Usuario </h3>

	<form class="form-inline" role="form" id="filtro" name="filtro" method="POST" action="function/f_usuarios.php">

  <div class="form-group">

    <input type="text" class="form-control" id="buscar_cedula" name="buscar_cedula"
           placeholder="Ingrese Cedula del Usuario">
  </div>
  <input type="hidden" class="form-control" id="method" name="method" value="searchfilter" />


  <button  class="btn btn-default" id="filtrobuscar">Buscar <span class="glyphicon glyphicon-search"></span></button>
</form>

<!--	<form class="form-inline" >
	<div class="input-group" style="">
		<span class="input-group-btn">
			<button class="btn-header btn-default-header" style="border: #ccc 1px solid; border-right:transparent;">
		<span class="glyphicon glyphicon-search"></span>
	</button>
					</span> <input style="margin-left: -10px; border: #ccc 1px solid; border-left:1px solid #FFF;  " class="form-control-header " placeholder="Razon Social" id="txtBusqueda_raz" name="txtBusqueda_raz" type="text">
	</div>

	</form> -->

	<div class="contenedor" id="cont">



	<table class="table table-striped text-center table-hover">
            <tr>
                <th class="text-center">Seudonimo</th>
                <th class="text-center">Cédula</th>
                <th class="text-center">Nombre</th>
                <th class="text-center">Apellido</th>
                <th class="text-center">Cargo</th>
               <!-- <th colspan="2" class="text-center">Acciones</th> -->
            </tr>
            <tbody id="ajaxCont">
            <?php
            $user= new usuario();
 				$users=$user->listarUsuarios();

				//$total=$registros->rowCount(); Se debe encontrar un mejor codigo para el paginador

				//$totalPaginas=ceil($total/25);
				//$contador=0;
				foreach ($users as $fila) {
                ?>
                <tr>
                    <td><?php echo $fila["seudonimo"]; ?></td>
                    <td><?php echo $fila["cedula"]; ?></td>
                    <td><?php echo $fila["nombre"]; ?></td>
                    <td><?php echo $fila["apellido"]; ?></td>
                    <td><?php echo $fila["cargo"]; ?></td>

                        <td><a href="#mod" class="update_user show-select-rol" data-toggle="modal" data-target="#usr-update-info" data-rol-type="select" data-tipo="1" data-method="actualizar" data-usuarios_id="<?php echo $fila['idusuarios']; ?>"  ><i class="fa fa-lock" ></i> Modificar</a></td>
                        <td><a href="#del" class="select-usr-delete " data-toggle="modal" data-target='#msj-eliminar' data-status='3'  data-usuarios_id="<?php echo $fila['idusuarios']; ?>"   >
                        		<i class="fa fa-remove"></i> Eliminar
                        	</a>
                       </td>

                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php

                                $result=$user->getUsers('count(idusuarios) as total')->fetch();
								$total=$result['total'];
                                $totalPaginas=ceil($total/25);
                                ?>
        <div id="paginacion" name="paginacion" class='col-xs-12 col-sm-12 col-md-12 col-lg-12 ' data-paginaActual='1' data-total="<?php echo $total;?>"><center><nav><ul class='pagination'>
					    	<!--
								<li><a href='listado.php' aria-label='Previous'><i class='fa fa-angle-double-left'></i></a></li>
								<li><a href='#' aria-label='Previous'><i class='fa fa-angle-left'></i></a></li>
								-->
									<li id="anterior2" name="anterior2" class="hidden"><a href='#' aria-label='Previous' class='navegador' data-status="1" data-container="#lista-shop-active"  data-funcion='anterior2'><i class='fa fa-angle-double-left'></i> </a>
									<li id="anterior1" name="anterior1" class="hidden"><a href='#' aria-label='Previous' class='navegador' data-status="1" data-container="#lista-shop-active"  data-funcion='anterior1'><i class='fa fa-angle-left'></i> </a>
									<?php
									$oculto="";
									$activo="active";
									for($i=1;$i<=$totalPaginas;$i++):
									?>
										<li class="<?php echo $activo; echo $oculto;?>"><a class="botonPagina" href='#' data-status="1" data-container="#lista-shop-active" data-pagina="<?php echo $i;?>"><?php echo $i;?></a></li>
									<?php
									$activo="";
									if($i==10)
									$oculto=" hidden";
									endfor;
								?>
								<?php
									if($totalPaginas>1):
									?>
										<li id="siguiente1" name="siguiente1"><a href='#' data-status="1" data-container="#lista-shop-active" aria-label='Next' class='navegador' data-funcion='siguiente1'><i class='fa fa-angle-right'></i> </a>
									<?php
									endif;
									?>
								<?php
									if($totalPaginas>10):
										?>
										<li id="siguiente2" name="siguiente2"><a href='#' data-status="1" data-container="#lista-shop-active" aria-label='Next' class='navegador' data-funcion='siguiente2'><i class='fa fa-angle-double-right'></i> </a>
									<?php
									endif;
								?>
								</li></ul>
						</nav></center></div>
	</div>
</div>
</div>
