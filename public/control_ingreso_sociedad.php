<?php
session_start();

if(file_exists("../Controller/master.php")){
	$nombre_pagina	=	"control_ingreso_sociedad";
	$plantilla		=	"normal";
	$titulo 		=	"Control x Sociedad";
	require "../Controller/master.php";
	require "../Entidades/Productor.php";

	$productor = new Productor();

	$busca_grupos = new Consulta("SELECT * from groups order by id");

	$grupos = $busca_grupos->resultado_arreglo();

	$arreglo_data_grupos = array();

	foreach ($grupos as $key => $value) {
		$busca_productores = new Consulta("SELECT * from partners where group_id = '{$value['id']}'");

		$productores = $busca_productores->resultado_arreglo();

		$id_grupo = $value['id'];

		$arreglo_data_productor = array();

		foreach ($productores as $clave => $valor) {
			$saca_kneto = new Consulta("SELECT sum(kneto) as sumatoria from registers where partner_id='{$valor['id']}'");

			$saca_kgrado = new Consulta("SELECT sum(kgrado) as sumatoria from registers where partner_id='{$valor['id']}'");			

			$res_neto = $saca_kneto->resultado_arreglo();

			$res_grado = $saca_kgrado->resultado_arreglo();

			$arreglo_data_productor[$valor['id']]['kneto'] = 0+$res_neto[0]['sumatoria'];
			$arreglo_data_productor[$valor['id']]['kgrado'] = 0+$res_grado[0]['sumatoria'];

		}
		$arreglo_data_grupos[$id_grupo] = $arreglo_data_productor;
	}

	crear_ventana($nombre_pagina,$plantilla,compact('titulo','arreglo_data_grupos','productor'));

}else{
	die("Controlador no encontrado");
}