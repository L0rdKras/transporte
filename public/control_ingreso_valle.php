<?php
session_start();

if(file_exists("../Controller/master.php")){
	$nombre_pagina	=	"control_ingreso_valle";
	$plantilla		=	"normal";
	$titulo 		=	"Control x Valle";
	require "../Controller/master.php";
	require "../Entidades/Valle.php";
	require "../Entidades/Variedad.php";

	$valle = new Valle();
	$variedad = new Variedad();

	$busca_valle = new Consulta("SELECT * from valleys order by id");

	$valles = $busca_valle->resultado_arreglo();

	$arreglo_data_valles = array();

	foreach ($valles as $key => $value) {
		$busca_info = new Consulta("SELECT sum(kneto) as sumneto, sum(kgrado) as sumgrado,variety_id,valley_id from registers where valley_id = '{$value['id']}' group by variety_id");

		$info = $busca_info->resultado_arreglo();

		$id_valle = $value['id'];

		$arreglo_data_variedad = array();

		foreach ($info as $clave => $valor) {
			$arreglo_data_variedad[$valor['variety_id']]['kneto'] = $valor['sumneto'];
			$arreglo_data_variedad[$valor['variety_id']]['kgrado'] = $valor['sumgrado'];

		}
		$arreglo_data_valles[$id_valle] = $arreglo_data_variedad;
	}


	crear_ventana($nombre_pagina,$plantilla,compact('titulo','arreglo_data_valles','valle','variedad'));

}else{
	die("Controlador no encontrado");
}