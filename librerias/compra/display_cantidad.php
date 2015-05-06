<?php

if(isset($_GET['id']) && !empty($_GET['id'])){
	require "../Entidades/Articulo.php";
	$qbusqueda = "SELECT id from articulos where id='{$_GET['id']}' ";
	$busca = new Consulta($qbusqueda);
	if($busca->filas_resultado()>0){
		$articulo = new Articulo();
		$articulo->cargar_por_id($_GET['id']);
		require "../librerias/compra/para_cantidad.php";
	}else{
		echo "Error: id no valida";
	}
}