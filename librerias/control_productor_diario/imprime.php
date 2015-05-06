<?php

require "../Entidades/Variedad.php";
require "../Entidades/Valle.php";
require "../Entidades/Productor.php";
require "../Entidades/Pdf_listados.php";


if(isset($_GET['productor']) && !empty($_GET['productor']) && isset($_GET['inicio']) && !empty($_GET['inicio']) && isset($_GET['fin']) && !empty($_GET['fin']))
{
	//

	$busca_registros = new Consulta("SELECT * from registers where fecha>='{$_GET['inicio']}' and fecha<='{$_GET['fin']}' and partner_id='{$_GET['productor']}' order by fecha,id");

	$busca_sumatorias = new Consulta("SELECT sum(kneto) as sumkneto, sum(kgrado) as sumkgrado from registers where fecha>='{$_GET['inicio']}' and fecha<='{$_GET['fin']}' and partner_id='{$_GET['productor']}'");

	//die("SELECT sum(kneto) as sumneto, sum(kgrado) as sumgrado, variety_id from registers where fecha>='$fecha_i' and fecha<='$fecha_f' group by variety_id");
	if($busca_registros->filas_resultado()>0){
		//$respuesta = $busca_registros->resultado_arreglo();

		$respuesta_sumatorias = $busca_sumatorias->resultado_arreglo();
		$suma_kneto = $respuesta_sumatorias[0]['sumkneto'];
		$suma_kgrado = $respuesta_sumatorias[0]['sumkgrado'];

		$variedad = new Variedad();
		$valle = new Valle();
		$productor = new Productor();

		$productor->carga_id($_GET['productor']);

		$imprime = $busca_registros->resultado_arreglo();

		$el_pdf = new Pdf_listados("Control x Productor");

		$el_pdf->AliasNbPages();

		$el_pdf->AddPage();

		$el_pdf->titulo("Control x Productor Diario: ".$productor->retorna("nombre"));

		$header = array("CORR","FECHA","GUIA","VAR","VALLE","KNETO","GRD","KGRADO");

		$campos = array("correlativo","fecha","guia","variety_id","valley_id","kneto","grado","kgrado");

		$w = array(12,25,12,12,20,20,15,20);

		//$enviar = array();

		foreach ($imprime as $key => $value) {
			# code...
			$valle->carga_id($value['valley_id']);
	
			$variedad->carga_id($value['variety_id']);

			$imprime[$key]['valley_id'] = $valle->retorna("nombre");
			$imprime[$key]['variety_id'] = $variedad->retorna("nombre");
		}

		//var_dump($imprime);

		$el_pdf->Imprimir_tabla2($header,$campos,$w,$imprime,'10');

		$el_pdf->Ln(5);

		$el_pdf->titulo("Total KNETO : $suma_kneto // Total KGRADO : $suma_kgrado");

		$el_pdf->Output();
		
	}else{
		echo formato_json(array("respuesta"=>"Fallo","mensaje"=>"Sin Resultado"));
	}
}else{
	echo formato_json(array("respuesta"=>"Fallo","mensaje"=>"Faltan Datos"));
}