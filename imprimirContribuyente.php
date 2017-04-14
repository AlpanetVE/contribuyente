<?php

require 'paginas/secure.php';
include 'clases/contribuyente.php';

$razon_social 	= $_GET['razon_social'];
$rif 			= $_GET['rif'];
$correo 		= $_GET['correo'];

 
$objContribuyente 	= new contribuyente();

$data = $objContribuyente -> getAllData($razon_social,$rif,$correo);

?>

<table>
	<thead>
		<tr>		
			<th> Razon social </th>
			<th> RIF </th>
			<th> Domicilio </th>
			<th> Telefono </th>
			<th> Fax </th>
			<th> Correo </th>
			<th> Cierre fiscal </th>
			<th> Actividad </th>
			<th> Nombre del representante </th>
			<th> Apellido del representante </th>
			<th> RIF del representante </th>
			<th> Correo del representante</th>
			<th> Telefono del representante </th>
			<th> Parroquia </th>
			<th> Municipio </th>
			<th> Estado </th>		
		</tr>
	</thead>
	<tbody >

		<?php
			if (!empty($data->fetch())) {
				foreach ($data as $key => $value) {
					echo '<tr>';
					echo '<td>'.$value['razon_social'].'</td>';
					echo '<td>'.$value['rif'].'</td>';
					echo '<td>'.$value['domicilio'].'</td>';
					echo '<td>'.$value['telefono'].'</td>';
					echo '<td>'.$value['fax'].'</td>';
					echo '<td>'.$value['correo'].'</td>';
					echo '<td>'.$value['cierre_fiscal'].'</td>';
					echo '<td>'.$value['actividad'].'</td>';
					echo '<td>'.$value['representante_nombre'].'</td>';
					echo '<td>'.$value['representante_apellido'].'</td>';
					echo '<td>'.$value['representante_rif'].'</td>';
					echo '<td>'.$value['representante_correo'].'</td>';
					echo '<td>'.$value['representante_telefono'].'</td>';
					echo '<td>'.$value['parroquia'].'</td>';
					echo '<td>'.$value['municipio'].'</td>';
					echo '<td>'.$value['estado'].'</td>';
					echo '</tr>';
				}
			}else{
				echo '<tr><td colspan="16"><center>Vacio</center></td></tr>';
			}
			
		?>
	</tbody>
</table>
