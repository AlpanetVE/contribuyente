<!DOCTYPE html>
<html lang="es">
	<?php  include "estilos-scripts.php";
		   require_once 'paginas/secure.php';
	?>
	<script type="text/javascript" src="js/contribuyente.js"></script>
	<link rel="stylesheet" type="text/css" href="css/contribuyente.css"/>
 	<body class="">
 <div >
<?php
	$view = isset($_REQUEST["view"])?$_REQUEST["view"]:'';
	include "clases/contribuyente.php";
	include "clases/site.php";
	switch ($view) {
	    case '':
	    case 'list':
			include "paginas/contribuyente/p_list.php";
	        break;
	    case 'form':	    	
	        include "paginas/contribuyente/p_form.php";
	        break;
	}
 ?>
</div>
  </body>
</html>