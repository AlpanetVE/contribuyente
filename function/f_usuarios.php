<?php
include_once '../clases/usuarios.php';
include_once '../clases/bd.php';

switch ($_POST["method"]) {
	case "new" :
		newUser ();
		break;
	case "log" :
		logUser ();
		break;
	case "fot" :
		fotUser ();
		break;
	case "get" :
		getUser ();
		break;
	case "act-social" :
		actSocial ();
		break;
	case "act-nat" :
		actNat ();
		break;
	case "act-jur" :
		actJur ();
		break;
	case "act-email":
		actEmail();
		break;
	case "act-seudonimo":
		actSeudonimo();
		break;
	case "act-pass":
		actPass();
		break;
	case "send-email":
		sendEmail();
		break;
	case "getUsuario":
		getUsuario();
		break;
	case "loadSession":
		loadSession();
		break;
	case "upd-Noti":
		updateNot();
		break;
	case "fotP":
		fotPort();
		break;
	case "updateStatus":
		updateStatus();
		break;
	case "recover":
		recoverPassword();
		break;
	case "update_user":
		updateUser();
		break;
	case "deleteUser":
		deleteUser();
		break;
	case "restablecer":
		restablecerPassword();
		break;
case "searchfilter":
	resbusqueda();
	break;
	default :
		echo "error";
		break;
}
function getUser() {
		$usuario = new usuario ( $_POST ["id"] );

	$reflection = new ReflectionObject ( $usuario );
	$properties = $reflection->getProperties ( ReflectionProperty::IS_PRIVATE );
	foreach ( $properties as $property ) {
		$name = $property->getName ();
		//echo $usuario->$name;
		if($name!="u_clave" || !isset($_POST["id"])){
			$valores [$name] = $usuario->$name;
		}
	}
	echo json_encode ( array (
			"result" => "OK",
			"campos" => $valores
	) );
}

//Busqueda de usuarios

