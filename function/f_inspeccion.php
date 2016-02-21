<?php
include_once '../clases/inspeccion.php';
include_once '../clases/usuarios.php';
include_once '../clases/bd.php';

switch ($_POST["method"]) {
	case "registrar" :
		registrar ();
		break;
	default :
		echo "error";
		break;
}
function registrar() {
	$razonSocial=filter_input(INPUT_POST,"razon");
	$ente=filter_input(INPUT_POST,"ente");
	$tipoRif=filter_input(INPUT_POST,"tipo_rif");
	$rif=filter_input(INPUT_POST,"rif");
	$funcionario=filter_input(INPUT_POST,"funcionario");
	$observacion=filter_input(INPUT_POST,"observacion");
	
	$inspec = new inspeccion();

 $result=$inspec->registrarInspeccion($razonSocial, $ente, $tipoRif, $rif, $funcionario, $observacion);
 
 if($result){
 	 echo json_encode ( array (
			"result" => "OK"
	) );
  }
 else{
 	echo json_encode ( array (
			"result" => "error"
	) );
	
 }
 
	
}
function actPass(){
	session_start();
	$usuario = new usuario($_SESSION["id"]);
	$bd = new bd ();
	$password = filter_input(INPUT_POST, "password_act");
	$hash = hash ( "sha256", $password );
	$condicion = "usuarios_id = {$_SESSION["id"]} AND password = '$hash'";
	$result = $bd->doSingleSelect("usuarios_accesos",$condicion);
	if(!empty($result)){
		$newhashpass = hash ( "sha256", filter_input(INPUT_POST, "password") );
		$bd->doUpdate("usuarios_accesos", array("password" => $newhashpass), "usuarios_id = {$_SESSION["id"]}");
		echo json_encode ( array (
				"result" => "OK"
		) );
	}else{
		echo json_encode ( array (
				"result" => "error"
		) );
	}
}

	