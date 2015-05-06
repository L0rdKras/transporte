<?php

if(isset($_GET['id']) && !empty($_GET['id'])){
	//
	$ejecutor = new EjecutarSql();

	$borra = "DELETE from aux_detalle where id='{$_GET['id']}'";

	if($ejecutor->ejecutar($borra)){
		require "../Entidades/Articulo.php";

		$ejecutor = new EjecutarSql();

		$articulo =  new Articulo();

		//$articulo->cargar_por_id($_GET['articulo']);

		$busca = new Consulta("SELECT * from aux_detalle");
		$saca_suma = new Consulta("SELECT sum(subtotal) as sumatoria from aux_detalle");
		$res_sumatoria = $saca_suma->retorna_resultado();
		$total = 0;
		if($row_sum = $res_sumatoria->fetch_array()){
			$total += $row_sum['sumatoria'];
		}
		$arreglo = $busca->resultado_arreglo();
		//$reg_error = "Error: El articulo ya estaba ingresado";
		require "../librerias/compra/detalle_compra.php";
	}else{
		echo "Error: problema para eliminar";
	}
}else{
	echo "Error: ID no valido";
}