function resbusqueda(){

	//$rif_busq=filter_input(INPUT_POST,"buscar_rif");

	$condicion="status=1 ";
	//if (session_status() == PHP_SESSION_NONE){
		session_start();



	if(isset($_POST['buscar_cedula']) && $_POST['buscar_cedula']!="")
		{
			$cedula_busq=filter_input(INPUT_POST,"buscar_cedula");
		   $condicion.= "AND cedula LIKE '%$cedula_busq%'";

		}
     $sql = new bd();

	 $res=$sql->doFullSelect("usuarios",$condicion);
	 if(!empty($res)){

		 ?>
		 <?php
		 echo $condicion;
		foreach ($res as $fila) {
                ?>
                <tr>
									<td><?php echo $fila["seudonimo"]; ?></td>
									<td><?php echo $fila["cedula"]; ?></td>
									<td><?php echo $fila["nombre"]; ?></td>
									<td><?php echo $fila["apellido"]; ?></td>
									<td><?php echo $fila["cargo"]; ?></td>
									<td><?php echo (($fila["rol"]==1)?"Administrador":"Usuario");?></td>

									<td><a href="#mod" class="update_user show-select-rol" data-toggle="modal" data-target="#usr-update-info" data-rol-type="select" data-tipo="1" data-method="actualizar" data-usuarios_id="<?php echo $fila['idusuarios']; ?>"  ><i class="fa fa-lock" ></i> Modificar</a></td>
									<td><a href="#del" class="select-usr-delete <?php if ($fila["idusuarios"]==$_SESSION["id"]){ echo 'grisC';}?> " <?php if ($fila["idusuarios"]!=$_SESSION["id"]){  ?> data-toggle="modal" data-target='#msj-eliminar'  <?php }?> data-status='3'  data-usuarios_id="<?php echo $fila['idusuarios']; ?>"   >
											<i class="fa fa-remove"></i> Eliminar
										</a>
								 </td>
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

function deleteUser(){
		$sql= new bd();
	$usuarios_id=filter_input ( INPUT_POST, "usuarios_id" );
	$consulta="DELETE FROM usuarios where idusuarios=$usuarios_id";
	 $res=$sql->query($consulta);
	 if($res){
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
function actEmail(){
	session_start();
	$usuario = new usuario($_SESSION["id"]);
	$bd = new bd ();
	$values = array (
			"email" => filter_input ( INPUT_POST, "email" )
	);
	if($usuario->a_email == $values["email"]){
		echo json_encode ( array (
				"result" => "OK"
		) );
	}else {
		if ($bd->valueExist ( "usuarios_accesos", $values['email'], "email" )) {
			echo json_encode ( array (
					"result" => "error",
					"fields" => array("email" => "Este correo electronico ya esta en uso")
			) );
		} else {
			$bd->doUpdate ( "usuarios_accesos", $values, "usuarios_id = {$_SESSION["id"]}" );
			echo json_encode ( array (
					"result" => "OK"
			) );
		}
	}
}
function actSeudonimo(){
	session_start();
	$usuario = new usuario($_SESSION["id"]);
	$bd = new bd ();
	$values = array (
			"seudonimo" => filter_input ( INPUT_POST, "seudonimo" )
	);
	if($usuario->a_seudonimo == $values["seudonimo"]){
		echo json_encode ( array (
				"result" => "OK"
		) );
	}else {
		if ($bd->valueExist ( "usuarios_accesos", $values['seudonimo'], "seudonimo" )) {
			echo json_encode ( array (
					"result" => "error",
					"fields" => array("seudonimo" => "Este seudonimo ya esta en uso")
			) );
		} else {
			$bd->doUpdate ( "usuarios_accesos", $values, "usuarios_id = {$_SESSION["id"]}" );
			echo json_encode ( array (
					"result" => "OK"
			) );
			$_SESSION["seudonimo"] = $values["seudonimo"];
		}
	}
}
function actNat() {
	session_start();
	if(!isset($_POST["id"])){
		$usuario = new usuario($_SESSION["id"]);
		$actUsua=$_SESSION["id"];
	}else{
		$usuario = new usuario($_POST["id"]);
		$actUsua=$_POST["id"];
	}
	$bd = new bd ();
	$values_nat = array (
			"tipo" => filter_input ( INPUT_POST, "p_tipo" ),
			"identificacion" => filter_input ( INPUT_POST, "p_identificacion" ) ,
			"nombre" =>  (filter_input ( INPUT_POST, "p_nombre" )),
			"apellido" =>filter_input ( INPUT_POST, "p_apellido" ),

	);
	$values_usu = array(
			"estados_id" => filter_input ( INPUT_POST, "p_estado" ),
			"telefono" => filter_input ( INPUT_POST, "p_telefono" ),
			"direccion" => filter_input ( INPUT_POST, "p_direccion" )
	);
	if($usuario->n_identificacion == $values_nat["identificacion"]){
		$bd->doUpdate ( "usuarios_naturales", $values_nat, "usuarios_id = $actUsua" );
		$bd->doUpdate ( "usuarios", $values_usu, "id = $actUsua" );
		echo json_encode ( array (
				"result" => "OK"
		) );
	}else {
		if ($bd->valueExist ( "usuarios_naturales", $values_nat['identificacion'], "identificacion" )) {
			echo json_encode ( array (
					"result" => "error",
					"fields" => array("p_identificacion" => "El numero de identificacion ya esta en uso")
			) );
		} else {
			$bd->doUpdate ( "usuarios_naturales", $values_nat, "usuarios_id = $actUsua" );
			$bd->doUpdate ( "usuarios", $values_usu, "id = $actUsua" );
			echo json_encode ( array (
					"result" => "OK"
			) );
		}
	}
}
function actJur() {
	session_start();
	$bd = new bd ();
	if(!isset($_POST["id"])){
		$usuario = new usuario($_SESSION["id"]);
		$actUsua=$_SESSION["id"];
	}else{
		$bd->query("delete from usuarios_naturales where usuarios_id={$_POST["id"]}");
		$valores=array(
					"razon_social"=>$_POST["e_razonsocial"],
					"rif"=>$_POST["e_rif"],
					"tipo"=>$_POST["e_tipo"],
					"usuarios_id"=>$_POST["id"],
					"categorias_juridicos_id"=>$_POST["e_categoria"]
		);
		$bd->doInsert("usuarios_juridicos",$valores);
		$usuario = new usuario($_POST["id"]);
		$actUsua=$_POST["id"];
	}
	$values_jur = array (
			"tipo" => filter_input ( INPUT_POST, "e_tipo" ),
			"rif" => filter_input ( INPUT_POST, "e_rif" ) ,
			"razon_social" => filter_input ( INPUT_POST, "e_razonsocial" ),
			"categorias_juridicos_id" => filter_input ( INPUT_POST, "e_categoria" ),
	);
	$values_usu = array(
			"estados_id" => filter_input ( INPUT_POST, "e_estado" ),
			"telefono" => filter_input ( INPUT_POST, "e_telefono" ),
			"direccion" => filter_input ( INPUT_POST, "e_direccion" )
	);
	if($usuario->j_rif == $values_jur["rif"]){
		$bd->doUpdate ( "usuarios_juridicos", $values_jur, "usuarios_id = $actUsua" );
		$bd->doUpdate ( "usuarios", $values_usu, "id = $actUsua" );
		echo json_encode ( array (
				"result" => "OK"
		) );
	}else {
		if ($bd->valueExist ( "usuarios_juridicos", $values_jur['rif'], "rif" )) {
			echo json_encode ( array (
					"result" => "error",
					"fields" => array("e_rif" => "El numero de rif ya esta en uso")
			) );
		} else {
			$bd->doUpdate ( "usuarios_juridicos", $values_jur, "usuarios_id = $actUsua" );
			$bd->doUpdate ( "usuarios", $values_usu, "id = $actUsua" );
			echo json_encode ( array (
					"result" => "OK"
			) );
		}
	}
}
function actSocial() {
	$bd = new bd ();
//	var_dump ( $website );
    if(!isset($_SESSION["id"])){
    	session_start();
    }
	$values = array (
			"descripcion" => empty ( $_POST["descripcion"] ) ? NULL : filter_input ( INPUT_POST, "descripcion" ),
			"facebook" => empty ( $_POST["facebook"] ) ? NULL : filter_input ( INPUT_POST, "facebook"),
			"twitter" => empty ( $_POST["twitter"] ) ? NULL : filter_input ( INPUT_POST, "twitter"),
			"website" => empty ( $_POST["website"]  ) ? NULL : filter_input ( INPUT_POST, "website")
	);
	if ($bd->doUpdate ( "usuarios", $values, "id = {$_SESSION["id"]}" )) {
		echo "OK";
	} else {
		echo "error";
	}
}
function fotUser() {
	$foto = new fotos ();
	session_start();
	if ($foto->updateFoto ( filter_input ( INPUT_POST, "ruta" ), filter_input ( INPUT_POST, "foto" ), $_SESSION["id"] )) {
		echo json_encode ( array (
				"result" => "OK"
		) );
	} else {
		echo json_encode ( array (
				"result" => "error"
		) );
	}
}
function logUser() {

	$usuario = new usuario ();
	$bd = new bd ();
	$login = filter_input ( INPUT_POST, "log_usuario" );
	$password = filter_input ( INPUT_POST, "log_password" );


	$field_name="";
	if ($bd->valueExist ( $usuario->u_table, $login, "seudonimo" )) {
		$field_name="seudonimo";
	}

	if (!empty($field_name)) {

		$id = $usuario->ingresoUsuario ( array (
				$field_name => $login
		), $password );

		if ( $id[0] == 2) {
			$fields ["log_password"] = "La contrase&ntilde;a es incorrecta";
		}
		if ( $id[0] == 4) {
			$fields ["log_usuario"] = "El usuario estan registrados o fueron eliminados";
		}

	}  else {
		$fields ["log_usuario"] = "El usuario no esta registrado";
		$id[0]=0;
	}

	if ( $id[0] == 1) {
		echo json_encode ( array (
				"result" => "OK"
		) );
		exit ();
	}elseif ( $id[0] == 3){
		echo json_encode ( array (
				"result" => "Actualice",
				"id" => $id[1]
		) );
		exit ();
	}else{
		if (isset ( $fields )) {
			echo json_encode ( array (
					"result" => "error",
					"fields" => $fields
			) );
			exit ();
		}
	}
}

function newUser(){
	$user = new usuario();
		$bd = new bd();
 //$usuario->ingresoUsuario();
		$nombre=filter_input(INPUT_POST,"nombre");
		$apellido=filter_input(INPUT_POST,"apellido");
		$cedula=filter_input(INPUT_POST,"cedula");
		$usuario=filter_input(INPUT_POST,"usuario");
		$passwd=filter_input(INPUT_POST,"clave");
		$cargo=filter_input(INPUT_POST,"cargo");
		$rol=filter_input(INPUT_POST,"rol");

 if ($bd->valueExist( $user->u_table, $usuario, "seudonimo")) {
	 	$fields ["usuario"] = "El usuario no esta disponible";
  }
	 if ($bd->valueExist($user->u_table, $cedula, "cedula")) {
	 	$fields ["cedula"] = "Cedula ya registrada";
	 }
		if (isset ( $fields )) {
			echo json_encode ( array (
					"result" => "error",
					"fields" => $fields
			) );
			exit ();
		}
		$user->setDatos($nombre, $apellido, $cedula,$usuario, $passwd, $cargo,$rol);
		if($user->crear()){
			echo json_encode ( array (
					"result" => "ok"
			) );
		}else{
			echo json_encode ( array (
					"result" => "error"
			) );
		}


}

/*
function newUser() {
	$usuario = new usuario ();
	$foto = new fotos ();
	$bd = new bd ();



	if (isset ( $_POST ["type"] )) {
		$ingresoUsuario = filter_input ( INPUT_POST, "ingresoUsuario" );

		$seudonimo = filter_input ( INPUT_POST, "seudonimo" );
		if ($bd->valueExist ( $usuario->a_table, $seudonimo, "seudonimo" )) {
			$fields ["seudonimo"] = "El seudonimo no esta disponible";
		}
		$email = filter_input ( INPUT_POST, "email" );
		if ($bd->valueExist ( $usuario->a_table, $email, "email" )) {
			$fields ["email"] = "El email no esta disponible";
		}
		$password = filter_input ( INPUT_POST, "password" );
		$descripcion = filter_input ( INPUT_POST, "descripcion" );
		$id_rol = filter_input ( INPUT_POST, "id_rol" );
		$status_usuarios_id = 1;
		if ($descripcion == "") {
			$descripcion = NULL;
		}
		if (filter_input ( INPUT_POST, "type" ) == "e") {
			$rif = filter_input ( INPUT_POST, "e_rif" );
			if ($bd->valueExist ( $usuario->j_table, $rif, "rif" )) {
				$fields ["e_rif"] = "El RIF ya esta en uso";
			}
			$telefono = filter_input ( INPUT_POST, "e_telefono" );
			$estado = filter_input ( INPUT_POST, "e_estado" );
			$direccion = filter_input ( INPUT_POST, "e_direccion" );
			$usuario->datosUsuario ( $direccion, $telefono, $descripcion, $estado );
			$usuario->datosJuridico ( filter_input ( INPUT_POST, "e_rif" ), filter_input ( INPUT_POST, "e_razonsocial" ), filter_input ( INPUT_POST, "e_tipo" ), filter_input ( INPUT_POST, "e_categoria" ) );
		} else {
			$cedula = filter_input ( INPUT_POST, "p_identificacion" );
			if ($bd->valueExist ( $usuario->n_table, $cedula, "identificacion" )) {
				$fields ["p_identificacion"] = "El numero de identificacion ya esta en uso";
			}
			$telefono = filter_input ( INPUT_POST, "p_telefono" );
			$estado = filter_input ( INPUT_POST, "p_estado" );
			$direccion = filter_input ( INPUT_POST, "p_direccion" );
			$usuario->datosUsuario ( $direccion, $telefono, $descripcion, $estado );
			$usuario->datosNatural ( $cedula, filter_input ( INPUT_POST, "p_nombre" ), filter_input ( INPUT_POST, "p_apellido" ), filter_input ( INPUT_POST, "p_tipo" ) );
		}
		if (isset ( $fields )) {
			echo json_encode ( array (
					"result" => "error",
					"fields" => $fields
			) );
			exit ();
		}


		$usuario->datosAcceso ( $seudonimo, $email, $password ,0, $id_rol, $status_usuarios_id);
		$usuario->datosStatus ();
		$usuario->crearUsuario ();
		$foto->crearFotoUsuario ( $usuario->id, $_POST ["foto"] );

		if($ingresoUsuario=='1'){
			$usuario->ingresoUsuario( array (
				"seudonimo" => filter_input ( INPUT_POST, "seudonimo" )
				), filter_input ( INPUT_POST, "password" ) ,NULL);

		}

		echo json_encode ( array (
				"result" => "ok"
		) );
	}
} */
	function sendEmail(){
		ini_set("sendmail_from",$_POST["email"]);
		$email_to = "apreciodepanacontacto@gmail.com";

		$email_subject = $_POST ['nombre']." te ha contactado!";
		$email_message = $_POST ['mensaje']."\n\n";
		// Ahora se env&iacute;a el e-mail usando la funci&oacute;n mail() de PHP
		$headers = 'From: ' . $_POST ['email'] . "\r\n" . 'Reply-To: ' . $_POST ['email'] . "\r\n" . 'X-Mailer: PHP/' . phpversion ();
		mail ( $email_to, $email_subject, $email_message, $headers );//
		echo json_encode(array("estado"=>"OK"));
	}
	function getUsuario(){
		$usua=new usuario($_POST["id"]);
		echo json_encode(array("rif"=>$usua->j_rif,"razon"=>$usua->j_razon_social));
	}
	function loadSession(){
		$bd = new bd();
		$foto =new fotos();
		if(!isset($_SESSION)){
			session_start();
		}
		$result = $bd->doSingleSelect("usuarios_accesos","usuarios_id={$_POST["id"]}");
		$_SESSION["id"] = $result["usuarios_id"];
		$_SESSION["seudonimo"] = $result["seudonimo"];
		$_SESSION["nivel"] = $result["nivel"];
		$_SESSION["fotoperfil"] = $foto->buscarFotoUsuario($result["usuarios_id"]);
		$_SESSION["id_rol"] = $result["id_rol"];
		$bd->doUpdate("usuarios_accesos",array("bandera"=>0),"usuarios_id={$_POST["id"]}");
		echo "OK";
	}

	function updateNot(){
		$usr = new usuario($_POST["id"]);
		$act = $usr ->updateNotificaciones($_POST["id"]);
		echo "ok";
	}


	function fotPort() {
	$foto = new fotos ();
	session_start();
	if ($foto->updatePort ( filter_input ( INPUT_POST, "ruta" ), filter_input ( INPUT_POST, "foto" ), $_SESSION["id"] )) {
		echo json_encode ( array (
				"result" => "OK"
		) );
	} else {
		echo json_encode ( array (
				"result" => "error"
		) );
	}
	}


	function updateStatus(){

		$usuarios_id=		filter_input ( INPUT_POST, "usuarios_id" );
		$status_usuarios_id=filter_input ( INPUT_POST, "status_usuarios_id" );

		$usuario = new usuario($usuarios_id);

		//modificamos el estatus del usuario si ya existe el registro
		$result = $usuario ->updateStatus($usuarios_id, $status_usuarios_id);


		if ($result) {

			echo json_encode ( array (
					"result" => "OK"
			) );

		} else {
			echo json_encode ( array (
					"result" => "error"
			) );
		}

	}

function recoverPassword(){
	$usuario = new usuario ();
	$bd = new bd ();
	$login = filter_input ( INPUT_POST, "rec_usuario" );

	$field_name="";
	if ($bd->valueExist ( $usuario->a_table, $login, "seudonimo" )) {
		$field_name="seudonimo";
	}elseif($bd->valueExist ( $usuario->a_table, $login, "email" )){
		 $field_name="email";
	}


	if (!empty($field_name)) {

		$id = $usuario->recuperaClave ( array (
				$field_name => $login
		));

		if ( $id[0] == 2) {
			$fields ["rec_usuario"] = "El usuario o el correo no estan registrados o fueron eliminados";
		}

	}  else {
		$fields ["rec_usuario"] = "El usuario o el correo no estan registrados";
		$id[0]=0;
	}

	if ( $id[0] == 1) {
		echo json_encode ( array (
				"result" => "OK"
		) );
		exit ();
	}
	else{
		if (isset ( $fields )) {
			echo json_encode ( array (
					"result" => "error",
					"fields" => $fields
			) );
			exit ();
		}
	}

	}


function restablecerPassword(){
	$password= filter_input ( INPUT_POST, "rec_clave" );
	$user=filter_input ( INPUT_POST, "usuario" );
	$usuario=new usuario();
	$res=$usuario->setNewPassword($user,$password);
	if($res)
	{	echo json_encode ( array (
					"result" => "OK"
			) );
	}
	else {
		echo json_encode ( array (
					"result" => "error"
			) );
	}

 }
	function updateUser(){
		$usuarios_id=	filter_input ( INPUT_POST, "update_usuarios_id" );
		$seudonimo = filter_input ( INPUT_POST, "update_seudonimo" );
		$nombre = filter_input ( INPUT_POST, "update_nombre" );
		$apellido = filter_input ( INPUT_POST, "update_apellido" );
		$cedula = filter_input ( INPUT_POST, "update_cedula" );
		$cargo = filter_input ( INPUT_POST, "update_cargo" );
		$password= 		filter_input ( INPUT_POST, "update_password" );

		$bd = new bd();
		$user = new usuario($usuarios_id);

		if ($bd->valueExistUpdate( $user->u_table, $seudonimo, "seudonimo","idusuarios<>$usuarios_id")) {
			 $fields ["update_seudonimo"] = "El usuario no esta disponible";
		 }
			if ($bd->valueExistUpdate($user->u_table, $cedula, "cedula","idusuarios<>$usuarios_id")) {
			 $fields ["update_cedula"] = "Cedula ya registrada";
			}
			 if (isset ( $fields )) {
				 echo json_encode ( array (
						 "result" => "error",
						 "fields" => $fields
				 ) );
				 exit ();
			 }
		//modificamos el estatus del usuario si ya existe el registro
		$result = $user ->updateUser($usuarios_id, $seudonimo, $nombre,$apellido,$cedula,$cargo,$password);
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
