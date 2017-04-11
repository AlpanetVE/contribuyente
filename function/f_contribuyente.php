<?php
include_once '../clases/contribuyente.php';
include_once '../clases/site.php';
include_once '../clases/bd.php';

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
	default :
		echo "error";
		break;
}
function getMunicipios() {
	$sitio = new site ();

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
	$razon_social	= filter_input(INPUT_POST,"razon_social");
	$rif			= filter_input(INPUT_POST,"rif");
	$domicilio		= filter_input(INPUT_POST,"domicilio");
	$parroquia_id	= filter_input(INPUT_POST,"parroquia");
	$telefono		= filter_input(INPUT_POST,"telefono");
	$fax			= filter_input(INPUT_POST,"fax");
	$correo			= filter_input(INPUT_POST,"correo");
	$cierre_fiscal	= filter_input(INPUT_POST,"cierre_fiscal");
	$actividad		= filter_input(INPUT_POST,"actividad");


	$nombre				= filter_input(INPUT_POST,"nombre");
	$apellido			= filter_input(INPUT_POST,"apellido");
	$rif				= filter_input(INPUT_POST,"rif_representante");
	$correo				= filter_input(INPUT_POST,"correo_representante");
	$telefono			= filter_input(INPUT_POST,"telefono_representante");

	

	$contribuyente = new contribuyente();
	
	$contribuyente_id=$contribuyente->registrarContribuyente($razon_social,$rif,$domicilio,$parroquia_id,$telefono,$fax,$correo,$cierre_fiscal,$actividad);

	$result=$contribuyente->registrarRepresentante($contribuyente_id,$nombre,$apellido,$rif,$correo,$telefono);

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
 