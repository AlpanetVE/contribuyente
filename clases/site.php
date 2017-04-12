<?php
include_once 'bd.php';

class site {

	protected $table = "estados";
	private $razon;
	private $ente;
	private $tiporif;
	private $rif;
	private $funcionario;
	private $observacion;

	
	public function getEstados($id_estado = null){
		$sql=new bd();
		$consulta="SELECT *
					FROM
					estados
					WHERE 1";

		if (!empty($id_estado)) {
			$consulta.=" and id_estado in ($id_estado)";
		}

        $result=$sql->query($consulta);
		return $result;
	}


	public function getMunicipios($id_municipio = null,$id_estado = null){
		$sql=new bd();
		$consulta="SELECT *
					FROM
					municipios
					WHERE 1";

		if (!empty($id_municipio)) {
			$consulta.=" and id_municipio in ($id_municipio)";
		}
		if (!empty($id_estado)) {
			$consulta.=" and id_estado in ($id_estado)";
		}
        $result=$sql->query($consulta);
		return $result;
	}


	public function getParroquias($id_parroquia = null,$id_municipio = null){
		$sql=new bd();
		$consulta="SELECT *
					FROM
					parroquias
					WHERE 1";

		if (!empty($id_parroquia)) {
			$consulta.=" and id_parroquia in ($id_parroquia)";
		}
		if (!empty($id_municipio)) {
			$consulta.=" and id_municipio in ($id_municipio)";
		}
        $result=$sql->query($consulta);
		return $result;
	}

	public function getSities($id_parroquia = null,$id_municipio = null){
		$sql=new bd();
		$consulta="SELECT
				estados.estado,
				municipios.municipio,
				parroquias.parroquia,
				estados.id_estado,
				parroquias.id_parroquia,
				municipios.id_municipio
				FROM
				estados
				INNER JOIN municipios ON municipios.id_estado = estados.id_estado
				INNER JOIN parroquias ON parroquias.id_municipio = municipios.id_municipio
				WHERE
				parroquias.id_parroquia = $id_parroquia";
				
        $result=$sql->query($consulta);
		return $result;
	}


	


	
}
