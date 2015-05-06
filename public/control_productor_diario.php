<?php
session_start();

if(file_exists("../Controller/master.php")){
	$nombre_pagina	=	"control_productor_diario";
	$plantilla		=	"normal";
	$titulo 		=	"Control x Productor";
	require "../Controller/master.php";

	$busca_productores = new Consulta("SELECT * from partners order by id");

	$productores = $busca_productores->resultado_arreglo();

	crear_ventana($nombre_pagina,$plantilla,compact('titulo','productores'));

}else{
	die("Controlador no encontrado");
}