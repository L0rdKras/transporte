<?php
session_start();

if(file_exists("../Controller/master.php")){
	$nombre_pagina	=	"inf_diaria";
	$plantilla		=	"normal";
	$titulo 		=	"Control Ingreso";
	require "../Controller/master.php";
	
	crear_ventana($nombre_pagina,$plantilla,compact('titulo','opciones'));

}else{
	die("Controlador no encontrado");
}