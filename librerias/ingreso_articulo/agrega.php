<?php

require "../Entidades/Articulo.php";

if(isset($_POST['tipo']) && !empty($_POST['tipo']) && isset($_POST['descripcion']) && !empty($_POST['descripcion']) && isset($_POST['marca']) && !empty($_POST['marca']) && isset($_POST['precio']) && !empty($_POST['precio']))
{
	$articulo = new Articulo();
	$data = ["id_tipo" => $_POST['tipo'], "id_descripcion" => $_POST['descripcion'], "id_marca"=> $_POST['marca'], "precio"=> $_POST['precio']];
	$articulo->carga_datos($data);
	$codigo = $articulo->genera_codigo();
	if($articulo->codigo_nuevo())
	{
		$codigo.=" guarda";
		$articulo->guardar();
	}else{
		$articulo->actualiza();
		$codigo.=" actualiza";
	}

	echo $codigo;
}else{
	echo "Faltan Datos!";
}