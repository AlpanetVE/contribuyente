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

	
}
