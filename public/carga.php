<?php
session_start();

if(file_exists("../Controller/master.php")){
	$nombre_pagina	=	"carga";
	$plantilla		=	"normal";
	$titulo 		=	"Registro Cargas";
	require "../Controller/master.php";

	$buscar 		= 	"SELECT * from drivers order by id";

	$detalle		=	new Consulta($buscar);

	$choferes 		= 	$detalle->resultado_arreglo();

	$buscar 		= 	"SELECT * from trucks order by id";

	$detalle2		=	new Consulta($buscar);

	$camiones 		= 	$detalle2->resultado_arreglo();

	$ultimas_cargas =	new Consulta("SELECT * from dispatch order by id desc limit 0,10");

	$ultimas 		= 	$ultimas_cargas->resultado_arreglo();

	crear_ventana($nombre_pagina,$plantilla,compact('titulo','choferes','camiones','ultimas'));

}else{
	die("Controlador no encontrado");
}