<?php
	
	$objContribuyente 	= new contribuyente();

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
	
	<h3 class="text-center"> Listado de Inspecciones </h3> 	
	
	<form class="form-inline" role="form" id="filtro" name="filtro" method="POST" action="function/f_contribuyente.php">
  		<input type="hidden" id="method" name="method" value="searchfilter" />
		<input type="hidden" id="pagina" name="pagina" value="1" />
		<input type="hidden" id="cant" name="cant" value="<?php echo $cant;?>" />

		<div class="form-group">
			<input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Razon social a buscar">
		</div>

		<div class="form-group">  
			<input type="text" class="form-control" id="rif" name="rif" placeholder="RIF a buscar">
		</div>  

		<div class="form-group">  
			<input type="text" class="form-control" id="correo" name="correo" placeholder="Correo">
		</div>		
		<button  class="btn btn-default" id="filtrobuscar">Buscar <span class="glyphicon glyphicon-search"></span></button>
		<a class="imprimirContribuyente btn btn-default" >Imprimir</a>

		<a class="btn btn-primary pull-right" href="?view=form" >Agregar</a>
	</form>

	
	<div class="contenedor" id="cont">
		
	
		
	<table class="table table-striped text-center table-hover">
            <tr>
                <th class="text-center">Raz&oacute;n Social</th>
                <th class="text-center">RIF</th>
                <th class="text-center">Domicilio</th>
                <th class="text-center">Correo</th>
                <th colspan="2" class="text-center">Acciones</th>     
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