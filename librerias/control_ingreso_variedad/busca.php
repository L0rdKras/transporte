<?php
require "../Entidades/Variedad.php";

if(isset($_GET['inicio']) && !empty($_GET['inicio']) && isset($_GET['termino']) && !empty($_GET['termino']))
{
	//
	$fecha_i = $_GET['inicio'];
	$fecha_f = $_GET['termino'];

	$busca_registros = new Consulta("SELECT sum(kneto) as sumneto, sum(kgrado) as sumgrado, variety_id from registers where fecha>='$fecha_i' and fecha<='$fecha_f' group by variety_id");

	$busca_sumatorias = new Consulta("SELECT sum(kneto) as sumneto, sum(kgrado) as sumgrado, variety_id from registers where fecha>='$fecha_i' and fecha<='$fecha_f'");

	//die("SELECT sum(kneto) as sumneto, sum(kgrado) as sumgrado, variety_id from registers where fecha>='$fecha_i' and fecha<='$fecha_f' group by variety_id");
	if($busca_registros->filas_resultado()>0){
		$respuesta = $busca_registros->resultado_arreglo();

		$respuesta_sumatorias = $busca_sumatorias->resultado_arreglo();

		$suma_kneto = $respuesta_sumatorias[0]['sumneto'];
		$suma_kgrado = $respuesta_sumatorias[0]['sumgrado'];

		$variedad = new Variedad();

		require "../librerias/control_ingreso_variedad/tabla_datos.php";
		
	}else{
		echo formato_json(array("respuesta"=>"Fallo","mensaje"=>"Sin Resultado"));
	}
}else{
	echo formato_json(array("respuesta"=>"Fallo","mensaje"=>"Faltan Datos"));
}