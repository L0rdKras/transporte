<?php

class Camion{
	protected $id;
	protected $marca;
	protected $modelo;
	protected $year;

	public function __construct(){
		//
		$this->id = 0;
		$this->marca = "";
		$this->modelo = "";
		$this->year = "";
	}

	public function cargar_por_id($id){
		//
		$busca = new Consulta("SELECT * from trucks where id='$id'");

		if($busca->filas_resultado()>0)
		{
			//
			$encontro = $busca->resultado_arreglo();

			$this->id = $id;
			$this->marca = $encontro[0]['marca'];
			$this->modelo = $encontro[0]['modelo'];
			$this->year = $encontro[0]['year'];
		}else{
			return false;
		}
	}

	public function guardar(){
		//
		$ejecutor_camion = new EjecutarSql();
		if($this->id!=0){

			$query = "UPDATE trucks SET marca='{$this->marca}',modelo='{$this->modelo}',year='{$this->year}' where id = '{$this->id}'";

			$ejecutor_camion->ejecutar($query);
		}else{
			if(!empty($this->marca) && !empty($this->modelo) && !empty($this->year))
			{
				$query = "INSERT INTO trucks(marca,modelo,year) values('{$this->marca}','{$this->modelo}','{$this->year}')";

				$ejecutor_camion->ejecutar($query);

				$this->id = $ejecutor_camion->retorna_ultimo_id();
			}
		}
	}

	function edita_campo($nombre,$valor)
	{
		$this->$nombre = $valor;
	}
}