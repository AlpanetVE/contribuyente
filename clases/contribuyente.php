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
	private $fecha_notificacion;
	private $fecha_sujecion;



	private $nombre;
	private $apellido;
	private $rif_representante;
	private $correo_representante;
	private $telefono_representante;

	public function getContribuyente($contribuyente_id=null,$razon_social=null,$rif=null,$domicilio=null,$parroquia_id=null,$telefono=null,$fax=null,$correo=null,$cierre_fiscal=null,$actividad=null,$fecha_notificacion=null,$fecha_sujecion=null){

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
	public function registrarContribuyente($razon_social=null,$rif=null,$domicilio=null,$parroquia_id=null,$telefono=null,$fax=null,$correo=null,$cierre_fiscal=null,$fecha_sujecion=null,$fecha_notificacion=null,$actividad=null,$estatus_id=null){

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
				"fecha_sujecion"=>$fecha_sujecion,
				"fecha_notificacion"=>$fecha_notificacion,
				"actividad" 	=> $actividad,
				"estatus_id" 	=> $estatus_id
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
	public function getAllData($rif,$id_estado,$id_municipio,$id_parroquia,$estatus_id,$rifComienza ,$rifTermina,$limit = null){
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
				c.contribuyente_id,
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
				INNER JOIN estatus AS s ON s.estatus_id = c.estatus_id
				WHERE
				1";

		if(!empty($rif)){
			$query.= " AND c.rif LIKE '%$rif%'";
		}
		if(!empty($rifComienza)){
			$query.= " AND c.rif LIKE '$rifComienza%'";
		}
		if(!empty($rifTermina)){
			$query.= " AND c.rif LIKE '%$rifTermina'";
		}
		if (!empty($id_estado)) {
			$query.= " AND e.id_estado = $id_estado";
		}

		if (!empty($id_municipio)) {
			$query.= " AND m.id_municipio = $id_municipio";
		}

		if (!empty($id_parroquia)) {
			$query.= " AND p.id_parroquia = $id_parroquia";
		}

		if (!empty($estatus_id)) {
			$query.= " AND c.estatus_id = $estatus_id";
		}

		if (!empty($limit)) {
			$query.= $limit;
		}

		//var_dump($query);
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

	public function rifExist($rif){
		$sql=new bd();
		return ($sql->doSingleSelect('contribuyentes', "rif = '$rif'", 'rif'));
	}
	public function rifExistRepresentante($rif){
		$sql=new bd();
		return ($sql->doSingleSelect('representante', "rif = '$rif'", 'rif'));

	}




}
