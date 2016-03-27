<?php
include_once 'bd.php';
class inspeccion {

	protected $table = "inspeccion";
	private $razon;
	private $ente;
	private $tiporif;
	private $rif;
	private $funcionario;
	private $observacion;
	
	public function registrarInspeccion($razon,$ente,$tiporif,$rif,$funcionario,$observacion){
		$rif_def=$tiporif.$rif;
		
		
		$sql=new bd();
		
		$result=$sql->doInsert($this->table, array (
				"razon_social" => $razon,
				"tipo_ente" => $ente,
				"rif" => $rif_def,
				"funcionario"=> $funcionario,
				"observacion" => $observacion 
		));
		
		return $result;
	}
	
	
	public function listarInspecciones(){
		$sql=new bd();
		$condicion='status=1';
		$result=$sql->doFullSelect($this->table, $condicion);
		if(!empty ($result))
			return $result;
		else 
			return false;
	}
	
	public function getInspecciones($campos){
		$sql=new bd();
		$consulta="select $campos FROM inspeccion WHERE status=1 ";
		
		//echo $consulta;
        $result=$sql->query($consulta);
		return $result;
	}
	/*public function listarFiltrada($razon=NULL,$ente=NULL,$rif=NULL,$funcionario=NULL,$observacion=NULL){
		
		
	}*/
	
}
