<?php

$busca_art_detalle = new Consulta("SELECT * from aux_detalle where id_articulo = '{$_GET['articulo']}'");
if($busca_art_detalle->filas_resultado()==0){
	require "../Entidades/Articulo.php";

	$ejecutor = new EjecutarSql();

	$articulo =  new Articulo();

	$articulo->cargar_por_id($_GET['articulo']);

	$pventasugerido = $articulo->calcula_precio_venta($_GET['precio']);

	$qinsertardetalle = "INSERT INTO aux_detalle(id_articulo,cantidad,precio_compra,precio_venta,subtotal) values('{$_GET['articulo']}','{$_GET['cantidad']}','{$_GET['precio']}','$pventasugerido','{$_GET['subtotal']}')";

	if($ejecutor->ejecutar($qinsertardetalle)){
		//$articulo =  new Articulo();
		$busca = new Consulta("SELECT * from aux_detalle");
		$saca_suma = new Consulta("SELECT sum(subtotal) as sumatoria from aux_detalle");
		$res_sumatoria = $saca_suma->retorna_resultado();
		$total = 0;
		if($row_sum = $res_sumatoria->fetch_array()){
			$total += $row_sum['sumatoria'];
		}
		$arreglo = $busca->resultado_arreglo();
		require "../librerias/compra/detalle_compra.php";
	}
	
}else{
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
	$reg_error = "Error: El articulo ya estaba ingresado";
	require "../librerias/compra/detalle_compra.php";
}
