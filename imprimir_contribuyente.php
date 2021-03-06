<?php
require 'paginas/secure.php';
include 'clases/contribuyente.php';
include 'clases/lib/PHPExcel.php';

$rif 			= $_GET['rif'];

$id_estado 		= $_GET['id_estado'];
$id_municipio 	= $_GET['id_municipio'];
$id_parroquia 	= $_GET['id_parroquia'];
$estatus_id 	= $_GET['estatus_id'];
$rifComienza 	= $_GET['rifComienza'];
$rifTermina 	= $_GET['rifTermina'];

 
$objContribuyente 	= new contribuyente();

$data = $objContribuyente -> getAllData($rif,$id_estado,$id_municipio,$id_parroquia,$estatus_id,$rifComienza ,$rifTermina);

$header = array('A' =>'Razon', 'B' => 'RIF', 'C' => 'Domicilio', 'D' => 'Telefono', 'E' => 'Fax', 'F' => 'Correo', 'G' => 'Cierre', 'H' => 'Actividad','I' => 'Estatus', 'J' => 'Nombre del Representante', 'K' => 'Apellido del Representante', 'L' => 'RIF del Representante', 'M' => 'Correo del Representante', 'N' => 'Telefono del Representante', 'O' => 'Parroquia', 'P' => 'Municipio', 'Q' => 'Estado');


	$objPHPExcel 	= new PHPExcel();

	$cont=1;
	foreach ($header as $key => $value) {
		$objPHPExcel->getActiveSheet()->setCellValue($key.$cont, $value);
	}

	$cont++;
	foreach ($data as $key => $value) {
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$cont, $value['razon_social']);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$cont, $value['rif']);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$cont, $value['domicilio']);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$cont, $value['telefono']);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$cont, $value['fax']);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$cont, $value['correo']);
		$objPHPExcel->getActiveSheet()->setCellValue('G'.$cont, $value['cierre_fiscal']);
		$objPHPExcel->getActiveSheet()->setCellValue('H'.$cont, $value['actividad']);
		$objPHPExcel->getActiveSheet()->setCellValue('I'.$cont, $value['estatus']);
		$objPHPExcel->getActiveSheet()->setCellValue('J'.$cont, $value['representante_nombre']);
		$objPHPExcel->getActiveSheet()->setCellValue('K'.$cont, $value['representante_apellido']);
		$objPHPExcel->getActiveSheet()->setCellValue('L'.$cont, $value['representante_rif']);
		$objPHPExcel->getActiveSheet()->setCellValue('M'.$cont, $value['representante_correo']);
		$objPHPExcel->getActiveSheet()->setCellValue('N'.$cont, $value['representante_telefono']);
		$objPHPExcel->getActiveSheet()->setCellValue('O'.$cont, $value['parroquia']);
		$objPHPExcel->getActiveSheet()->setCellValue('P'.$cont, $value['municipio']);
		$objPHPExcel->getActiveSheet()->setCellValue('Q'.$cont, $value['estado']);
		$cont++;
	}

	$style1 = array(
		'font' => array(
			'bold' => true,
		),
	);
	$style2=array(
		'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array('argb' => '0055ff'),
			),
		),
	);

	$date 		= new DateTime();
	$datetime 	= $date->format('Y-m-d H-i-s');
	define('ROOTPATH', __DIR__);

	$url = '/docs/contribuyentes_'.$datetime.'.xlsx';
	$objPHPExcel->getActiveSheet()->getStyle('A3:A20')->applyFromArray($style1);
	$objPHPExcel->getActiveSheet()->getStyle('B3:B20')->applyFromArray($style2);
	$objPHPExcel->getActiveSheet()->setTitle('Contribuyentes');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

	$objWriter->save(ROOTPATH.$url);


	$fichero = (ROOTPATH.$url);
	if (file_exists($fichero)) {
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename="'.basename($fichero).'"');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($fichero));
	    readfile($fichero);
	    exit;
	}



?>

