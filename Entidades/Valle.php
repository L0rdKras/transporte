<?php

class Valle{
	protected $id;
	
	protected $nombre;
	

	public function __construct()
	{
		$this->id = 0;
	}

	public function carga_id($id)
	{
		$this->id = $id;

		$busca_productor = new Consulta("SELECT * from valleys where id = '{$this->id}'");

		if($busca_productor->filas_resultado()>0)
		{
			$resultado_q = $busca_productor->resultado_arreglo();

			
			$this->nombre = $resultado_q[0]['name'];
			

			return true;
		}else{
			return false;
		}
	}

	public function retorna($campo)
	{
		return $this->$campo;
	}

	public function carga_nombre($nombre)
	{
		
		$busca_productor = new Consulta("SELECT * from valleys where name = '$nombre'");

		if($busca_productor->filas_resultado()>0)
		{
			$resultado_q = $busca_productor->resultado_arreglo();

			
			$this->nombre = $resultado_q[0]['name'];
			$this->id = $resultado_q[0]['id'];
			

			return true;
		}else{
			return false;
		}
	}
}

?>