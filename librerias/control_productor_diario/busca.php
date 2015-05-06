<?php
require "../Entidades/Variedad.php";
require "../Entidades/Valle.php";

if(isset($_GET['productor']) && !empty($_GET['productor']) && isset($_GET['inicio']) && !empty($_GET['inicio']) && isset($_GET['fin']) && !empty($_GET['fin']))
{
	//

	$busca_registros = new Consulta("SELECT * from registers where fecha>='{$_GET['inicio']}' and fecha<='{$_GET['fin']}' and partner_id='{$_GET['productor']}' order by fecha,id");

	$busca_sumatorias = new Consulta("SELECT sum(kneto) as sumkneto, sum(kgrado) as sumkgrado from registers where fecha>='{$_GET['inicio']}' and fecha<='{$_GET['fin']}' and partner_id='{$_GET['productor']}'");

	//die("SELECT sum(kneto) as sumneto, sum(kgrado) as sumgrado, variety_id from registers where fecha>='$fecha_i' and fecha<='$fecha_f' group by variety_id");
	if($busca_registros->filas_resultado()>0){
		$respuesta = $busca_registros->resultado_arreglo();

		$respuesta_sumatorias = $busca_sumatorias->resultado_arreglo();

		$variedad = new Variedad();
		$valle = new Valle();

		$suma_kneto = $respuesta_sumatorias[0]['sumkneto'];
		$suma_kgrado = $respuesta_sumatorias[0]['sumkgrado'];

		require "../librerias/control_productor_diario/tabla_datos.php";
		
	}else{
		echo formato_json(array("respuesta"=>"Fallo","mensaje"=>"Sin Resultado"));
	}
}else{
	echo formato_json(array("respuesta"=>"Fallo","mensaje"=>"Faltan Datos"));
}