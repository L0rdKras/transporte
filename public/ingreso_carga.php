<?php
session_start();

if(file_exists("../Controller/master.php")){

	$hoy 			= date("Y-m-d");

	$arreglo_hoy 	= explode("-", $hoy);

	$inicio 		= $arreglo_hoy[0]."-".$arreglo_hoy[1]."-01";
	$fin 			= $arreglo_hoy[0]."-".$arreglo_hoy[1]."-31";


	$nombre_pagina	=	"ingreso_carga";
	$plantilla		=	"normal";
	$titulo 		=	"Registro Cargas";
	require "../Controller/master.php";
	require "../Entidades/Productor.php";
	require "../Entidades/Valle.php";
	require "../Entidades/Variedad.php";

	$ejecutor 		= 	new EjecutarSql();

	$ejecutor->ejecutar("DELETE from temp_registers");

	$buscar 		= 	"SELECT * from partners order by group_id,cod_prod";

	$detalle		=	new Consulta($buscar);

	$partners 		= 	$detalle->resultado_arreglo();

	$buscar 		= 	"SELECT * from varieties order by id";

	$detalle2		=	new Consulta($buscar);

	$varieties 		= 	$detalle2->resultado_arreglo();

	$busca_valleys 	=	new Consulta("SELECT * from valleys order by id");

	$valleys 		= 	$busca_valleys->resultado_arreglo();

	$buscar_registros = new Consulta("SELECT * from registers where fecha>='$inicio' and fecha<='$fin' order by id");

	$registers 		= 	$buscar_registros->resultado_arreglo();

	$productor = new Productor();
	$valle = new Valle();
	$variedad = new Variedad();

	//$busca_datos = new Consulta("SELECT * from registers order by id");

	//$resultado_datos = $busca_datos->resultado_arreglo();

	crear_ventana($nombre_pagina,$plantilla,compact('titulo','partners','varieties','valleys','registers','productor','valle','variedad'));

}else{
	die("Controlador no encontrado");
}