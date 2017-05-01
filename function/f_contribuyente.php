<?php
include_once '../clases/contribuyente.php';
include_once '../clases/site.php';
include_once '../clases/bd.php';
session_start();
switch ($_POST["method"]) {
	case "new" :
		registrar ();
		break;
	case "getMunicipios" :
		getMunicipios();
		break;
	case "getParroquias" :
		getParroquias();
		break;
	case 'deleteContribuyente':
		deleteContribuyente();
		break;
	case "searchfilter":
		resbusqueda();
		break;
	default :
		echo "error";
		break;
}
function getMunicipios() {
	$sitio = new site ();
	$array;
	if(isset($_POST["id_municipios"])){
		 $id_municipios = $_POST["id_municipios"];
	}else{
		 $id_municipios = '';
	}
	if(isset($_POST["val"])){
		 $id_estado = $_POST["val"];
	}else{
		 $id_estado = '';
	}

	$valores = $sitio->getMunicipios($id_municipios,$id_estado);


	foreach ($valores as $key => $value) {

		$array[$key]['value'] = $value['id_municipio'];
		$array[$key]['name'] 	= $value['municipio'];

	}
	echo json_encode ( array (
		"result" 		=> "ok",
		"campos" 		=> $array,
		"input" 		=> '#municipio',
		"inputRemove" 	=> '#municipio option, #parroquia option'
	));
}
function getParroquias() {
	$sitio = new site ();

	if(isset($_POST["id_parroquia"])){
		 $id_parroquia = $_POST["id_parroquia"];
	}else{
		 $id_parroquia = '';
	}
	if(isset($_POST["val"])){
		 $id_municipio = $_POST["val"];
	}else{
		 $id_municipio = '';
	}

	$valores = $sitio->getParroquias($id_parroquia,$id_municipio);

	foreach ($valores as $key => $value) {

		$array[$key]['value'] = $value['id_parroquia'];
		$array[$key]['name'] 	= $value['parroquia'];

	}
	echo json_encode ( array (
		"result" 		=> "ok",
		"campos" 		=> $array,
		"input" 		=> '#parroquia',
		"inputRemove" 	=> '#parroquia option'
	));
}

function registrar() {
	$contribuyente 	= new contribuyente();

	$razon_social		= filter_input(INPUT_POST,"razon_social");
	$rif				= filter_input(INPUT_POST,"rif");
	$domicilio			= filter_input(INPUT_POST,"domicilio");
	$parroquia_id		= filter_input(INPUT_POST,"parroquia");
	$telefono			= filter_input(INPUT_POST,"telefono");
	$fax				= filter_input(INPUT_POST,"fax");
	$correo				= filter_input(INPUT_POST,"correo");
	$cierre_fiscal		= filter_input(INPUT_POST,"cierre_fiscal");
	$actividad			= filter_input(INPUT_POST,"actividad");
	$estatus_id			= filter_input(INPUT_POST,"estatus_id");

	$nombre				= filter_input(INPUT_POST,"nombre");
	$apellido			= filter_input(INPUT_POST,"apellido");
	$rif_representante		= filter_input(INPUT_POST,"rif_representante");
	$correo_representante	= filter_input(INPUT_POST,"correo_representante");
	$telefono_representante	= filter_input(INPUT_POST,"telefono_representante");

	
	$contribuyente_id	= filter_input(INPUT_POST,"contribuyente_id");

	if (empty($contribuyente_id)) {
		$contribuyente_id=$contribuyente->registrarContribuyente($razon_social,$rif,$domicilio,$parroquia_id,$telefono,$fax,$correo,$cierre_fiscal,$actividad,$estatus_id);

		$result=$contribuyente->registrarRepresentante($contribuyente_id,$nombre,$apellido,$rif_representante,$correo_representante,$telefono_representante);
	}	
	else{


		$data 	= array( 'razon_social' => $razon_social,'rif' => $rif,'domicilio' => $domicilio,'parroquia_id' => $parroquia_id,'telefono' => $telefono,'fax' => $fax,'correo' => $correo,'cierre_fiscal' => $cierre_fiscal,'actividad' => $actividad,'estatus_id' => $estatus_id);

		$dataRp	= array( 'nombre' => $nombre,'apellido' => $apellido,'rif' => $rif_representante,'correo' => $correo_representante,'telefono' => $telefono_representante);


		$result=$contribuyente->actualizarContribuyente($contribuyente_id, $data);

		$result=$contribuyente->actualizarRepresentante($contribuyente_id, $dataRp);

		$result = true;
	}


	if($result){
		echo json_encode ( array (
		"result" => "ok"
		) );
	}
	else{
		echo json_encode ( array (
		"result" => "error"
		) );
	}
 }

 function deleteContribuyente() {
 	$contribuyente 	= new contribuyente();

 	if(isset($_POST["contribuyente_id"])){
		 $contribuyente_id = $_POST["contribuyente_id"];
	}else{
		 $contribuyente_id = '';
	}

	if (!empty($contribuyente_id)) {
		$result = $contribuyente->borrarContribuyente($contribuyente_id);
 		$result = $contribuyente->borrarRepresentante($contribuyente_id);
	}else{
		$result = false;
	}

 	


 	if($result){
		echo json_encode ( array (
		"result" => "ok"
		) );
	}
	else{
		echo json_encode ( array (
		"result" => "error"
		) );
	}
 }

 function resbusqueda(){

	$condicion	= "1";
	$pagina 	= $_POST['pagina'];
	$cant 		= $_POST['cant'];
	$start		= $cant*($pagina-1);
	if(isset($_POST['razon_social']) && $_POST['razon_social']!="")
	{
		$razon_social=filter_input(INPUT_POST,"razon_social");
		$condicion.= " AND razon_social LIKE '%$razon_social%'";
	}

	if(isset($_POST['rif']) && $_POST['rif']!="")
	{
		$rif=filter_input(INPUT_POST,"rif");
		$condicion.= " AND rif LIKE '%$rif%'";
	}	

	if(isset($_POST['correo']) && $_POST['correo']!="")
	{
		$correo=filter_input(INPUT_POST,"correo");
		$condicion.= " AND correo LIKE '%$correo%'";

	}
	
	 $condicion .= " limit $start,$cant";
     $sql = new bd();
	 $res=$sql->doFullSelect("contribuyentes",$condicion);
	 if(!empty($res)){
	 	
		 ?>
		 <?php 
		 echo $condicion;
		foreach ($res as $fila) {
                ?>            
                <tr>
                    <td><?php echo $fila["razon_social"]; ?></td>
                    <td><?php echo $fila["rif"]; ?></td>
                    <td><?php echo $fila["domicilio"]; ?></td> 
                    <td><?php echo $fila["correo"]; ?></td>         
                    <?php 
                    
                    if($_SESSION["rol"] == 1) { ?>               
	                    <td>
	                    	<a href="?view=form&id=<?php echo $fila['contribuyente_id'];?>" >
	                    		<i class="fa fa-lock" ></i> Modificar
	                    	</a>
	                    </td>
	                <?php } ?>
                    
                </tr>
                <?php
            }
            ?>
            
	 <?php	

		
	 }
	 else{
	 	?> <p> Vacio</p>
	  <?php }

}
 