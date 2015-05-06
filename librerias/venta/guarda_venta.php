<?php

if(isset($_POST['rutclie']) && !empty($_POST['rutclie'])){
	//
	$ejecutor = new EjecutarSql();

	$busca = new Consulta();

	$saca_total = "SELECT sum(subtotal) as total from carro_venta";

	$detalle_venta = "SELECT * from carro_venta";

	$saca_id_cliente = "SELECT id from clientes where rut ='{$_POST['rutclie']}'";

	$id_cliente = 0;

	$busca->cambiar_consulta($saca_id_cliente);

	$arreglo = $busca->resultado_arreglo();

	$id_cliente = $arreglo[0]['id'];

	$total = 0;

	$busca->cambiar_consulta($saca_total);

	$arreglo = $busca->resultado_arreglo();	

	$total = $arreglo[0]['total'];

	$fecha = date("Y-m-d");

	$gventa = "INSERT INTO ventas(id_usuario,id_cliente,fecha,total) values('1','$id_cliente','$fecha','$total')";

	$ejecutor->ejecutar($gventa);

	$id_venta = $ejecutor->retorna_ultimo_id();

	$busca->cambiar_consulta($detalle_venta);

	$arreglo_detalle = $busca->resultado_arreglo();

	foreach ($arreglo_detalle as $key => $value) {
		# code...
		$q_ins_det = "INSERT INTO detalle_venta(id_venta,id_articulo,cantidad,precio,subtotal) values('$id_venta','{$value['id_articulo']}','{$value['cantidad']}','{$value['precio_venta']}','{$value['subtotal']}')";

		$ejecutor->ejecutar($q_ins_det);

		$q_busca_art = "SELECT stock from articulos where id='{$value['id_articulo']}'";

		$busca_2 = new Consulta($q_busca_art);

		$retorno = $busca_2->resultado_arreglo();

		$stock_actual = $retorno[0]['stock'];

		$nuevo_stock = $stock_actual-$value['cantidad'];

		$actualiza_stock = "UPDATE articulos SET stock='$nuevo_stock' where id='{$value['id_articulo']}'";

		$ejecutor->ejecutar($actualiza_stock);
	}

	//borra

	$q_borra_carro = "DELETE from carro_venta";

	$ejecutor->ejecutar($q_borra_carro);
	echo "Exito";
}else{
	echo "Faltan Datos";
}