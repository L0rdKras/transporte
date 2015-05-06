<?php

$busca_art_detalle = new Consulta("SELECT * from carro_venta where id_articulo = '{$_GET['articulo']}'");
if($busca_art_detalle->filas_resultado()==0){
	require "../Entidades/Articulo.php";

	$ejecutor = new EjecutarSql();

	$articulo =  new Articulo();

	$articulo->cargar_por_id($_GET['articulo']);

	$qinsertardetalle = "INSERT INTO carro_venta(id_articulo,cantidad,precio_venta,precio_sistema,subtotal) values('{$_GET['articulo']}','{$_GET['cantidad']}','{$_GET['precio']}','$pventasugerido','{$_GET['subtotal']}')";

	if($ejecutor->ejecutar($qinsertardetalle)){
		//$articulo =  new Articulo();
		$busca = new Consulta("SELECT * from carro_venta");
		$saca_suma = new Consulta("SELECT sum(subtotal) as sumatoria from carro_venta");
		$res_sumatoria = $saca_suma->retorna_resultado();
		$total = 0;
		if($row_sum = $res_sumatoria->fetch_array()){
			$total += $row_sum['sumatoria'];
		}
		$arreglo = $busca->resultado_arreglo();
		require "../librerias/venta/detalle_venta.php";
	}
	
}else{
	require "../Entidades/Articulo.php";

	$ejecutor = new EjecutarSql();

	$articulo =  new Articulo();

	//$articulo->cargar_por_id($_GET['articulo']);

	$busca = new Consulta("SELECT * from carro_venta");
	$saca_suma = new Consulta("SELECT sum(subtotal) as sumatoria from carro_venta");
	$res_sumatoria = $saca_suma->retorna_resultado();
	$total = 0;
	if($row_sum = $res_sumatoria->fetch_array()){
		$total += $row_sum['sumatoria'];
	}
	$arreglo = $busca->resultado_arreglo();
	$reg_error = "Error: El articulo ya estaba ingresado";
	require "../librerias/venta/detalle_venta.php";
}
