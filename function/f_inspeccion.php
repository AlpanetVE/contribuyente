<?php
include_once '../clases/inspeccion.php';
include_once '../clases/usuarios.php';
include_once '../clases/bd.php';

switch ($_POST["method"]) {
	case "registrar" :
		registrar ();
		break;
	case "searchfilter":
		resbusqueda();
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

function resbusqueda(){
	
	//$rif_busq=filter_input(INPUT_POST,"buscar_rif");
	
	$condicion="status=1 ";
	
		if(isset($_POST['buscar_razon']) && $_POST['buscar_razon']!="")
		{
			$razon_busq=filter_input(INPUT_POST,"buscar_razon");
		   $condicion.= "AND razon_social LIKE '%$razon_busq%'";
		 }
		
			if(isset($_POST['buscar_tipo_ente']) && $_POST['buscar_tipo_ente']!="")
		{
			$ente_busq=filter_input(INPUT_POST,"buscar_tipo_ente");
		   $condicion.= "AND tipo_ente LIKE '%$ente_busq%'";
		
		}
		
	if(isset($_POST['buscar_rif']) && $_POST['buscar_rif']!="")
		{
			$rif_busq=filter_input(INPUT_POST,"buscar_rif");
		   $condicion.= "AND rif LIKE '%$rif_busq%'";
		
		}	
	
	if(isset($_POST['buscar_funcionario']) && $_POST['buscar_funcionario']!="")
		{
			$funcionario_busq=filter_input(INPUT_POST,"buscar_funcionario");
		   $condicion.= "AND funcionario LIKE '%$funcionario_busq%'";
		
		}
		
	if(isset($_POST['buscar_observ']) && $_POST['buscar_observ']!="")
		{
			$observ_busq=filter_input(INPUT_POST,"buscar_observ");
		   $condicion.= "AND observacion LIKE '%$observ_busq%'";
		
		}		
		
     $sql = new bd();
	 
	 $res=$sql->doFullSelect("inspeccion",$condicion);
	 if(!empty($res)){
	 	
		 ?>
		 <?php 
		 echo $condicion;
		foreach ($res as $fila) {
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
            
	 <?php	

		
	 }
	 else{
	 	?> <p> Vacio</p>
	  <?php }

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

	