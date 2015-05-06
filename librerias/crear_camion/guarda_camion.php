<?php

require "../Entidades/Camion.php"

if(isset($_POST['marca']) && !empty($_POST['marca']) && isset($_POST['modelo']) && !empty($_POST['modelo']) && isset($_POST['year']) && !empty($_POST['year']))
{
	$camion = new Camion();

	$camion->edita_campo('marca',$_POST['marca']);
	$camion->edita_campo('modelo',$_POST['modelo']);
	$camion->edita_campo('year',$_POST['year']);

	$camion->guardar();

	$buscar 		= 	"SELECT * from trucks order by id";

	$detalle		=	new Consulta($buscar);

	$camiones 		= 	$detalle->resultado_arreglo();

	ob_start();

	require "../librerias/crear_camion/tabla.php";

	$contenido = ob_get_clean();
}else{
	die("Problema Al Cargar Datos");
}