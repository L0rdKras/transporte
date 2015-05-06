<?php

class Productor{
	protected $id;
	protected $codigo;
	protected $nombre;
	protected $group_id;

	public function __construct()
	{
		$this->id = 0;
	}

	public function carga_id($id)
	{
		$this->id = $id;

		$busca_productor = new Consulta("SELECT * from partners where id = '{$this->id}'");

		if($busca_productor->filas_resultado()>0)
		{
			$resultado_q = $busca_productor->resultado_arreglo();

			$this->codigo = $resultado_q[0]['cod_prod'];
			$this->nombre = $resultado_q[0]['name'];
			$this->group_id = $resultado_q[0]['group_id'];

			return true;
		}else{
			return false;
		}
	}

	public function retorna($campo)
	{
		return utf8_encode($this->$campo);
	}

	/*public function carga_por_codigo($codigo)
	{
		$busca_cod = new Consulta("SELECT * from partners where cod_prod='$codigo' ");

		if($busca_cod->filas_resultado()>0){
			$resultado_q = $busca_cod->resultado_arreglo();

			$this->codigo = $resultado_q[0]['cod_prod'];
			$this->nombre = $resultado_q[0]['name'];
			$this->group_id = $resultado_q[0]['group_id'];			
			$this->id = $resultado_q[0]['id'];

			return true;
		}else{
			return false;
		}
	}*/

	public function carga_por_codigo($codigo)
	{
		

		$busca_productor = new Consulta("SELECT * from partners where cod_prod = '$codigo'");

		if($busca_productor->filas_resultado()>0)
		{
			$resultado_q = $busca_productor->resultado_arreglo();

			$this->codigo = $resultado_q[0]['cod_prod'];
			$this->nombre = $resultado_q[0]['name'];
			$this->group_id = $resultado_q[0]['group_id'];
			$this->id = $resultado_q[0]['id'];

			return true;
		}else{
			return false;
		}
	}	
}

?>