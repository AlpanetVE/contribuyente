<div>
	<span> Hola!</span><?php echo $_SESSION["seudonimo"]; ?>
	
	<div class="container-fluid">
	<div class="">
		<?php include("temas/menu-admin.php");
			  include("clases/inspeccion.php"); ?>
	</div>
	
	<div class="contenedor">
	<table class="table table-striped text-center table-hover">
            <tr>
                <th class="text-center">Raz&oacute;n Social</th>
                <th class="text-center">Tipo de Ente</th>
                <th class="text-center">RIF</th>
                <th class="text-center">Funcionario</th>
                <th class="text-center">Observacion</th>
               <!-- <th colspan="2" class="text-center">Acciones</th> -->       
            </tr>    
            <tbody id="ajaxContainer">
            <?php
            $inspec= new inspeccion();
 				$registros=$inspec->listarInspecciones();

				//$total=$registros->rowCount(); Se debe encontrar un mejor codigo para el paginador  
				
				//$totalPaginas=ceil($total/25);
				//$contador=0; 
				foreach ($registros as $fila) {
                ?>            
                <tr>
                    <td><?php echo $fila["razon_social"]; ?></td>
                    <td><?php echo $fila["tipo_ente"]; ?></td>
                    <td><?php echo $fila["rif"]; ?></td>
                    <td><?php echo $fila["funcionario"]; ?></td> 
                    <td><?php echo $fila["observacion"]; ?></td>
                        
                       <!-- <td><a href="#mod" class="update_user show-select-rol" data-toggle="modal" data-target="#usr-update-info" data-rol-type="select" data-tipo="1" data-method="actualizar" data-usuarios_id="<?php echo $fila['id']; ?>"  ><i class="fa fa-lock" ></i> Modificar</a></td>
                        <td><a href="#del" class="select-usr-delete " data-toggle="modal" data-target='#msj-eliminar' data-status='3'  data-usuarios_id="<?php echo $fila['id']; ?>"   >
                        		<i class="fa fa-remove"></i> Eliminar
                        	</a> 
                       </td> -->
                    
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
	</div>
</div>
</div>