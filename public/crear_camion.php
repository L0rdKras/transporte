<?php
session_start();

if(file_exists("../Controller/master.php")){
	$nombre_pagina	=	"crear_camion";
	$plantilla		=	"normal";
	$titulo 		=	"Camiones";
	require "../Controller/master.php";

	$buscar 		= 	"SELECT * from trucks order by id";

	$detalle		=	new Consulta($buscar);

	$camiones 		= 	$detalle->resultado_arreglo();

	crear_ventana($nombre_pagina,$plantilla,compact('titulo','camiones'));

}else{
	die("Controlador no encontrado");
}