<?php
/*Destruimos la sesion al llamar a esta pagina*/
if(isset($_COOKIE["c_id"])){
	setcookie("c_id", "", 0,'/');
	setcookie("c_seudonimo", "", -1000,'/');
	setcookie("c_nombre", "", -1000,'/');
	setcookie("c_status", "", -1000,'/');
	
}
session_start ();
if (isset ( $_SESSION ["id"] )):
	session_destroy ();
	header("Location: login.php");
else:
	header("Location: login.php");
endif;
?>