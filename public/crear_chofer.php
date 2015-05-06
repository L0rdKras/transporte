<?php
session_start();

if(file_exists("../Controller/master.php")){
	$nombre_pagina	=	"crear_chofer";
	$plantilla		=	"normal";
	$titulo 		=	"Choferes";
	require "../Controller/master.php";

	$buscar 		= 	"SELECT * from drivers order by id";

	$detalle		=	new Consulta($buscar);

	$choferes 		= 	$detalle->resultado_arreglo();

	crear_ventana($nombre_pagina,$plantilla,compact('titulo','choferes'));

}else{
	die("Controlador no encontrado");
}