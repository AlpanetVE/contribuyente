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
	
	public function getContribuyente($contribuyente_id=null,$razon_social=null,$rif=null,$domicilio=null,$parroquia_id=null,$telefono=null,$fax=null,$correo=null,$cierre_fiscal=null,$actividad=null){
		
		$sql=new bd();
		
		$condicion='1';

		if (!empty($contribuyente_id)) {
			$condicion .= " and contribuyente_id = $contribuyente_id";
		}

		$result=$sql->doFullSelect($this->table, $condicion);
		if(!empty ($result))
			return $result;
		else 
			return false;

	}
	
	public function getRepresentante($representante_id=null,$contribuyente_id=null){
		
		$sql=new bd();
		
		$condicion='1';

		if (!empty($contribuyente_id)) {
			$condicion .= " and contribuyente_id = $contribuyente_id";
		}
		if (!empty($representante_id)) {
			$condicion .= " and representante_id = $representante_id";
		}
		$result=$sql->doFullSelect($this->tableRepresentante, $condicion);
		if(!empty ($result))
			return $result;
		else 
			return false;

	}
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

	public function actualizarContribuyente($contribuyente_id=NULL, $data=NULL){
		$bd=new bd();
		$condicion="contribuyente_id=$contribuyente_id";
		$result=$bd->doUpdate($this->table,$data,$condicion);
		return $result;
	}
	public function actualizarRepresentante($contribuyente_id=NULL, $data=NULL){
		$bd=new bd();
		$condicion="contribuyente_id=$contribuyente_id";
		$result=$bd->doUpdate($this->tableRepresentante,$data,$condicion);

		return $result;
	}

	public function getInspecciones($campos){
		$sql=new bd();
		$consulta="select $campos FROM $this->table WHERE 1 ";
		
		//echo $consulta;
        $result=$sql->query($consulta);
		return $result;
	}

	public function borrarContribuyente($contribuyente_id){
		$sql=new bd();
		$consulta="DELETE FROM $this->table WHERE contribuyente_id = $contribuyente_id";
		
        $result=$sql->query($consulta);
		return $result;
	}
	public function borrarRepresentante($contribuyente_id){
		$sql=new bd();
		$consulta="DELETE FROM $this->tableRepresentante WHERE contribuyente_id = $contribuyente_id";
		
        $result=$sql->query($consulta);
		return $result;
	}
	
}
