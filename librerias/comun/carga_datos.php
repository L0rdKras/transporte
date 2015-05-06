<?php

if(isset($_GET['dato']) && !empty($_GET['dato']) && isset($_GET['tabla']) && !empty($_GET['tabla']) && isset($_GET['campo']) && !empty($_GET['campo']))
{
	//
	$tabla 		= $_GET['tabla'];
	$campo 		= $_GET['campo'];
	$dato 		= $_GET['dato'];

	$busca = new Consulta("SELECT * from $tabla where $campo='$dato'");
	if($busca->filas_resultado()>0){
		//
		$envia ="";

		$arreglo = $busca->resultado_arreglo();

		/*foreach ($arreglo as $key => $value) {
			# code...
			$envia = $value[$respuesta];
		}*/

		//echo $envia;

		echo formato_json(array("respuesta"=>"Muestra","rut"=>$arreglo[0]['rut'],"nombre"=>$arreglo[0]['nombre'],"giro"=>$arreglo[0]['giro'],"direccion"=>$arreglo[0]['direccion'],"telefono"=>$arreglo[0]['telefono'],"email"=>$arreglo[0]['email']));
	}else{
		echo formato_json(array("respuesta"=>"Error"));
	}

}else{
	//
	echo "Error";
}