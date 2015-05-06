<?php
require "../Entidades/Articulo.php";
$qbusqueda = "SELECT id from articulos where 1=1 ";
$contador = 0;
if(isset($_GET['tipo']) && !empty($_GET['tipo'])){
	$contador++;
	$qbusqueda.=" and id_tipo = '{$_GET['tipo']}'";
}
if(isset($_GET['descripcion']) && !empty($_GET['descripcion'])){
	$contador++;
	$qbusqueda.=" and id_descripcion = '{$_GET['descripcion']}'";
}
if(isset($_GET['marca']) && !empty($_GET['marca'])){
	$contador++;
	$qbusqueda.=" and id_marca = '{$_GET['marca']}'";
}

if ($contador>0){
	//
	$busca = new Consulta($qbusqueda);

	if($busca->filas_resultado()>0){
		$resultado = $busca->resultado_arreglo();
		$articulo = new Articulo();
		require "../librerias/venta/tabla_busqueda.php";
	}else{
		echo "Busqueda sin resultados".$qbusqueda;
	}
}else{
	echo "No hay parametros para busqueda";
}