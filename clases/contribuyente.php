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
	public function registrarContribuyente($razon_social=null,$rif=null,$domicilio=null,$parroquia_id=null,$telefono=null,$fax=null,$correo=null,$cierre_fiscal=null,$actividad=null,$status_id=null){	
		
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
				"actividad" 	=> $actividad,
				"status_id" 	=> $status_id
		));

		return $sql->lastInsertId();
	}
	public function registrarRepresentante($contribuyente_id=null,$nombre=null,$apellido=null,$rif=null,$correo=null,$telefono=null){		
		
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
	public function getAllData($razon_social,$rif,$correo){
		$sql 	= new bd();

		$query = "SELECT
				c.razon_social,
				c.rif,
				c.domicilio,
				c.telefono,
				c.fax,
				c.correo,
				c.cierre_fiscal,
				c.actividad,
				r.nombre AS representante_nombre,
				r.apellido AS representante_apellido,
				r.rif AS representante_rif,
				r.correo AS representante_correo,
				r.telefono AS representante_telefono,
				p.parroquia,
				m.municipio,
				e.estado,
				s.estatus
				FROM
				representante AS r
				INNER JOIN contribuyentes AS c ON c.contribuyente_id = r.contribuyente_id
				INNER JOIN parroquias AS p ON c.parroquia_id = p.id_parroquia
				INNER JOIN municipios AS m ON p.id_municipio = m.id_municipio
				INNER JOIN estados AS e ON m.id_estado = e.id_estado
				INNER JOIN estatus AS s ON s.estatus_id = c.status_id
				WHERE
				1";

		if(!empty($razon_social)){
			$query.= " AND c.razon_social LIKE '%$razon_social%'";
		}
		if(!empty($rif)){
			$query.= " AND c.rif LIKE '%$rif%'";
		}
		if(!empty($correo)){
			$query.= " AND c.correo LIKE '%$correo%'";
		}

		return $sql->query($query);
	}

	public function getStatus($estatus_id = null){
		$sql=new bd();
		$consulta="SELECT *
					FROM
					estatus
					WHERE 1";

		if (!empty($estatus_id)) {
			$consulta.=" and estatus_id in ($estatus_id)";
		}
		$consulta .= ' order by estatus_id asc';
        $result=$sql->query($consulta);
		return $result;
	}




	
}
