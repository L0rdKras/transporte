<?php

require "../Controller/master.php";

$busca = new Consulta("SELECT id,FECHA from auxiliar order by id");

$respuesta = $busca->resultado_arreglo();

echo "<table>";
foreach ($respuesta as $key => $value) {
	$fecha_ex = explode("-", $value['FECHA']);

	$year = "20".$fecha_ex[2];

	$mes ="04";
	if($fecha_ex['1'] == "mar"){ $mes = "03";}

	$dia = $fecha_ex[0];
	if($fecha_ex[0]<0){
		$dia = "0".$dia;
	}

	$new_fecha = "$year-$mes-$dia";

	$ejecutor = new EjecutarSql();

	$up = "UPDATE auxiliar SET fecha_aux= '$new_fecha' where id = '{$value['id']}'";

	echo "<tr><td>$year-$mes-$dia</td></tr>";
	$ejecutor->ejecutar($up);
}
echo "</table>";
?>