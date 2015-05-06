<?php
require "../Entidades/Productor.php";

require "../Entidades/Variedad.php";
if(isset($_GET['inicio']) && !empty($_GET['inicio']) && isset($_GET['termino']) && !empty($_GET['termino'])){
	//
	$busca = "SELECT * from registers where fecha>='{$_GET['inicio']}' and fecha<='{$_GET['termino']}' order by fecha,id";

	$busca_sum_kneto = "SELECT sum(kneto) as suma from registers where fecha>='{$_GET['inicio']}' and fecha<='{$_GET['termino']}'";

	$busca_sum_kgrado = "SELECT sum(kgrado) as suma from registers where fecha>='{$_GET['inicio']}' and fecha<='{$_GET['termino']}'";

	$consultar = new Consulta($busca);

	if($consultar->filas_resultado()>0)
	{
		$resultado_b=$consultar->resultado_arreglo();

		$consultar->cambiar_consulta($busca_sum_kneto);

		$res_sum_kneto = $consultar->resultado_arreglo();

		$consultar->cambiar_consulta($busca_sum_kgrado);

		$res_sum_kgrado = $consultar->resultado_arreglo();

		$suma_kneto = $res_sum_kneto[0]["suma"];
		$suma_kgrado = $res_sum_kgrado[0]["suma"];

		$productor = new Productor();
		$variedad = new Variedad();
	
		require "../librerias/inf_diaria/tabla_datos.php";

	}else{
		echo formato_json(array("respuesta"=>"Fallo","mensaje"=>"Sin Resultado"));
	}
}else{
	echo formato_json(array("respuesta"=>"Fallo","mensaje"=>"Faltan Datos"));
}