<?php

if(isset($_GET['id']) && !empty($_GET['id'])){
	//
	$ejecutor = new EjecutarSql();

	$borra = "DELETE from carro_venta where id='{$_GET['id']}'";

	if($ejecutor->ejecutar($borra)){
		require "../Entidades/Articulo.php";

		$ejecutor = new EjecutarSql();

		$articulo =  new Articulo();

		$busca = new Consulta("SELECT * from carro_venta");
		$saca_suma = new Consulta("SELECT sum(subtotal) as sumatoria from carro_venta");
		$res_sumatoria = $saca_suma->retorna_resultado();
		$total = 0;
		if($row_sum = $res_sumatoria->fetch_array()){
			$total += $row_sum['sumatoria'];
		}
		$arreglo = $busca->resultado_arreglo();
		//$reg_error = "Error: El articulo ya estaba ingresado";
		require "../librerias/venta/detalle_venta.php";
	}else{
		echo "Error: problema para eliminar";
	}
}else{
	echo "Error: ID no valido";
}