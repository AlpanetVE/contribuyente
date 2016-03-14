<div>
	<span> Hola!</span><?php echo $_SESSION["seudonimo"]; ?>
	
	<div class="container-fluid">
	<div class="">
		<?php include("temas/menu-admin.php");
			  include("clases/inspeccion.php"); ?>
	</div>
	
	
	<form class="form-inline" role="form" id="filtro" name="filtro" method="POST" action="function/f_inspeccion.php">
  <div class="form-group">
    <input type="text" class="form-control" id="buscar_razon" name="buscar_razon"
           placeholder="Razon social a buscar">
  </div>
  <div class="form-group">
  
    <input type="text" class="form-control" id="buscar_tipo_ente" name="buscar_tipo_ente" 
           placeholder="Tipo de ente a buscar">
  </div>
  <div class="form-group">
  
    <input type="text" class="form-control" id="buscar_rif" name="buscar_rif" 
           placeholder="RIF a buscar">
  </div>
  
  <div class="form-group">
  
    <input type="text" class="form-control" id="buscar_funcionario" name="buscar_funcionario" 
           placeholder="Funcionario a buscar">
  </div>
  
  <div class="form-group">
  
    <input type="text" class="form-control" id="buscar_observ" name="buscar_observ" 
           placeholder="Observacion buscar">
  </div>
  
  <input type="hidden" class="form-control" id="method" name="method" value="searchfilter" />
  
  <span class="glyphicon glyphicon-search"></span>
  <button  class="btn btn-default" id="filtrobuscar">Buscar</button>
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
                <th class="text-center">Raz&oacute;n Social</th>
                <th class="text-center">Tipo de Ente</th>
                <th class="text-center">RIF</th>
                <th class="text-center">Funcionario</th>
                <th class="text-center">Observacion</th>
               <!-- <th colspan="2" class="text-center">Acciones</th> -->       
            </tr>    
            <tbody id="ajaxCont">
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