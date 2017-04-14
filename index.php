<!DOCTYPE html>
<html lang="es">
<?php
session_start();
if (isset ( $_SESSION ["id"] )):
	header("Location: contribuyente.php");
else:
	header("Location: login.php");
endif;


 ?>

</html>