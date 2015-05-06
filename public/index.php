<?php
session_start();

if(file_exists("../Controller/master.php")){
	$nombre_pagina	=	"index";
	$plantilla		=	"normal";
	$titulo 		=	"Cargas";
	require "../Controller/master.php";
	$prueba 		=	new Consulta("SELECT * from usuarios");
	$opciones 		= array("Registro" => "/ingreso_carga.php","Informacion Diaria(reporte por periodo de tiempo)"=>"/inf_diaria.php","Control Ingreso Por Sociedad"=>"/control_ingreso_sociedad.php","Control x Valle"=>"/control_ingreso_valle.php","Control x Variedad"=>"/control_ingreso_variedad.php","Control x Productor Diario"=>"/control_productor_diario.php");
	crear_ventana($nombre_pagina,$plantilla,compact('titulo','opciones'));

}else{
	die("Controlador no encontrado");
}