<?php
	$objSite = new site();
	$objContribuyente 	= new contribuyente();

	$estados 			= $objSite->getEstados();
	$municipios 		= $objSite->getMunicipios();
	$parroquias 		= $objSite->getParroquias();
	$arrStatus 			= $objContribuyente->getStatus();

	$result				= $objContribuyente->getInspecciones('count(contribuyente_id) as total')->fetch();
	$total				= $result['total'];
	$cant				= 15;
	$totalPaginas		= ceil($total/$cant);
?>
<div>
	
	<div class="container-fluid">
	<div class="">
		<?php include("temas/menu-admin.php"); ?>
	</div>
	
	<h3 class="text-center"> Listado de Contribuyentes </h3> 	
	
	<form class="form-inline" role="form" id="filtro" name="filtro" method="POST" action="function/f_contribuyente.php">
  		<input type="hidden" id="method" name="method" value="searchfilter" />
		<input type="hidden" id="pagina" name="pagina" value="1" />
		<input type="hidden" id="cant" name="cant" value="<?php echo $cant;?>" />

		<div class="form-group">
			<input type="text" class="form-control" id="rif" name="rif" maxlength="12"  placeholder="RIF a buscar">
		</div>
		<div class="form-group">
			<input type="text" class="form-control" id="rifComienza" name="rifComienza" maxlength="1"  placeholder="RIF primer Digito">
		</div>
		<div class="form-group">
			<input type="text" class="form-control" id="rifTermina" name="rifTermina" maxlength="1"  placeholder="RIF Terminacion">
		</div>

		<div class="form-group">
			        	
        	<select name="id_estado" id="estado" class="form-control doAjax" data-method='getMunicipios' data-func='f_contribuyente.php'>
			  <option value="">Estados</option>
			  <?php
			    foreach($estados as $estado) { ?>
			      <option value="<?php echo $estado['id_estado'] ?>" ><?php echo $estado['estado'] ?></option>
			  <?php
			    } ?>
			</select>
        </div>
        <div class="form-group">
        	
        	<select name="id_municipio" id="municipio" class="form-control doAjax" data-method='getParroquias' data-func='f_contribuyente.php'>
			  <option value="">Municipio</option>
			  <?php
			    foreach($municipios as $municipio) { ?>
			      <option value="<?php echo $municipio['id_municipio'] ?>" ><?php echo $municipio['municipio'] ?></option>
			  <?php
			    } ?>
			</select>
        </div>
        <div class="form-group">			        	
        	<select name="id_parroquia" id="parroquia" class="form-control" >
			  <option value="">Parroquia</option>
			  <?php
			    foreach($parroquias as $parroquia) { ?>
			      <option value="<?php echo $parroquia['id_parroquia'] ?>" ><?php echo $parroquia['parroquia'] ?></option>
			  <?php
			    } ?>
			</select>
        </div>
        <div class="form-group">
			<select name="estatus_id" id="estatus_id" class="form-control" >
			  <option value="">Estatus</option>
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


		<button  class="btn btn-default" id="filtrobuscar">Buscar <span class="glyphicon glyphicon-search"></span></button>
		<a class="imprimirContribuyente btn btn-default" >Imprimir</a>

		<?php if($_SESSION["rol"] == 1) { ?>
			<a class="btn btn-primary pull-right" href="?view=form" >Agregar</a>
		<?php }?>
	</form>

	
	<div class="contenedor" id="cont">
		
	
		
	<table class="table table-striped text-center table-hover">
            <tr>
                <th class="text-center">Raz&oacute;n Social</th>
                <th class="text-center">RIF</th>
                <th class="text-center">Domicilio</th>
                <th class="text-center">Correo</th>
                <?php if($_SESSION["rol"] == 1) { ?><th colspan="2" class="text-center">Acciones</th>     <?php } ?>
            </tr>
            <tbody id="ajaxCont">
            </tbody>
        </table>
        
        <div id="paginacion" name="paginacion" class='col-xs-12 col-sm-12 col-md-12 col-lg-12 ' data-paginaActual='1' data-total="<?php echo $total;?>" data-url="function/f_contribuyente.php">
			<center>
				<nav>
					<ul class='pagination'>
        
						<li id="anterior2" name="anterior2" class="hidden">
							<a href='#' aria-label='Previous' class='navegador' data-status="1" data-container="#lista-shop-active"  data-funcion='anterior2'>
								<i class='fa fa-angle-double-left'></i> 
							</a>
						</li>
						<li id="anterior1" name="anterior1" class="hidden">
							<a href='#' aria-label='Previous' class='navegador' data-status="1" data-container="#lista-shop-active"  data-funcion='anterior1'>
								<i class='fa fa-angle-left'>
								</i> 
							</a>
						</li>
						<?php
						$oculto="";
						$activo="active";									
						for($i=1;$i<=$totalPaginas;$i++):
						?>
							<li class="<?php echo $activo; echo $oculto;?>"><a class="botonPaginador" href='#' data-status="1" data-container="#lista-shop-active" data-pagina="<?php echo $i;?>"><?php echo $i;?></a></li>
							<?php
							$activo="";
							if($i==15)
								$oculto=" hidden";
						endfor;
						if($totalPaginas>1):
						?>								
							<li id="siguiente1" name="siguiente1">
								<a href='#' data-status="1" data-container="#lista-shop-active" aria-label='Next' class='navegador' data-funcion='siguiente1'>
									<i class='fa fa-angle-right'>
									</i> 
								</a>
							</li>
							<?php
						endif;
						if($totalPaginas>15):
							?>
						
							<li id="siguiente2" name="siguiente2">
								<a href='#' data-status="1" data-container="#lista-shop-active" aria-label='Next' class='navegador' data-funcion='siguiente2'>
									<i class='fa fa-angle-double-right'>
									</i> 
								</a>
							</li>
						<?php
						endif;
						?>
						
					</ul>
				</nav>
			</center>
		</div>
	</div>
</div>
</div>