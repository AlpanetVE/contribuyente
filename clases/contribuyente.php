<?php
include_once 'bd.php';

class contribuyente {

	protected $table = "contribuyentes";
	protected $tableRepresentante = "representante";

	private $razon_social;
	private $rif;
	private $domicilio;
	private $estado;
	private $municipio;
	private $parroquia;
	private $telefono;
	private $fax;
	private $correo;
	private $cierre_fiscal;
	private $actividad;


	private $nombre;
	private $apellido;
	private $rif_representante;
	private $correo_representante;
	private $telefono_representante;
	
	public function registrarContribuyente($razon_social,$rif,$domicilio,$parroquia_id,$telefono,$fax,$correo,$cierre_fiscal,$actividad){	
		
		$sql=new bd();
		
		$result=$sql->doInsert($this->table, array (
				"razon_social" 	=> $razon_social,
				"rif" 			=> $rif,
				"domicilio" 	=> $domicilio,
				"parroquia_id" 	=> $parroquia_id,
				"telefono" 		=> $telefono,
				"fax" 			=> $fax,
				"correo" 		=> $correo,
				"cierre_fiscal" => $cierre_fiscal,
				"actividad" 	=> $actividad
		));

		return $sql->lastInsertId();
	}
 








	public function registrarRepresentante($contribuyente_id,$nombre,$apellido,$rif,$correo,$telefono){		
		
		$sql=new bd();
		
		$result=$sql->doInsert($this->tableRepresentante, array (
				"contribuyente_id" 	=> $contribuyente_id,
				"nombre" 			=> $nombre,
				"apellido" 			=> $apellido,
				"rif" 				=> $rif,
				"correo" 			=> $correo,
				"telefono" 			=> $telefono
		));
		
		return $sql->lastInsertId();
	}
	
}
