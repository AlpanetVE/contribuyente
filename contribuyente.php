<!DOCTYPE html>
<html lang="es">
	<?php  include "estilos-scripts.php";
		   require_once 'paginas/secure.php';
	?>
 	<body class="">
 <div >
<?php
	$view = isset($_REQUEST["view"])?$_REQUEST["view"]:'';

	switch ($view) {
	    case '':
	    case 'list':	        
			include "paginas/contribuyente/p_list.php";
	        break;
	    case 'form':
	    	include "clases/contribuyente.php";
	    	include "clases/site.php";
	        include "paginas/contribuyente/p_form.php";
	        break;
	}
 ?>
</div>
  </body>
</html>