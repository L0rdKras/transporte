<?php
session_start();

if(file_exists("../Controller/master.php")){
	$nombre_pagina	=	"control_ingreso_variedad";
	$plantilla		=	"normal";
	$titulo 		=	"Control x Variedades";
	require "../Controller/master.php";

	/*$hoy = date("Y-m-d");

	$arreglo_fecha = explode("-", $hoy);

	$meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

	$base = 2015;

	$anios = array($base);

	while ($base<$arreglo_fecha[0]){
		$anios[] = $base;
		$base++;
	}*/

	crear_ventana($nombre_pagina,$plantilla,compact('titulo','meses','anios'));

}else{
	die("Controlador no encontrado");
}